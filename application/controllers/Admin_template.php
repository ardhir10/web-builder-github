<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_template extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->model('admin_model/Model_admin');
        $this->load->model('admin_model/Model_admin_login');
        $this->load->model('Model_editor_template');
        $this->load->helper(array('Form', 'Cookie', 'String'));

        // cek session
        if ($this->session->userdata('adminLogged') != TRUE) {
            redirect(base_url('Admin_panel/login'));
        }
    }

    



    private $controller = 'Admin_template';
   

    public function index()
    {

        // ambil cookie
        $cookie = get_cookie('gwb_cookie');
        
        // cek session
        if ($this->session->userdata('adminLogged')) {
            //==== Inisiasi Awal 
            $data['controller'] = $this->controller;
            $data['title_page'] = 'Data Template | Goodeva';
            $data['title_card'] = 'Data Template';

            $data['template_result'] = $this->Model_editor_template->get_data()->result();

            $this->load->view('va_template',$data);

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
            $data['title_page'] = 'Add Template | Goodeva';
            $data['title_card'] = 'Add Template';


            $this->load->view('va_template_editor',$data);

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
        $data['title_page'] = 'Edit Template | Goodeva';
        $data['title_card'] = 'Edit Template';


        $where = array(
            'ID' => $id
        );
        $data['data_edit']  = $this->Model_editor_template->edit_data($where)->row();
        $this->load->view('va_template_editor_edit',$data);
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
        $data['data_edit']  = $this->Model_editor_template->edit_data($where)->row();
        $this->load->view('va_preview_template',$data);
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
