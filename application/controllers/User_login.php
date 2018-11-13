<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_login extends CI_Controller {
     public function __construct() {
        parent::__construct();
           $this->load->model('Model_user');
    }
    

	
    private $controller = 'User_login';
	
  
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
           redirect('sites/register');
        }
        else {
            
                  $this->Model_user->insert_data($data_user);
              $this->session->set_flashdata('pesan','Berhasil ! silahkan Login');
            redirect('sites/login');
        }        
	}
    
    public function login(){
        
        $usernameoremail = $this->input->post('username');
        $password = md5($this->input->post('password'));


        $cek_login = $this->Model_user->authentication_login($usernameoremail,$password)->num_rows();
        $cek_email = $this->Model_user->authentication_email($usernameoremail,$password)->num_rows();
        
        if($cek_login == TRUE){
           
            $data_user = $this->Model_user->authentication_login($usernameoremail,$password)->row();
            $this->create_session($data_user);
         

        }else{
            
            
            if($cek_email == TRUE){
                
            $data_user = $this->Model_user->authentication_login($usernameoremail,$password)->row();
            $this->create_session($data_user);
                
            }
            else {
                $this->session->set_flashdata('pesan-login','Username atau Password Salah!');
                redirect('sites/login');
       
            }
          
        }
 
    }
    
    function create_session($data_user) {
        
        // 1. Daftarkan Session
        $sess = array(
            'userLogged'       => TRUE,
            'userID'           => $data_user->ID,
            'loginGoogle'       => 0,
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
    
      function userLogout()
    {
          
           $sess = array(
                    'userLogged'   ,
                   
                    'userID'         ,
                    'userEmail'       ,
                    'userNama'        ,
                    'userTelp'       ,
                    'userNamaweb'    ,
                    'userGambar'     ,
                );
          
          
          
        // delete cookie dan session

        $this->session->unset_userdata($sess);
          
      if ($this->session->userdata('loginGoogle')==1){
           redirect('https://accounts.google.com/Logout');
          
      }else {
           redirect(base_url().'sites/login');
      }
     
         
    
         
    }

    

}//end
