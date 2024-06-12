<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model{
    // private $table_pengguna = 'pengguna';

	public function VerifyLogin($mdata){
		$sql = "SELECT username, role, is_delete FROM tbl_user 
				WHERE username=? AND password=sha1(?)";
		$query = $this->db->query($sql, $mdata);
		// echo "<pre>".print_r($query,	true)."</pre>";
        // die;
        
		if ($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	}	
}
?>