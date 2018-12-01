<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_order extends CI_Controller {

	function __construct(){
    parent::__construct();
        $this->load->model('admin_model/Model_admin');
        $this->load->model('admin_model/Model_admin_login');
        $this->load->model('Model_user');
        $this->load->model('Model_package');
        $this->load->model('Model_kategori');
        $this->load->model('Model_order');
        $this->load->helper(array('Form', 'Cookie', 'String'));

        // cek session
        if ($this->session->userdata('adminLogged') != TRUE) {
            redirect(base_url('Admin_panel/login'));
        }
    }


    
    



    private $controller = 'Admin_order';
   

    public function index()
    {

        // ambil cookie
        $cookie = get_cookie('gwb_cookie');
        
        // cek session
        if ($this->session->userdata('adminLogged')) {
            //==== Inisiasi Awal 
            $data['controller']         = $this->controller;
            $data['title_page']         = 'Data Order | Goodeva';
            $data['data_order']         = $this->Model_order->get_data()->result();
            $data['data_user']          = $this->Model_user->get_data()->result();

            $this->load->view('va_order',$data);

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


    function create()
    {
        $nama_kategori = $this->input->post('nama_kategori');

        $data = array(
            'nama_kategori' => $nama_kategori,
        );

        $insert = $this->Model_kategori->insert_data($data);

        $this->session->set_flashdata('status_tambah','Data Berhasil ditambahkan');
        redirect(base_url().$this->controller);
    }

    function delete($id)
    {
        $id = $this->input->post('id');

        $where = array(
            'ID' => $id
        );

        $this->Model_kategori->delete_data($where);

        echo '{}';
    }

    function edit($id)
    {
        $data['controller']         = $this->controller;
        $data['title_page']         = 'Edit Data Kategori | Goodeva';

        $where = array(
            'ID' => $id
        );
        $data['data_kategori_edit']  = $this->Model_kategori->edit_data($where)->row();

        // print_r($data['data_package_edit']);

        $this->load->view('va_kategori_edit',$data);
    }

    function update()
    {
        $id           = $this->input->post('id');
        $nama_kategori = $this->input->post('nama_kategori');



        $data = array(
            'nama_kategori' => $nama_kategori,
        );
        $where = array(
            'ID' => $id
        );
        $update = $this->Model_kategori->update_data($where,$data);
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