<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_user extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->model('admin_model/Model_admin');
        $this->load->model('admin_model/Model_admin_login');
        $this->load->model('Model_user');
        $this->load->model('Model_package');
        $this->load->helper(array('Form', 'Cookie', 'String'));

        // cek session
        if ($this->session->userdata('adminLogged') != TRUE) {
            redirect(base_url('Admin_panel/login'));
        }
    }

    



    private $controller = 'Admin_user';
   

    public function index()
    {

        // ambil cookie
        $cookie = get_cookie('gwb_cookie');
        
        // cek session
        if ($this->session->userdata('adminLogged')) {
            //==== Inisiasi Awal 
            $data['controller']         = $this->controller;
            $data['title_page']         = 'Data User | Goodeva';
            $data['data_user']          = $this->Model_user->get_data()->result();
            $data['data_user_status']   = $this->db->get('table_status')->result();
            $data['data_package']       = $this->Model_package->get_data()->result();



            $this->load->view('va_user',$data);

        } else if($cookie <> '') {
            // cek cookie
            $row = $this->Model_admin_login->get_by_cookie($cookie)->row();
            if ($row) {
                $this->create_session($row);
            } else {
                redirect(base_url('Admin_panel/login'));
            }
        } else {
                $this->login();
        }
    	
    }


    function edit($id)
    {
        $data['controller']         = $this->controller;
        $data['title_page']         = 'Edit User Package | Goodeva';

        $where = array(
            'ID' => $id
        );
        $data['data_user']          = $this->Model_user->edit_data($where)->row();
        $data['data_status']        = $this->db->get('table_status')->result();
        $data['data_package']       = $this->Model_package->get_data()->result();


        $this->load->view('va_user_edit',$data);
    }

    function update()
    {
        $id         = $this->input->post('id');
        $id_status  = $this->input->post('status');
        $id_package = $this->input->post('package');
        $expired    = $this->input->post('expired');

        $data = array(
            'id_status'  => $id_status,
            'id_package' => $id_package,
            'expired'    => $expired,
        );
        $where = array(
            'ID' => $id
        );

        $update = $this->Model_user->update_data($where,$data);
        $this->session->set_flashdata('status_update','Data Berhasil diupdate');
        redirect(base_url().$this->controller);
    }


    public function login()
    {
        $data['title_page'] = 'Login | Web Builder Goodeva';
    	$this->load->view('va_login',$data);
    }

    function create_session($data_admin) {
        
        // 1. Daftarkan Session
        $sess = array(
            'adminLogged'       => TRUE,
            'adminID'           => $data_admin->ID,
            'adminUsername'     => $data_admin->username,
            'adminNamaTampilan' => $data_admin->nama_tampilan,
            'adminLevel'        => $data_admin->level,
            'adminGambar'       => $data_admin->gambar
            
        );
        $this->session->set_userdata($sess);
            
        // 2. Redirect ke home
        redirect('admin-panel');

    }





   
	      
	    

	
}
