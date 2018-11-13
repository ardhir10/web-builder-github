<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sites extends CI_Controller {


    private $controller = 'sites';
	
    public function index()
	{
        
         //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'Landing Page | Goodeva';
		$this->load->view('vu_landing',$data);
	}
    
    public function login()
	{
        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'Login Page | Goodeva';
		$this->load->view('vu_login',$data);
	}

	public function register()
	{
        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'Login Page | Goodeva';
		$this->load->view('vu_register',$data);
	}



}//end
