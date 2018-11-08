<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ApiEditor extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->model('Model_editor');
        $this->load->helper(array('Form', 'Cookie', 'String'));
        // cek session
        // if ($this->session->userdata('adminLogged') != TRUE) {
        //     redirect(base_url('Admin_panel/login'));
        // }
    }

    



    private $controller = 'ApiEditor';
   

    public function index()
    {
        // ambil cookie
      
        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'Live Editor | Goodeva';

        $this->load->view('vu_editor',$data);

    	
    }


    function save()
    {
            $css         =   $this->input->post('css');
            // $html    = $_POST['html'];

            $html_firts  = str_replace("'", "---?---?", $this->input->post('html'));
            $html        = str_replace('---?---?', '"', $html_firts);
       


        $data = array(
            'css'  => $css,
            'html' => $html
        );

        $create = $this->Model_editor->create($data);

        echo "{}";
    }

	
}
