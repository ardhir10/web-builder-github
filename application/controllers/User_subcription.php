<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_subcription extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->helper(array('Form', 'Cookie', 'String'));
        $this->load->model('Model_editor');
        $this->load->model('Model_template');
        $this->load->model('Model_website');
        $this->load->model('Model_template_page');
        $this->load->model('Model_website_page');
        $this->load->model('ApiModelImage');
        // cek session
        // if ($this->session->userdata('adminLogged') != TRUE) {
        //     redirect(base_url('Admin_panel/login'));
        // }
         if ($this->session->userdata('userLogged') != TRUE) {
            redirect(base_url('sites/login'));
        }
    }

    



    private $controller = 'User_subcription';
   

    public function index()
    {
        // ambil cookie
        $id_user = $this->session->userdata('userID');
        
        $data['data_website'] = $this->Model_website->get_website($id_user)->result();

      
        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'User Subcription | Goodeva';

       
        $this->load->view('vu_subcription',$data);

    	
    }
    
    public function add_subcription(){
        $id_user = $this->session->userdata('userID');
        
        $data['data_website'] = $this->Model_website->get_website($id_user)->result();

      
        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'ADD Subcription | Goodeva';

       
        $this->load->view('vu_add_subcription',$data);
    }

	
}
