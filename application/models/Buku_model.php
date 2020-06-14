<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_model extends CI_Model {

    public function getBuku() //ini akan get semua data dari table buku
    {           
        // $query_str = "SELECT * FROM buku"; //cuma string query 
        // $query =  $this->db->query($query_str)->result_array();// hasil eksekusi string query di atas
        $query = $this->db->get('buku')->result_array();
        return $query; 
    }

    public function tambah_data($data) // untuk nampung array tadi di controller Buku
    {
       $this->db->insert('buku', $data);
    }

    function edit_data($where){		
       $query = $this->db->get_where('buku',$where)->row_array();
       return $query;
    }
   
    function update_data($where,$data){
        $this->db->where($where);
        $this->db->update('buku', $data);
    }	
    
    function hapus_data($where,$buku){
		$this->db->where($where);
		$this->db->delete($buku);
	}

    public function search($keyword)
    {
        // $query=$this->db->query('SELECT * FROM buku WHERE judul LIKE "%' . $keyword . '%"' . 
        // 'OR penulis LIKE "%' . $keyword . '%"' . 
        // 'OR tahun_terbit LIKE "%' . $keyword . '%"')->result_array();
      
        $this->db->like('judul',$keyword);
        $this->db->OR_LIKE('penulis',$keyword);
        $this->db->OR_LIKE('tahun_terbit',$keyword);

        $query = $this->db->get('buku')->result_array();
        return $query;
    } 

    public function getBukuById($where)
    {
        $this->db->join('genre','buku.id_genre = genre.id_genre','left');
        
        $query = $this->db->get_where('buku',$where)->row_array();
        return $query;
    }

    public function getGenre()
    {
        $query = $this->db->get('genre')->result_array();
        return $query;
    }
}

?>

<!-- Catatan -->
<!-- result_array(); ini jadi array | echo $row['judu']
     result(); ini jadi object      | echo $row->judul
     row_array();
     row();
     
     -->