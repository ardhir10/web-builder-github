<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_panel extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->model('admin_model/Model_admin');
        $this->load->model('Model_template');
        $this->load->model('Model_user');
        $this->load->model('admin_model/Model_admin_login');
        $this->load->helper(array('Form', 'Cookie', 'String'));


        


        

        

    }



    private $controller = 'Admin_panel';
   

    public function index()
    {

        // ambil cookie
        $cookie = get_cookie('gwb_cookie');
        
        // cek session
        if ($this->session->userdata('adminLogged')) {
            //==== Inisiasi Awal 
            $data['controller'] = $this->controller;
            $data['title_page'] = 'Web Builder | Goodeva';
            $data['data_user'] =  $this->Model_user->get_data()->num_rows();
            $data['user_trial'] = $this->Model_user->edit_data(array('id_status'=>1))->num_rows();
            $data['user_aktif'] = $this->Model_user->edit_data(array('id_status'=>2))->num_rows();
            $data['user_suspened'] = $this->Model_user->edit_data(array('id_status'=>3))->num_rows();
            $data['jumlah_template'] =  $this->Model_template->get_data_template()->result();
            $data['data_template'] =  $this->Model_template->get_data()->num_rows();
           
            $this->load->view('va_dashboard',$data);

            
            
        } else if($cookie <> '') {
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


    function create()
    {
        $username       = $this->input->post('username');
        $password       = $this->input->post('password');
        $remember       = $this->input->post('remember');
        $nama_tampilan  = 'Ramadhan';

        $datetime = date("Y-m-d H:i:s");

        $data     = array(
            'username'       => $username,
            'password'       => md5($password),
            'tanggal_dibuat' => $datetime,
            'nama_tampilan'  => $nama_tampilan
        );
       $insert = $this->Model_admin->create($data);    
    }


    function userLogout()
    {
        // delete cookie dan session
        // delete_cookie('ar_cookie');
        $this->session->sess_destroy();
        // redirect(base_url().'login');
    }


    function testpage()
    {
        $data['title_page'] = 'Test | Web Builder Goodeva';
        $this->load->view('va_starterpage',$data);
    }

	
	 		
	      
	    

	
}
