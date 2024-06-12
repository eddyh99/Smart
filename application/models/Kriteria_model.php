<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria_model extends CI_Model
{
    public function getListBobot()
    {		
		$sql = "SELECT * FROM tbl_kriteria";
		$query = $this->db->query($sql);
		return $query->result_array();
	}


    public function getListDetailKriteria()
    {		
		$sql = "SELECT a.*,b.namakriteria,b.bobot,b.sifat FROM `tbl_detailkriteria` a INNER JOIN tbl_kriteria b ON a.id_kriteria=b.id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

    


    public function insertBatchBobot($mdata)
    {		
		$this->db->trans_start();
        $result = $this->db->update_batch('tbl_kriteria', $mdata, "id");
        $this->db->trans_complete();

        if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
			return array(
                "code" => 511, 
                "message" => $error["message"]
            );
		} else {
			$this->db->trans_commit();
			return array(
                "code" => 200, 
                "message" => ""
            );
		}

	}
    
    public function getListBahan(){
        $sql = "SELECT a.*,b.detailkriteria as kualitas FROM `tbl_bahan` a INNER JOIN tbl_detailkriteria b ON detailkriteria_id=b.id;";
		$query = $this->db->query($sql);
		return $query->result_array();
    }
    
    public function getSingleKriteria($id)
    {
        $sql = "SELECT * FROM tbl_detailkriteria WHERE id=?";
        $query = $this->db->query($sql, $id);
		if ($query){
			return $query->row();
		}else{
			return $this->db->error();
		}
    }

    public function updateDetailKriteria($id, $mdata)
	{
		$this->db->where("id", $id);

		if ($this->db->update("tbl_detailkriteria", $mdata)){
            return array(
                "code"      => 200, 
                "message"   => ""
            );
		}else{
            return $this->db->error();
		}
	}
	
	public function getKualitas(){
        $sql = "SELECT id,detailkriteria as kualitas FROM tbl_detailkriteria WHERE id_kriteria=5";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function insertKualitas($mdata){
	    $result = $this->db->insert("tbl_bahan", $mdata);
        if ($result == 1){
            return array(
                "code"      => 200, 
                "message"   => ""
            );
		}else{
            return $this->db->error();
		}
	}
	
	public function get_editbahan($id){
	    $sql="SELECT * FROM tbl_bahan WHERE id=?";
		$query = $this->db->query($sql,$id);
		return $query->row();
	}
	
	public function updateKualitas($mdata,$id){
	    $this->db->where("id",$id);
        if ($this->db->update("tbl_bahan",$mdata)){
            return array(
                "code"      => 200, 
                "message"   => ""
            );
		}else{
            return $this->db->error();
		}
	    
	}
}