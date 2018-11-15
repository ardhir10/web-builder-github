<?php

class Model_template_page extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    
    private $table = 'table_template_page';

 
	function edit_data($where){
		return $this->db->get_where($this->table,$where);
	}


    function get_index($id_template){
        $this->db->where('type_page','index');
        $this->db->where('id_template',$id_template);
        return $this->db->get($this->table);
    }

    function get_page_child($id_template,$slug_id_page){
        $this->db->where('slug_id',$slug_id_page);
        $this->db->where('id_template',$id_template);
        return $this->db->get($this->table);
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

    function get_page($id_template)
    {
        $this->db->where('id_template',$id_template);
        return $this->db->get($this->table);
    }

    function get_page_detail($id_template)
    {
        $this->db->where('ID',$id_template);
        return $this->db->get($this->table);
    }


	function insert_data($data){
     $this->db->insert($this->table,$data);
	}

    function insert_page($data){
     $this->db->insert_batch($this->table,$data);
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




