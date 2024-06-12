<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model
{

    public function getData()
    {		
		$sql = "SELECT 
                p.id AS ProductID,
                p.nama AS ProductName,
                MAX(CASE 
                    WHEN k.id = 1 AND pen.modal BETWEEN dk.nmin AND dk.nmax THEN dk.nilai 
                END) AS ModalNilai,
                MAX(CASE 
                    WHEN k.id = 2 AND pen.peminat BETWEEN dk.nmin AND dk.nmax THEN dk.nilai 
                END) AS PeminatNilai,
                MAX(CASE 
                    WHEN k.id = 3 AND pen.laba BETWEEN dk.nmin AND dk.nmax THEN dk.nilai 
                END) AS LabaNilai,
                MAX(CASE 
                    WHEN k.id = 4 AND pen.jual BETWEEN dk.nmin AND dk.nmax THEN dk.nilai 
                END) AS HargaJualNilai,
                MAX(CASE 
                    WHEN k.id = 5 THEN dk.nilai 
                END) AS KualitasNilai
            FROM 
                tbl_produk p
            JOIN 
                tbl_penilaian pen ON p.id = pen.id_produk
            JOIN 
                tbl_bahan b ON pen.bahan_id = b.id
            JOIN 
                tbl_detailkriteria dk ON (
                    (dk.id_kriteria = 1 AND pen.modal BETWEEN dk.nmin AND dk.nmax) OR
                    (dk.id_kriteria = 2 AND pen.peminat BETWEEN dk.nmin AND dk.nmax) OR
                    (dk.id_kriteria = 3 AND pen.laba BETWEEN dk.nmin AND dk.nmax) OR
                    (dk.id_kriteria = 4 AND pen.jual BETWEEN dk.nmin AND dk.nmax) OR
                    (dk.id_kriteria = 5 AND b.detailkriteria_id = dk.id)
                )
            JOIN 
                tbl_kriteria k ON dk.id_kriteria = k.id
            GROUP BY 
                p.id, p.nama;";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getBobot(){
	    $sql="SELECT id, namakriteria, bobot FROM tbl_kriteria";
	    $query=$this->db->query($sql);
	    return $query->result_array();
	}
	
	public function getMaxMin(){
	    $sql="SELECT 
                id_kriteria, 
                MIN(nilai) as Cmin, 
                MAX(nilai) as Cmax 
            FROM 
                tbl_detailkriteria 
            GROUP BY 
                id_kriteria";
	    $query=$this->db->query($sql);
	    return $query->result_array();
	}
}