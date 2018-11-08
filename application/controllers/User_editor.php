<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_editor extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->model('Model_editor');
        $this->load->helper(array('Form', 'Cookie', 'String'));
        // cek session
        // if ($this->session->userdata('adminLogged') != TRUE) {
        //     redirect(base_url('Admin_panel/login'));
        // }
    }

    



    private $controller = 'User_editor';
   

    public function index()
    {
        // ambil cookie
      
        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'Live Editor | Goodeva';

        $this->load->view('vu_editor',$data);
    }


    function website($link)
    {
        $where = array(
            'ID' => $link
        );

        $data['data_web'] = $this->Model_editor->edit_data($where)->row();

        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'Live Editor | Goodeva';

        $this->load->view('vu_editor',$data);

    }

	
}
