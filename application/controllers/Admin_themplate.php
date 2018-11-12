<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_themplate extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->model('admin_model/Model_admin');
        $this->load->model('admin_model/Model_admin_login');
        $this->load->model('Model_editor_themplate');
        $this->load->helper(array('Form', 'Cookie', 'String'));

        // cek session
        if ($this->session->userdata('adminLogged') != TRUE) {
            redirect(base_url('Admin_panel/login'));
        }
    }

    



    private $controller = 'Admin_themplate';
   

    public function index()
    {

        // ambil cookie
        $cookie = get_cookie('gwb_cookie');
        
        // cek session
        if ($this->session->userdata('adminLogged')) {
            //==== Inisiasi Awal 
            $data['controller'] = $this->controller;
            $data['title_page'] = 'Data Themplate | Goodeva';
            $data['title_card'] = 'Data Themplate';

            $data['themplate_result'] = $this->Model_editor_themplate->get_data()->result();

            $this->load->view('va_themplate',$data);

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


    function add()
    {
        // ambil cookie
        $cookie = get_cookie('gwb_cookie');
        
        // cek session
        if ($this->session->userdata('adminLogged')) {
            //==== Inisiasi Awal 
            $data['controller'] = $this->controller;
            $data['title_page'] = 'Add Themplate | Goodeva';
            $data['title_card'] = 'Add Themplate';


            $this->load->view('va_themplate_editor',$data);

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


    function edit($id)
    {
        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'Edit Themplate | Goodeva';
        $data['title_card'] = 'Edit Themplate';


        $where = array(
            'ID' => $id
        );
        $data['data_edit']  = $this->Model_editor_themplate->edit_data($where)->row();
        $this->load->view('va_themplate_editor_edit',$data);
    }


    public function login()
    {
        $data['title_page'] = 'Login | Web Builder Goodeva';
    	$this->load->view('va_login',$data);
    }


    function preview($id)
    {

        $where = array(
            'ID' => $id
        );
        $data['data_edit']  = $this->Model_editor_themplate->edit_data($where)->row();
        $this->load->view('va_preview_themplate',$data);
    } 

    function create_session($data_admin) {
        
        // 1. Daftarkan Session
        $sess = array(
            'adminLogged'       => TRUE,
            'adminID'           => $data_admin->ID,
            'adminUsername'     => $data_admin->username,
            'adminNamaTampilan' => $data_admin->nama_tampilan,
            'adminLevel'        => $data_admin->level
        );
        $this->session->set_userdata($sess);
            
        // 2. Redirect ke home
        redirect('admin-panel');

    }





   
	      
	    

	
}
