<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ApiEditor extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->model('Model_editor');
        $this->load->model('Model_website_page');
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

    function update_page()
    {
            $id          = $this->input->post('id');
            $id_user     = $this->session->userdata('userID');
            $judul_page  = $this->input->post('judul_page');   
            $css         = $this->input->post('css');
            $html_firts  = str_replace("'", "---?---?", $this->input->post('html'));
            $html        = str_replace('---?---?', '"', $html_firts);
       


        $data = array(

            // 'title'             => $title,
            'css'               => $css,
            'judul_page'        => $judul_page,
            'slug_id'           => $this->clean($judul_page),
            'html'              => $html,
            'tanggal_dibuat'    => date("Y-m-d H:i:s")
        );

        


        

        $update = $this->Model_website_page->update_page($id,$id_user,$data);
        echo json_encode($data);

    }

    function clean($string) {
       $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

       return preg_replace('/[^A-Za-z0-9\-]/', '', strtolower($string)); // Removes special chars.
    }

	
}
