<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_login extends CI_Controller {
     public function __construct() {
        parent::__construct();
           $this->load->model('Model_user');
    }
    

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
    private $controller = 'User_login';
	
    public function index()
	{
        
         //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'Login Page | Goodeva';
        $data['get']=$this->input->get('p');
        
      
        
		$this->load->view('vu_login',$data);
	}
    public function register()
	{
        $nama=$this->input->post('nama');
        $email=$this->input->post('email');
        $password=$this->input->post('password');
        $pass=md5($password);
        $tanggal= date('Y-m-d H:i:s');
        $web=$this->input->post('web');
        
        $data_user = array (
        
            'nama'=>$nama,
            'username'=>$email,
            'email'=>$email,
            'password'=>$pass,
            'tanggal_daftar'=>$tanggal
        
        );
        

        
         $cek = $this->Model_user->cek_email($email);
        if( $cek==1 ){
            
            $this->session->set_flashdata('pesan','Email Anda Sudah Terdaftar');
           redirect('user-login?p=register');
        }
        else {
            
                  $this->Model_user->insert_data($data_user);
              $this->session->set_flashdata('pesan','Berhasil ! silahkan Login');
            redirect('user-login');
        }
        
        
        
        
        
	}
    
    public function login(){
        
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));


        $cek_login = $this->Model_user->authentication_login($username,$password)->num_rows();
        
        if($cek_login == TRUE){
           
            $data_user = $this->Model_user->authentication_login($username,$password)->row();
            $this->create_session($data_user);

        }else{
            $this->session->set_flashdata('pesan-login','Username atau Password Salah!');
            redirect('user-login');
        }
 
    }
    
    function create_session($data_user) {
        
        // 1. Daftarkan Session
        $sess = array(
            'userLogged'       => TRUE,
            'userID'           => $data_user->ID,
            'userEmail'        => $data_user->email,
            'userNama'         => $data_user->nama,
            'userTelp'         => $data_user->no_telp,
            'userNamaweb'      => $data_user->nama_web,
            'userGambar'       => $data_user->gambar
        );
        $this->session->set_userdata($sess);
            
        // 2. Redirect ke home
        
       redirect('user-panel');

    }

}//end
