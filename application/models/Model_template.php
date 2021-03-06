<?php

class Model_template extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    
    private $table = 'table_template';

 
	function edit_data($where){
		return $this->db->get_where($this->table,$where);
	}
    
    function cek_email($email){
        $this->db->where('email',$email);
        return $this->db->get($this->table)->num_rows();
        
    }

    function authentication_login($username,$password)
    {
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        return $this->db->get($this->table);
    }
    
    function authentication_email($email,$password)
    {
        $this->db->where('email',$email);
        $this->db->where('password',$password);
        return $this->db->get($this->table);
    }
    
    
	function get_data(){
        $this->db->order_by('ID','desc');
        return $this->db->get($this->table);
    }

    function get_dataByKategori($id_kategori){
        $this->db->where('id_kategori',$id_kategori);
        $this->db->order_by('ID','desc');
        return $this->db->get($this->table);
    }

    function get_data_new(){
        $this->db->order_by('ID','desc limit 3');
        return $this->db->get($this->table);
    }

    function get_data_free(){
        $this->db->where('id_type',1);
        $this->db->order_by('ID','desc');
        return $this->db->get($this->table);
    }

    function get_data_premium(){
        $this->db->where('id_type',2);
        $this->db->order_by('ID','desc');
        return $this->db->get($this->table);
    }
    
    
    function get_data_template(){
        $this->db->order_by('digunakan','desc');
         $this->db->limit(5);   
        return $this->db->get($this->table);
    }


	function insert_data($data){
     $this->db->insert($this->table,$data);
    }

  

	function update_data($where,$data){
		$this->db->where($where);
		$this->db->update($this->table,$data);
	}

	function delete_data($where){
		$this->db->where($where);
		$this->db->delete($this->table);
	}		
}

?>




