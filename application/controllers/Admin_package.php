<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_package extends CI_Controller {

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


    
    



    private $controller = 'admin_package';
   

    public function index()
    {

        // ambil cookie
        $cookie = get_cookie('gwb_cookie');
        
        // cek session
        if ($this->session->userdata('adminLogged')) {
            //==== Inisiasi Awal 
            $data['controller']         = $this->controller;
            $data['title_page']         = 'Data Package | Goodeva';
            $data['data_package']       = $this->Model_package->get_data()->result();

            $this->load->view('va_package',$data);

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
        $nama_package = $this->input->post('nama_package');
        $harga        = $this->input->post('harga');
        $keterangan   = $this->input->post('keterangan');

        $data = array(
            'nama_package' => $nama_package,
            'harga'        => $harga,
            'keterangan'   => $keterangan
        );

        $insert = $this->Model_package->insert_data($data);

        $this->session->set_flashdata('status_tambah','Data Berhasil ditambahkan');
        redirect(base_url().$this->controller);
    }

    function delete($id)
    {
        $id = $this->input->post('id');

        $where = array(
            'ID' => $id
        );

        $this->Model_package->delete_data($where);

        echo '{}';
    }

    function edit($id)
    {
        $data['controller']         = $this->controller;
        $data['title_page']         = 'Edit Data Package | Goodeva';

        $where = array(
            'ID' => $id
        );
        $data['data_package_edit']  = $this->Model_package->edit_data($where)->row();

        // print_r($data['data_package_edit']);

        $this->load->view('va_package_edit',$data);
    }

    function update()
    {
        $id           = $this->input->post('id');
        $nama_package = $this->input->post('nama_package');
        $harga        = $this->input->post('harga');
        $keterangan   = $this->input->post('keterangan');

        $data = array(
            'nama_package' => $nama_package,
            'harga'        => $harga,
            'keterangan'   => $keterangan
        );
        $where = array(
            'ID' => $id
        );
        $update = $this->Model_package->update_data($where,$data);
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
