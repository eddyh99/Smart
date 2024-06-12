<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval_model extends CI_Model
{
    public function get_approval_survey()
    {		
		$sql = "SELECT nkk, nik, nama, tempat, tanggal_lahir, 
                agama, umur, pendidikan, alamat, pekerjaan, kriteria, is_survey FROM tbl_penduduk 
                WHERE is_delete='no' AND is_survey='no' AND is_pilih='yes' AND kriteria IS NULL AND alasan IS NULL";
		$query = $this->db->query($sql);
        
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

    public function approve_survey($nik, $mdata)
    {
        $this->db->where("nik", $nik);
		if ($this->db->update("tbl_penduduk", $mdata)){
            return array(
                "code"      => 200, 
                "message"   => ""
            );
		}else{
            return $this->db->error();
		}
    }

    public function tolak_approval($nik, $mdata)
    {
        $this->db->where("nik", $nik);
		if ($this->db->update("tbl_penduduk", $mdata)){
            return array(
                "code"      => 200, 
                "message"   => ""
            );
		}else{
            return $this->db->error();
		}
    }
    public function get_approval_kades()
    {		
		$sql = "SELECT nkk, nik, nama, tempat, tanggal_lahir, 
                agama, umur, pendidikan, alamat, pekerjaan, kriteria, is_survey, is_kades FROM tbl_penduduk 
                WHERE is_delete='no' AND is_kades='no' AND is_survey='yes'";
		$query = $this->db->query($sql);
        
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

    public function approve_kades($nik, $mdata)
    {
        $this->db->where("nik", $nik);
		if ($this->db->update("tbl_penduduk", $mdata)){
            return array(
                "code"      => 200, 
                "message"   => ""
            );
		}else{
            return $this->db->error();
		}
    }
}