<?php

class Model_editor extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }



    private $table = 'table_website';
    
    function create($data)
    {
    	$insert = $this->db->insert($this->table,$data);
    	$afftectedRows = $this->db->affected_rows();
	    if ($afftectedRows > 0) {
	        return TRUE;
	    } else {
	        return FALSE;
	    }
        // die($insert);
    }


    function get_data_website()
    {
        $result = $this->db->get($this->table);
        return $result;
    }



    function get_data_anggota()
    {
        // $this->datatables->select('*');
        $this->datatables->select('ID,tabel_anggota.no_ktp as no_ktp,tabel_anggota.no_identitas as no_identitas,tabel_anggota.nama_lengkap as nama_lengkap,tabel_anggota.tanggal_lahir as tanggal_lahir,tabel_anggota.alamat as alamat,tabel_anggota.email as email,tabel_anggota.tanggal_daftar as tanggal_daftar,tabel_anggota.status as status,tabel_anggota.foto as foto ,tabel_anggota.jenis_kelamin as jenis_kelamin');
        $this->datatables->from('tabel_anggota');
        // $this->datatables->join('country', 'city.CountryCode = country.Code');
        // $this->datatables->add_column('view', '<a href="world/edit/$1">edit</a> | <a href="world/delete/$1">delete</a>', 'ID');
        return $this->datatables->generate();
    }


   

    function delete($where)
    {
        $this->db->where($where);
        $this->db->delete('table_users');

        $afftectedRows = $this->db->affected_rows();
        if ($afftectedRows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function edit_data($where){
        return $this->db->get_where($this->table,$where);
    }

    function update_data($where,$data){
        $this->db->where($where);
        $this->db->update('table_users',$data);
    }






    



}

?>




