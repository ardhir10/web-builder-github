<?php

class ApiModelImage extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    
    private $table = 'table_gambar_user';

 
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

    function cek_slug_page($id_website,$slug_id,$id_user)
    {
        $this->db->where('id_website',$id_website);
        $this->db->where('slug_id',$slug_id);
        $this->db->where('id_user',$id_user);
        return $this->db->get($this->table);
    }
    
    
	function get_data(){
        $this->db->order_by('ID','desc');
        return $this->db->get($this->table);
    }
    function get_template_image(){
        $this->db->order_by('ID','desc');
        return $this->db->get('table_gambar_template');
    }

    function get_my_image($id_user){
        $this->db->where('id_user',$id_user);
        $this->db->order_by('ID','desc');
        return $this->db->get($this->table);
    }

    function get_page($id_website,$id_user){
        $this->db->where('id_website',$id_website);
        $this->db->where('id_user',$id_user);
        return $this->db->get($this->table);
    }

    function get_index($id_website,$id_user){
        $this->db->where('id_website',$id_website);
        $this->db->where('id_user',$id_user);
        $this->db->where('type_page','index');
        return $this->db->get($this->table);
    }

    function get_data_free(){
        $this->db->where('id_type',1);
        $this->db->order_by('ID','desc');
        return $this->db->get($this->table);
    }

    function get_page_child($id_website,$slug_id_page,$id_user){
        $this->db->where('slug_id',$slug_id_page);
        $this->db->where('id_website',$id_website);
        $this->db->where('id_user',$id_user);
        return $this->db->get($this->table);
    }

    

    function get_data_premium(){
        $this->db->where('id_type',2);
        $this->db->order_by('ID','desc');
        return $this->db->get($this->table);
    }


	function insert_data($data){
     $this->db->insert($this->table,$data);
    }

    function insert_data_template($data){
     $this->db->insert('table_gambar_template',$data);
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

    function delete_image($gambar,$id_user){
        $this->db->where('gambar',$gambar);
        $this->db->where('id_user',$id_user);
        $this->db->delete($this->table);
    }

    function delete_image_template($gambar){
        $this->db->where('gambar',$gambar);
		$this->db->delete('table_gambar_template');
	}

    function update_index($id_page,$id_website,$data,$id_user)
    {
        $this->db->where('ID',$id_page);
        $this->db->where('id_website',$id_website);
        $this->db->where('id_user',$id_user);
        $this->db->update($this->table,$data);
    }

    function remove_index($id_website,$data,$id_user)
    {
        $this->db->where('id_website',$id_website);
        $this->db->where('id_user',$id_user);
        $this->db->where('type_page','index');
        $this->db->update($this->table,$data);
    }

    function update_page($id_page,$id_user,$data)
    {
        $this->db->where('ID',$id_page);
        $this->db->where('id_user',$id_user);
        $this->db->update($this->table,$data);
    }		
}

?>




