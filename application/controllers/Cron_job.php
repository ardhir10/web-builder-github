<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_job extends CI_Controller {


   public function __construct() {
        parent::__construct();
           $this->load->model('Model_user');
           $this->load->model('Model_order');
           $this->load->model('Email');
    }
    
    public function index()
    {
        $this->email_3day();
        $this->email_0day();
        $this->email_7day();
        $this->email_1day();
        $this->email_30day();
    }
    
     //email for status user
    public function email_3day()
    {
        $this->Email->email_3d();
    }
    public function email_0day()
    {
        $this->Email->email_0d();
    } 
    
    //email for subscription 
    public function email_7day()
    {
        $this->Email->email_7d();
    }
    public function email_30day()
    {
        $this->Email->email_30d();
    } 
    public function email_1day()
    {
        $this->Email->email_1d();
    }



}//end
