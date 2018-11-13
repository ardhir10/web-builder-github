<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Authentication extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        
        // Load google oauth library
        $this->load->library('google');
        
        // Load user model
        $this->load->model('user');
        $this->load->model('Model_user');
    }
    
    public function index(){
        // Redirect to profile page if the user already logged in
        if($this->session->userdata('loggedIn') == true){
            redirect('user-panel');
        }
        
        if(isset($_GET['code'])){
            
            // Authenticate user with google
            if($this->google->getAuthenticate()){
            
                // Get user info from google
                $gpInfo = $this->google->getUserInfo();
                
                // Preparing data for database insertion
                $userData['oauth_provider'] = 'google';
                $userData['oauth_uid']         = $gpInfo['id'];
                $userData['first_name']     = $gpInfo['given_name'];
                $userData['last_name']         = $gpInfo['family_name'];
                $userData['email']             = $gpInfo['email'];
                $userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:'';
                $userData['locale']         = !empty($gpInfo['locale'])?$gpInfo['locale']:'';
                $userData['link']             = !empty($gpInfo['link'])?$gpInfo['link']:'';
                $userData['picture']         = !empty($gpInfo['picture'])?$gpInfo['picture']:'';
                
                //inisiasi variable
                $nama=$userData['first_name'].$userData['last_name'];
                $email=$userData['email'];
                $password=$userData['oauth_uid'];
                $pass=md5($password);
                $tanggal= date('Y-m-d H:i:s');
                $exp =  date('Y-m-d H:i:s', time() + (60 * 60 * 24 * 15));
               
                  //database variable
                 $data_user = array (

                'nama'=>$nama,
                'username'=>$email,
                'email'=>$email,
                'password'=>$pass,
                'tanggal_daftar'=>$tanggal,
                'expired'    => $exp 

                );
                
                // 1. Daftarkan Session
                $sess = array(
                    'userLogged'       => TRUE,
                    'loginGoogle'       => 1,
                    'userID'           => '',
                    'userEmail'        => $userData['email'],
                    'userNama'         => $nama   ,
                    'userTelp'         => '',
                    'userNamaweb'      => '',
                    'userGambar'       => $userData['picture']
                );
                
                
                $email=$userData['email'];
                //cek email
                $cek = $this->Model_user->cek_email($email);
                if( $cek==1 ){
            
                $this->session->set_userdata($sess);
                redirect(base_url().'user-panel');
                }
                else {
            
                $this->Model_user->insert_data($data_user);
                $this->session->set_userdata($sess);
                redirect(base_url().'user-panel');
                }        
                
                
                
                
                
                
                
              
               
                 

                
                
                
                // Insert or update user data to the database
               // $userID = $this->user->checkUser($userData);
                
                // Store the status and user profile info into session
                $this->session->set_userdata('loggedIn', true);
                $this->session->set_userdata('userData', $userData);
                
                // Redirect to profile page
                redirect('user-panel');
            }
        } 
        
        // Google authentication url
        $data['loginURL'] = $this->google->loginURL();
        
        redirect($data['loginURL']);
    }
    
    
    
    
    
    
    
    
    
    public function profile(){
        // Redirect to login page if the user not logged in
        if(!$this->session->userdata('loggedIn')){
            redirect('/user_authentication/');
        }
        
        // Get user info from session   
        $data['userData'] = $this->session->userdata('userData');
        
        // Load user profile view
        $this->load->view('user_authentication/profile',$data);
    }
    
    public function logout(){
        // Delete login status & user info from session
        $this->session->unset_userdata('loggedIn');
        $this->session->unset_userdata('userData');
        $this->session->sess_destroy();
        $gClient->revokeToken();
        
        // Redirect to login page
        redirect('/user_authentication/');
    }
    
}