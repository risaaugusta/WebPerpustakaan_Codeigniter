<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

        public function cek_login($where)
        {
            $query = $this->db->get_where('admin', $where)->num_rows();
             //get where itu select tapi kalo ada kondisinya kalo get select all
             // num rows itu untuk mengetahui berapa jumlah baris yang ter select

            return $query;
        }

}

/* End of file Login_model.php */

?>