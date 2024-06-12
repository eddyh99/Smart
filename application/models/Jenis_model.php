<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_model extends CI_Model
{

    public function getListJenis(){
        $sql = "SELECT * FROM `tbl_jenisproduk`";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
    

	public function insertJenis($mdata){
	    $result = $this->db->insert("tbl_jenisproduk", $mdata);
        if ($result == 1){
            return array(
                "code"      => 200, 
                "message"   => ""
            );
		}else{
            return $this->db->error();
		}
	}
	
	public function get_editjenis($id){
	    $sql="SELECT * FROM tbl_jenisproduk WHERE id=?";
		$query = $this->db->query($sql,$id);
		return $query->row();
	}
	
	public function updateJenis($mdata,$id){
	    $this->db->where("id",$id);
        if ($this->db->update("tbl_jenisproduk",$mdata)){
            return array(
                "code"      => 200, 
                "message"   => ""
            );
		}else{
            return $this->db->error();
		}
	    
	}
}