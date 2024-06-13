<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model
{

    public function getProduk(){
        $sql = "SELECT 
			pr.id as idproduk, pr.nama as namaproduk, jp.jenis as jenisproduk, b.bahan as jenisbahan, pe.modal, pe.peminat, pe.jual, pe.laba 
		FROM tbl_penilaian pe
		INNER JOIN tbl_bahan b
			ON pe.bahan_id=b.id
		INNER JOIN tbl_produk pr
			ON pe.id_produk=pr.id
		INNER JOIN tbl_jenisproduk jp
			ON pr.id_jenis=jp.id";
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

	public function insertProduk($dataproduk, $penilaian)
	{
		$this->db->trans_start();
        $this->db->insert("tbl_produk", $dataproduk);
		$error = $this->db->error();
		$id = $this->db->insert_id();
		
		$penilaian['id_produk'] = $id;
		// echo '<pre>'.print_r($penilaian,true).'</pre>';
		// die;
        $this->db->insert("tbl_penilaian", $penilaian);
        $this->db->trans_complete();

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
            echo $error["message"];
			return array(
                "code" => 511, 
                "message" => $error["message"]
            );
		} else {
			$this->db->trans_commit();
            echo "SUKSES";
			return array(
                "code" => 200, 
                "message" => ""
            );
		}
	}

	public function deleteProduk($id)
	{
		$this->db->where('id', $id);
        $result = $this->db->delete('tbl_produk');

        if ($result == 1){
			return array(
				"code"      => 200, 
				"messages"   => ""
			);
		}else{
			return $this->db->error();
		}
	}
}