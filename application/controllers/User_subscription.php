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
        // cek session
        // if ($this->session->userdata('adminLogged') != TRUE) {
        //     redirect(base_url('Admin_panel/login'));
        // }
         if ($this->session->userdata('userLogged') != TRUE) {
            redirect(base_url('sites/login'));
        }
        date_default_timezone_set("Asia/Jakarta");

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


        if ($cek_data > 0) {
            $data['data_order'] = $this->Model_order->cek_order($id_order,$id_user,$type)->row();
            $this->load->view('vu_subscription_edit', $data );
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

        $delete = $this->Model_order->delete_sub_by_user($id_order,$id_user);
        $this->session->set_flashdata('message','delete');
        redirect(base_url().$this->controller);

    }

    function generate()
    {
        echo $this->Model_order->generate_package_code();
    }

	
}
