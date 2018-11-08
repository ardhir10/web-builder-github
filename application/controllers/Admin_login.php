<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_login extends CI_Controller {

	function __construct(){
    parent::__construct();

        $this->load->model('admin_model/Model_admin_login');
        $this->load->helper(array('Form', 'Cookie', 'String'));

    }



    private $controller = 'Admin_login';
    // private $title_page = 'Admin_panel';

    public function index()
    {
    	//==== Inisiasi Awal 
    	$data['controller'] = $this->controller;


        $this->input->post('username');
        $this->input->post('password');
        $this->input->post('remember');

        

    	
    }


    function create_login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $remember = $this->input->post('remember');

        $cek_login = $this->Model_admin_login->authentication_login($username,$password)->num_rows();
        
        if($cek_login == TRUE){
            $data_admin = $this->Model_admin_login->authentication_login($username,$password)->row();
            
            // 1. Create cookie remember me
            if ($remember == TRUE) {
                $key = random_string('alnum', 64);
                set_cookie('gwb_cookie', $key, 3600*24*30); // set expired 30 hari kedepan
                
                // simpan key di database
                $update_key = array(
                    'cookie' => $key
                );
                $this->Model_admin_login->update($update_key, $data_admin->ID);
            }
            
            $this->create_session($data_admin);

        }else{
            echo "Username Password Salah";
        }
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

    function userLogout()
    {
        // delete cookie dan session
        delete_cookie('gwb_cookie');
        $this->session->sess_destroy();
        redirect(base_url().'Admin_panel');
    }

    
	
	 		
	      
	    

	
}
