<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    private $controller = 'welcome';
	
    public function index()
	{
        
         //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'Landing Page | Goodeva';
		$this->load->view('vu_landing',$data);
	}
    
    public function register()
    {
    
        $data['title_page'] = 'Register Page | Goodeva';
		$this->load->view('vu_register',$data);
        
    }
    
}//end
