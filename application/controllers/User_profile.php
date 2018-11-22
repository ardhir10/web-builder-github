<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_profile extends CI_Controller {

	function __construct(){
    parent::__construct();
         $this->load->model('Model_user');
        $this->load->helper(array('Form', 'Cookie', 'String'));
        // cek session
        // if ($this->session->userdata('adminLogged') != TRUE) {
        //     redirect(base_url('Admin_panel/login'));
        // }
         if ($this->session->userdata('userLogged') != TRUE) {
            redirect(base_url('sites/login'));
        }
    }

    



    private $controller = 'User_profile';
   

    public function index()
    {
        // ambil cookie
      
        //==== Inisiasi Awal 
        $data['controller'] = $this->controller;
        $data['title_page'] = 'Profile User | Goodeva';
         $id_user = $this->session->userdata('userID');
        $where = array (
        'ID'=>$id_user,
        );
        
        $data['user'] = $this->Model_user->edit_data($where)->row();
        
        $this->load->view('vu_user_profile',$data);

    	
    }
    
     function update()
    {
        $nama         = $this->input->post('nama');
        $telp         = $this->input->post('telp');
        $email        = $this->input->post('email');
        $email_lama        = $this->input->post('email_lama');
        $username         = $this->input->post('username');
        $username_lama         = $this->input->post('username_lama');
        $password         = md5($this->input->post('password'));
       
        if (!password==''){
         $data = array(
            'nama'  => $nama,
            'no_telp' => $telp,
            'email' => $email,
            'username'    => $username,
            
        );
        }else{
            $data = array(
            'nama'  => $nama,
            'no_telp' => $telp,
            'email' => $email,
            'username'    => $username,
            'password'    => $password,
        );
            
            
        }
         
          $where = array(
            'ID' => $this->session->userdata('userID')
        );
         
         //pengecekan username&email
         
         $cek = $this->Model_user->cek_email($email);         
         $cek_username = $this->Model_user->cek_username($username);  
         
         if ($email==$email_lama){
             
             if( $username==$username_lama ){
            
            $update = $this->Model_user->update_data($where,$data);
            $this->session->set_flashdata('pesan','ok');
            redirect('user_profile');
        
          } 
             else{
           
                if( $cek_username==1 ){
            
                $this->session->set_flashdata('pesan','sudah ada2');
                redirect('user_profile');
        
                } else{
                $update = $this->Model_user->update_data($where,$data);
                $this->session->set_flashdata('pesan','ok');
                redirect('user_profile');
                
            }
            }
             
             
             
         }//endif 
         
         else {
             
        if( $cek==1 ){
         $this->session->set_flashdata('pesan','sudah ada');
         redirect('user_profile');
        }
        else {
            
                if( $username==$username_lama ){

                $update = $this->Model_user->update_data($where,$data);
                $this->session->set_flashdata('pesan','ok');
                redirect('user_profile');

                 } 
                else
                {

                if( $cek_username==1 )
                {
                $this->session->set_flashdata('pesan','sudah ada2');
                redirect('user_profile');
                } 
                else
                {
                $update = $this->Model_user->update_data($where,$data);
                $this->session->set_flashdata('pesan','ok');
                redirect('user_profile');
                }
             
             }
         }
       
        }//end else
         
         
        //redirect(base_url().$this->controller);
    }

	
}