<?php
defined('BASEPATH') OR exit('No direct sscript access allowed');
class User_subscription extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->helper(array('Form', 'Cookie', 'String'));
        $this->load->model('Model_editor');
        $this->load->model('Model_template');
        $this->load->model('Model_website');
        $this->load->model('Model_template_page');
        $this->load->model('Model_website_page');
        $this->load->model('Model_order');
        $this->load->model('Model_user');
        $this->load->model('Model_package');
        $this->load->model('ApiModelImage');
        $this->load->model('Model_type_template');

         if ($this->session->userdata('userLogged') != TRUE) {
            redirect(base_url('sites/login'));
        }
        date_default_timezone_set("Asia/Jakarta");
        $this->cek_expired();


        // Status Order ID
        // 1 = Void , 
        // 2 = Waiting Payment , 
        // 3 = Payment Received, 
        // 4 = Payment Verified , 
        // 5 = Cancelled


    }

    // IMPORTANT SUBSCRIPTION = ORDER
    // IMPORTANT SUBSCRIPTION = ORDER
    // IMPORTANT SUBSCRIPTION = ORDER
    // IMPORTANT SUBSCRIPTION = ORDER
    // IMPORTANT SUBSCRIPTION = ORDER
    // IMPORTANT SUBSCRIPTION = ORDER
    // IMPORTANT SUBSCRIPTION = ORDER
    // IMPORTANT SUBSCRIPTION = ORDER
    // IMPORTANT SUBSCRIPTION = ORDER

    private $controller = 'User_subscription';


    // Status Order ID
    // 1 = Void , 
    // 2 = Waiting Payment , 
    // 3 = Payment Received, 
    // 4 = Payment Verified , 
    // 5 = Cancelled
    // 6 = Expired

    function cek_expired()
    {
        $data_order = $this->Model_order->edit_data(array('id_user'=>$this->session->userdata('userID')))->result();

        $tgl_now = date('Y-m-d H:i:s'); 

        


        foreach ($data_order as $row) {

            $tgl_exp = $row->expired;//tanggal expired
             // Jika Ditemukan Maka data diupdate jadi Expired
            if ($tgl_now >= $tgl_exp )
            {
                // Jika Expired
                $update_data = $this->Model_order->update_data(array('ID'=>$row->ID),array('status'=> 6));
            }
            

           
        }
    }
   

    public function index()
    {
        // ambil cookie
        $id_user = $this->session->userdata('userID');
        
        $data['data_website'] = $this->Model_website->get_website($id_user)->result();

      
        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'User Subscription | Goodeva';
        $data['data_subscription'] = $this->Model_order->edit_data(array('id_user'=>$id_user))->result();
        $data['status_order'] = $this->db->get('table_status_order')->result();

       
        $this->load->view('vu_subscription',$data);

    	
    }
    
    public function add(){
        $id_user = $this->session->userdata('userID');
        
        $data['data_website'] = $this->Model_website->get_website($id_user)->result();
      
        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'Add Subscription | Goodeva';


        $data['data_package'] = $this->Model_package->edit_data(array('status'=>'package'))->result();

        $cek_sub = $this->Model_order->authentication_sub($id_user)->num_rows();


        if($cek_sub > 0)
        {
            $this->session->set_flashdata('message','exist');
            redirect(base_url().$this->controller);
        }else{
            $this->load->view('vu_subscription_add',$data);
        }

       
    }


    function edit($type = '',$id_order= '')
    {
        $id_user = $this->session->userdata('userID');
        $data['data_website'] = $this->Model_website->get_website($id_user)->result();
      
        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'Edit Subscription | Goodeva';

        $cek_data = $this->Model_order->cek_order($id_order,$id_user,$type)->num_rows();
        $data['data_package'] = $this->Model_package->edit_data(array('status'=>$type))->result();

        // cek Status 

        


        if ($cek_data > 0) {
            $data['data_order'] = $this->Model_order->cek_order($id_order,$id_user,$type)->row();

            if ($data['data_order']->status != 1 && $data['data_order']->status != 2 && $data['data_order']->status != 5   ) {
                redirect(base_url().$this->controller);
            }
            $this->load->view('vu_subscription_edit', $data );


        }else{
            redirect(base_url().$this->controller);
        }
    }


    function confirm_subscription($type = '',$id_order= '')
    {
        $id_user = $this->session->userdata('userID');
        $data['data_website'] = $this->Model_website->get_website($id_user)->result();
      
        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'Confirm Subscription | Goodeva';

        $cek_data = $this->Model_order->cek_order($id_order,$id_user,$type)->num_rows();

        $data['data_package'] = $this->Model_package->edit_data(array('status'=>$type))->result();

         if ($cek_data > 0) {
            $data['data_order'] = $this->Model_order->cek_order($id_order,$id_user,$type)->row();
            $this->load->view('vu_subscription_confirm', $data );
        }else{
            redirect(base_url().$this->controller);
        }

    }

    function save_confirm($type = '',$id_order = '')
    {
        $id_user = $this->session->userdata('userID');
        $id_order;

        $gambar_old = $this->input->post('gambar_old');
        $jumlah_bayar = $this->input->post('jumlah_bayar');

        $cek_data = $this->Model_order->cek_order($id_order,$id_user,$type)->num_rows();

        // Status Order ID
        // 1 = Void , 
        // 2 = Waiting Payment , 
        // 3 = Payment Received, 
        // 4 = Payment Verified , 
        // 5 = Cancelled

        $data = array(
            'jumlah_bayar' => $jumlah_bayar,
            'update_date'  => date('Y-m-d H:i:s'),
        );

        if ($cek_data > 0) {
            $data_order = $this->Model_order->cek_order($id_order,$id_user,$type)->row();


            $config['upload_path'] = './assets/images/confirm/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = $id_user.time().'-confirm';
            $config['max_size'] = '2048';

            $this->load->library('upload',$config);

            if ($_FILES['gambar']['name']) {
                if ($this->upload->do_upload('gambar')) {
                    $image = $this->upload->data();
                    $data['bukti_pembayaran'] = $image['file_name'];
                    $data['status'] = 3;

                    if ($gambar_old != '') {
                        unlink('./assets/images/confirm/'.$gambar_old);
                    }

                    $this->session->set_flashdata('message','confirm');
                    $this->Model_order->update_data(array('ID'=>$id_order),$data);
                    redirect(base_url().$this->controller);

                }else{
                    // Jika Upload Gagal
                    $this->session->set_flashdata('message','image');
                    redirect(base_url().$this->controller.'/confirm_subscription/'.$type.'/'.$id_order);

                }
            }else{
                // Jika Gambar tidak Lengkap

                // Jika Status Masih Void Maka Harus Memasukkan Bukti
                if ($data_order->status == 1) {
                    $this->session->set_flashdata('message', 'failed');
                    redirect(base_url().$this->controller.'/confirm_subscription/'.$type.'/'.$id_order);
                }else{
                    $this->session->set_flashdata('message','confirm');
                    $this->Model_order->update_data(array('ID'=>$id_order),$data);
                    redirect(base_url().$this->controller);
                }
               
            }


        }else{
            redirect(base_url().$this->controller);
        }

    }


    function add_subscription()
    {
        $id_user = $this->session->userdata('userID');

        $id_package = $this->input->post('id_package');

        $data_package = $this->Model_package->edit_data(array('ID'=> $id_package))->row();

        $no_order = $this->Model_order->generate_package_code();



        $data = array(

            'no_order'          => $no_order,
            'id_user'           => $id_user,
            'status'            => 1,
            'id_package'        => $data_package->ID,
            'nama_package'      => $data_package->nama_package,
            'nama_website'      => '-',
            'expired'           => date('Y-m-d H:i:s', time() + (60 * 60 * 24)),
            'harga'             => $data_package->harga,
            'type_order'        => $data_package->status,
            'tanggal_order'     => date('Y-m-d H:i:s'),
        );

        // Update Status Website

        $create_order = $this->Model_order->insert_data($data);

        $this->session->set_flashdata('message','add');
        echo json_encode($data);

        // redirect(base_url().$this->controller);
    }


    function perpanjang_package($type = '' , $id_order = '' )
    {
        $id_user = $this->session->userdata('userID');
        $cek_data = $this->Model_order->cek_order($id_order,$id_user,$type)->num_rows();
        $no_order = $this->Model_order->generate_package_code();


        if ($cek_data > 0) {
            $data_order = $this->Model_order->cek_order($id_order,$id_user,$type)->row();

            // Buat Data perpanjangan
            $data = array(
                'no_order'          => $no_order,
                'id_user'           => $id_user,
                'status'            => 2,
                'id_package'        => $data_order->id_package,
                'nama_package'      => $data_order->nama_package,
                'nama_website'      => '-',
                'expired'           => date('Y-m-d H:i:s', time() + (60 * 60 * 24)),
                'harga'             => $data_order->harga,
                'type_order'        => $data_order->type_order,
                'tanggal_order'     => date('Y-m-d H:i:s'),
            );

            $create_order = $this->Model_order->insert_data($data);
            $this->session->set_flashdata('message','add');
            redirect(base_url().$this->controller);

        }else{
            redirect(base_url().$this->controller);
        }

    }

    function update($id_order = '')
    {   
        $id_package = $this->input->post('id_package');

        $data_package = $this->Model_package->edit_data(array('ID'=>$id_package))->row();

        $data = array(
            'id_package' => $id_package,
            'nama_package' => $data_package->nama_package,
            'harga' => $data_package->harga,
        );
        $this->session->set_flashdata('status_update','Data berhasil di Update');

        $update = $this->Model_order->update_data(array('ID'=>$id_order),$data);
        echo json_encode($data);
    }

    function delete($id_order)
    {
        $id_order;
        $id_user = $this->session->userdata('userID');

        $data_order = $this->Model_order->edit_data(array('ID'=>$id_order))->row();

        if ($data_order->id_website != 0) {
            $update = $this->Model_website->update_website(array('ID' => $data_order->id_website ),array('status_website' => 'Not Published'));
        }

        unlink('./assets/images/confirm/'.$data_order->bukti_pembayaran);

        $delete = $this->Model_order->delete_sub_by_user($id_order,$id_user);
        $this->session->set_flashdata('message','delete');
        redirect(base_url().$this->controller);

    }

    function generate()
    {
        echo $this->Model_order->generate_package_code();
    }

	
}
