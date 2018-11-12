<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ApiEditorThemplate extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->model('Model_editor');
        $this->load->model('Model_editor_themplate');
        $this->load->helper(array('Form', 'Cookie', 'String'));
        // cek session
        // if ($this->session->userdata('adminLogged') != TRUE) {
        //     redirect(base_url('Admin_panel/login'));
        // }
    }

    



    private $controller = 'ApiEditorThemplate';
   

    // public function index()
    // {
    //     // ambil cookie
      
    //     //==== Inisiasi Awal 
    //     $data['controller'] = $this->controller;
    //     $data['title_page'] = 'Live Editor | Goodeva';

    //     $this->load->view('vu_editor',$data);

    	
    // }


    function save()
    {
            $title       = $this->input->post('title_themplate');
            $css         = $this->input->post('css');
            $html_firts  = str_replace("'", "---?---?", $this->input->post('html'));
            $html        = str_replace('---?---?', '"', $html_firts);
       


        $data = array(

            'title'             => $title,
            'css'               => $css,
            'html'              => $html,
            'tanggal_dibuat'    => date("Y-m-d H:i:s")
        );

        $create = $this->Model_editor_themplate->create($data);

        echo "{}";
    }

    function update()
    {
            $id          = $this->input->post('id');
            $title       = $this->input->post('title_themplate');
            $css         = $this->input->post('css');
            $html_firts  = str_replace("'", "---?---?", $this->input->post('html'));
            $html        = str_replace('---?---?', '"', $html_firts);
       


        $data = array(

            'title'             => $title,
            'css'               => $css,
            'html'              => $html,
            // 'tanggal_dibuat'    => date("Y-m-d H:i:s")
        );

        $where = array(
            'ID' => $id            
        );

        $update = $this->Model_editor_themplate->update_data($where,$data);
        echo "{}";
    }

	
}
