<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_order_publish extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->model('admin_model/Model_admin');
        $this->load->model('admin_model/Model_admin_login');
        $this->load->model('Model_user');
        $this->load->model('Model_package');
        $this->load->model('Model_kategori');
        $this->load->model('Model_order');
        $this->load->model('Model_website');
        $this->load->model('Model_website_page');
        $this->load->model('Model_type_template');
        $this->load->helper(array('Form', 'Cookie', 'String'));

        // cek session
        if ($this->session->userdata('adminLogged') != TRUE) {
            redirect(base_url('Admin_panel/login'));
        }
        date_default_timezone_set("Asia/Jakarta");

    }


    
    



    private $controller = 'Admin_order_publish';
   

    public function index()
    {

        // ambil cookie
        $cookie = get_cookie('gwb_cookie');
        
        // cek session
        if ($this->session->userdata('adminLogged')) {
            //==== Inisiasi Awal 
            $data['controller']         = $this->controller;
            $data['title_page']         = 'Data Order Publish | Goodeva';
            $data['data_order']         = $this->Model_order->get_data_orderPublish()->result();
            $data['data_user']          = $this->Model_user->get_data()->result();
            $data['status_order']       = $this->db->get('table_status_order')->result();
            $data['data_website']       = $this->Model_website->get_data()->result();


            $this->load->view('va_order_publish',$data);

        }else if($cookie <> ''){
            // cek cookie
            $row = $this->Model_admin_login->get_by_cookie($cookie)->row();
            if ($row) {
                $this->create_session($row);
            } else {
                redirect(base_url('Admin_panel/login'));
            }
        } else {
                $this->login();
        }
    	
    }


    function create()
    {
        $nama_kategori = $this->input->post('nama_kategori');

        $data = array(
            'nama_kategori' => $nama_kategori,
        );

        $insert = $this->Model_kategori->insert_data($data);

        $this->session->set_flashdata('status_tambah','Data Berhasil ditambahkan');
        redirect(base_url().$this->controller);
    }

    function delete($id)
    {
        $id = $this->input->post('id');

        $where = array(
            'ID' => $id
        );

        $this->Model_kategori->delete_data($where);

        echo '{}';
    }

    function edit($id)
    {
        $data['controller']         = $this->controller;
        $data['title_page']         = 'Edit Data Kategori | Goodeva';

        $where = array(
            'ID' => $id
        );
        $data['data_kategori_edit']  = $this->Model_kategori->edit_data($where)->row();

        // print_r($data['data_package_edit']);

        $this->load->view('va_kategori_edit',$data);
    }

    

    function update()
    {
        $id           = $this->input->post('id');
        $nama_kategori = $this->input->post('nama_kategori');



        $data = array(
            'nama_kategori' => $nama_kategori,
        );
        $where = array(
            'ID' => $id
        );
        $update = $this->Model_kategori->update_data($where,$data);
        $this->session->set_flashdata('status_update','Data Berhasil diupdate');
        redirect(base_url().$this->controller);
    }



    // Confirm Action

    // Status Order ID
    // 1 = Void , 
    // 2 = Waiting Payment , 
    // 3 = Payment Received, 
    // 4 = Payment Verified , 
    // 5 = Cancelled
    // 6 = Expired

    function test()
    {
        $package_terakhir = $this->Model_order->package_terakhir(2)->row();
        print_r($package_terakhir);

        echo date('Y-m-d H:i:s', strtotime($package_terakhir->expired) + (60 * 60 * 24 * 30));

    }
    function confirm_subscription($type = '',$id_order= '')
    {
      
        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'Confirm Payment | Goodeva';

        $cek_data = $this->Model_order->edit_data(array('ID'=> $id_order))->num_rows();

        $data['data_package'] = $this->Model_package->edit_data(array('status'=>$type))->result();

        $data['status_order'] = $this->db->get('table_status_order')->result();


        if ($cek_data > 0) {
            $data['data_order'] = $this->Model_order->edit_data(array('ID'=> $id_order))->row();
            $this->load->view('va_order_confirm', $data );
        }else{
            redirect(base_url().$this->controller);
        }

    }

    function do_confirm_subscription($id_order = '')
    {
        $cek_data = $this->Model_order->edit_data(array('ID'=> $id_order))->num_rows();
        $status_order = $this->input->post('status_order');

        if ($cek_data > 0) {
            $data_order = $this->Model_order->edit_data(array('ID'=> $id_order))->row();

            // Update Status Order
            $data = array(
                'status' => $status_order,
                'update_date'  => date('Y-m-d H:i:s'),
            );

            // Jika Status Order ==4 (Verified) maka Expired 1 Bulan
                if ($status_order == 4 ) {
                    // Pengecekpan Type Order Jika Package maka Data user akan terupdate sesuai dengan subscription
                    if ( $data_order->type_order == 'package') {
                        // Mengupdate Status User 

                        // Pengecekan Perpanjangan Paket
                        $cek_pepanjangan = $this->Model_order->cek_status_perpanjangan_package($data_order->id_user,$data_order->id_package)->num_rows();
                        $data_user = array(
                            'id_package'    => $data_order->id_package,
                            'id_status'     => 2, //2 = Aktif
                        );
                        if ($cek_pepanjangan > 1) {
                            // Masuk Perpanjangan Paket 
                            // Jika Masuk Perpanjangan Maka di cek Expired di package terakhir Kemudian ditambah 1 Bulan
                            $package_terakhir = $this->Model_order->package_terakhir($data_order->id_package)->row();
                            $data_user['expired'] = date('Y-m-d H:i:s', strtotime($package_terakhir->expired) + (60 * 60 * 24 * 30));
                            $data['expired'] = date('Y-m-d H:i:s', strtotime($package_terakhir->expired) + (60 * 60 * 24 * 30));
                        }else{
                            // Expired awal Paket - Lama 1 Bulan
                            $data_user['expired'] = date('Y-m-d H:i:s', time() + (60 * 60 * 24 * 30));
                            $data['expired']   = date('Y-m-d H:i:s', time() + (60 * 60 * 24 * 30));
                        }
                        // Update Package Baru / Awal
                        $update_status_user = $this->Model_user->update_data(array('ID' => $data_order->id_user),$data_user);
                    }elseif($data_order->type_order == 'publish'){
                        // echo "publish";
                        $data['expired']   = date('Y-m-d H:i:s', time() + (60 * 60 * 24 * 30));
                    }
                }



            $update_data = $this->Model_order->update_data(array('ID'=>$id_order),$data);
            $this->session->set_flashdata('message','confirm');
            redirect(base_url().$this->controller);

        }else{
            redirect(base_url().$this->controller);
        }

    }
    // 


    function proses($type = '',$id_order= '')
    {
        $cek_data = $this->Model_order->cek_order_publish($id_order,$type)->num_rows();


        if ($cek_data > 0 ) {
            $data['data_user']          = $this->Model_user->get_data()->result();
            $data['data_order'] = $this->Model_order->cek_order_publish($id_order,$type)->row();
            $data['data_website'] = $this->Model_website->edit_data(array('ID'=>$data['data_order']->id_website))->row();
            $data['type_template'] = $this->Model_type_template->get_data()->result();
            $data['controller'] = $this->controller;
            $data['status_order'] = $this->db->get('table_status_order')->result();
            $data['title_page'] = 'Proses Website | Goodeva';
            $data['data_page']  = $this->Model_website_page->edit_data(array('id_website'=>$data['data_website']->ID))->result();
            $data['jumlah_page']  = $this->Model_website_page->edit_data(array('id_website'=>$data['data_website']->ID))->num_rows();

            $cek_data_website = $this->Model_website->edit_data(array('ID'=>$data['data_order']->id_website))->num_rows();

            if ($cek_data_website > 0) {
                $this->load->view('va_order_publish_proses',$data);
            }else{
                $this->session->set_flashdata('message', 'notfound');
                redirect(base_url().$this->controller);
            }





        }else{
        }
    }

    function update_status_website($id_order='',$id_website = '')
    {
            $status_website = $this->input->post('status_website');

        $update = $this->Model_website->update_data(array('ID'=> $id_website),array('status_website'=>$status_website));

        $this->session->set_flashdata('message', 'confirm');
        redirect(base_url().$this->controller.'/proses/publish/'.$id_order);

    }




    public function login()
    {
        $data['title_page'] = 'Login | Web Builder Goodeva';
    	$this->load->view('va_login',$data);
    }

    function create_session($data_admin) {
        
        // 1. Daftarkan Session
        $sess = array(
            'adminLogged'       => TRUE,
            'adminID'           => $data_admin->ID,
            'adminUsername'     => $data_admin->username,
            'adminNamaTampilan' => $data_admin->nama_tampilan,
            'adminLevel'        => $data_admin->level,
            'adminGambar'       => $data_admin->gambar
            
        );
        $this->session->set_userdata($sess);
            
        // 2. Redirect ke home
        redirect('admin-panel');

    }





   
	      
	    

	
}
