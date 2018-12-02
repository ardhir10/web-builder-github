<?php

class Model_order extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    
    private $table = 'table_order';

 
	function edit_data($where){
        $this->db->order_by('ID','desc');
		return $this->db->get_where($this->table,$where);
	}
    
    function cek_email($email){
        $this->db->where('email',$email);
        return $this->db->get($this->table)->num_rows();
        
    }

    function authentication_sub($id_user)
    {
        $this->db->where('id_user',$id_user);
        $this->db->where('type_order','package');
        return $this->db->get($this->table);
    }

    function cek_order($id,$id_user,$type)
    {
        $this->db->where('id_user',$id_user);
        $this->db->where('ID',$id);
        $this->db->where('type_order',$type);
        return $this->db->get($this->table);
    }

    function delete_sub_by_user($id_order,$id_user)
    {
        $this->db->where('ID',$id_order);
        $this->db->where('id_user',$id_user);
        $this->db->delete($this->table);
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

    public function generate_publish_code() {
          $this->db->select('RIGHT(table_order.no_order,4) as kode', FALSE);
          $this->db->order_by('ID','DESC');    
          $this->db->limit(1);    
          $this->db->like('no_order','PUB');
          $query = $this->db->get('table_order');      //cek dulu apakah ada sudah ada kode di tabel.    
          if($query->num_rows() <> 0){      
           //jika kode ternyata sudah ada.      
           $data = $query->row();      
           $kode = intval($data->kode) + 1;    
          }
          else {      
           //jika kode belum ada      
           $kode = 1;    
          }

          $tanggal = date('Y');
          $unik = time();
          $kodemax = str_pad($kode, 1, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
          $kodejadi = "PBL".$tanggal.$unik.'-'.$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi;  
    }	

    public function generate_package_code() {
          $this->db->select('RIGHT(table_order.no_order,4) as kode', FALSE);
          $this->db->order_by('ID','DESC');    
          $this->db->limit(1);    
          $this->db->like('no_order','PUB');
          $query = $this->db->get('table_order');      //cek dulu apakah ada sudah ada kode di tabel.    
          if($query->num_rows() <> 0){      
           //jika kode ternyata sudah ada.      
           $data = $query->row();      
           $kode = intval($data->kode) + 1;    
          }
          else {      
           //jika kode belum ada      
           $kode = 1;    
          }

          $tanggal = date('Y');
          $unik = time();
          $kodemax = str_pad($kode, 1, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
          $kodejadi = "PKG".$tanggal.$unik.'-'.$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi;  
    }   
}

?>




