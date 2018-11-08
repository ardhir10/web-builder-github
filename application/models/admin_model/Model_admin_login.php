<?php

class Model_admin_login extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }

    
    private $table = "table_admin";
    private $pk = "ID";


    function loginAttempt($where)
    {
        $login_authentication_result = $this->db->get_where('table_users',$where);
        return $login_authentication_result->num_rows();
    }

    function authUserLogin($username)
    {   
        $this->db->where('username', $username);
        return $this->db->get($this->table);
        
    }


    function authentication_login($username,$password)
    {
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        return $this->db->get($this->table);
    }

     // update user cokiee
    public function update($data, $id_user)
    {
        $this->db->where($this->pk, $id_user);
        $this->db->update($this->table, $data);
    }


        
    // ambil data berdasarkan cookie
    public function get_by_cookie($cookie)
    {
        $this->db->where('cookie', $cookie);
        return $this->db->get($this->table);
    }




}

?>




