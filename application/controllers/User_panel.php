<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_panel extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->helper(array('Form', 'Cookie', 'String'));
        // cek session
        // if ($this->session->userdata('adminLogged') != TRUE) {
        //     redirect(base_url('Admin_panel/login'));
        // }
    }

    



    private $controller = 'User_panel';
   

    public function index()
    {
        // ambil cookie
      
        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'Dashboard User | Goodeva';

        $this->load->view('vu_dashboard',$data);

    	
    }

	
}
