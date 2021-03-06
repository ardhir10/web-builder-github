<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ApiEditorTemplate extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->model('Model_editor');
        $this->load->model('Model_editor_template');
        $this->load->model('Model_template_page');
        $this->load->helper(array('Form', 'Cookie', 'String'));
     
    }

    



    private $controller = 'ApiEditorTemplate';
   

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
            // $title       = $this->input->post('title_template');
            $css         = $this->input->post('css');
            $html_firts  = str_replace("'", "---?---?", $this->input->post('html'));
            $html        = str_replace('---?---?', '"', $html_firts);
       


        $data = array(

            // 'title'             => $title,
            'css'               => $css,
            'html'              => $html,
            'tanggal_dibuat'    => date("Y-m-d H:i:s")
        );

        $create = $this->Model_template_page->insert_data($data);

        echo "{}";
    }

    function update()
    {
            $id          = $this->input->post('id');
            $title       = $this->input->post('title_template');
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


        $where = array(
            'ID' => $id            
        );

        $update = $this->Model_template_page->update_data($where,$data);
        echo "{}";
    }

    function clean($string) {
       $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

       return preg_replace('/[^A-Za-z0-9\-]/', '', strtolower($string)); // Removes special chars.
    }

	
}
