<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_panel extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->helper(array('Form', 'Cookie', 'String'));
        $this->load->model('Model_editor');
        $this->load->model('Model_template');
        $this->load->model('Model_website');
        $this->load->model('Model_order');
        $this->load->model('Model_user');
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

    



    private $controller = 'User_panel';
   

    public function index()
    {
        // ambil cookie
        $id_user = $this->session->userdata('userID');
        
        $data['data_website'] = $this->Model_website->get_website($id_user)->result();

        $where=array(
        'id_user'=>$id_user
        );
        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'Dashboard User | Goodeva';
        $data['data_order'] = $this->Model_order->edit_data($where)->num_rows();
        $data['order'] = $this->Model_order->edit_data($where)->result();
        $data['tagihan']    = $this->db->query("SELECT SUM(harga)as total FROM table_order where id_user='$id_user' AND status=1 ")->row();
        $data['jum_website'] = $this->Model_website->edit_data($where)->num_rows(); 
        $data['status_order']= $this->db->query("select * from table_status_order ")->result();
        $data['data_user']=$this->Model_user->edit_data(array('ID'=>$id_user))->row();
        
        $id_status=$data['data_user']->id_status;
        $data['status_user']= $this->db->query("select * from table_status where id=$id_status")->row();
       
        $this->load->view('vu_dashboard',$data);
       
        
       
    	
    }

	
}
