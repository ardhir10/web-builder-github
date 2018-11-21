<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_website extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->model('Model_editor');
        $this->load->model('Model_template');
        $this->load->helper(array('Form', 'Cookie', 'String'));
        // cek session
        // if ($this->session->userdata('adminLogged') != TRUE) {
        //     redirect(base_url('Admin_panel/login'));
        // }
    }

    



    private $controller = 'User_website';
   

    public function index()
    {
        // ambil cookie
      
        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'Website User | Goodeva';


        $data['website'] = $this->Model_editor->get_data_website()->result();

        // print_r($data['website']);
        $this->load->view('vu_website',$data);

    	
    }

    function add()
    {
        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'New Website | Goodeva';


        $data['template_result'] = $this->Model_template->get_data()->result();
        // $this->load->view('va_template',$data);

        // print_r($data['website']);
        $this->load->view('vu_website_add',$data);
    }

	
}
