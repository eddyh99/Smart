<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
			redirect('/');
		}
        $this->load->model('Kriteria_model', 'kriteria');

    }

    public function index()
    {
        $listBobot =  $this->kriteria->getListBobot();

        $result = $this->kriteria->getListDetailKriteria();

        $data = array(
            'title'             => NAMETITLE . ' | Kriteria',
            'content'           => 'admin/kriteria/index',
            'extra'             => 'admin/kriteria/js/_js_index',
            'kriteria_active'   => 'active',
            'bobot'             =>  $listBobot,
            'kriteria'          => $result
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function proses_editkriteria()
    {
        $this->form_validation->set_rules('modal', 'Modal', 'trim|required');
        $this->form_validation->set_rules('peminat', 'Peminat', 'trim|required');
        $this->form_validation->set_rules('laba', 'Laba', 'trim|required');
        $this->form_validation->set_rules('hargajual', 'hargajual', 'trim|required');
        $this->form_validation->set_rules('kualitas', 'kualitas', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
			redirect("kriteria");
			return;
		}

        $input      = $this->input;
        $modal    = $this->security->xss_clean($input->post('modal'));
        $peminat  = $this->security->xss_clean($input->post('peminat'));
        $laba     = $this->security->xss_clean($input->post('laba'));
        $hargajual         = $this->security->xss_clean($input->post('hargajual'));
        $kualitas         = $this->security->xss_clean($input->post('kualitas'));

        $mdata = array(
            array(
                "id"    => "1",
                "bobot" => $modal
            ),
            array(
                "id"    => "2",
                "bobot" => $peminat
            ),
            array(
                "id"    => "3",
                "bobot" => $laba
            ),
            array(
                "id"    => "4",
                "bobot" => $hargajual
            ),
            array(
                "id"    => "5",
                "bobot" => $kualitas
            ),
        );
        
        $result = $this->kriteria->insertBatchBobot($mdata);

        if($result['code'] == 200) {
            $this->session->set_flashdata('success', $this->message->success_edit_msg());
            redirect('kriteria');
            return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
            redirect('kriteria');
            return;
        }
    }

    public function getAllDetail()
    {
        $result = $this->kriteria->getListDetailKriteria();
        echo json_encode($result);
    }

    public function edit_detailkriteria($id)
    {
        
        $id_kriteria	= base64_decode($this->security->xss_clean($id));
        $result = $this->kriteria->getSingleKriteria($id_kriteria);

        $data = array(
            'title'         => NAMETITLE . ' | Edit kriteria',
            'content'       => 'admin/kriteria/edit_detail',
            'kriteria_active'   => 'active',
            'kriteria'          => $result
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function editkriteria_proses()
    {
        $this->form_validation->set_rules('id', 'ID Kriteria', 'trim|required');
        $this->form_validation->set_rules('nmin', 'Nilai Min', 'trim|required');
        $this->form_validation->set_rules('nmax', 'Nilai Max', 'trim|required');
        $this->form_validation->set_rules('bobot', 'Bobot', 'trim|required');

        
        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
			redirect("kriteria");
			return;
		}

        $input          = $this->input;
        $id             = $this->security->xss_clean($input->post('id'));
        $nmin           = $this->security->xss_clean($input->post('nmin'));
        $detail         = $this->security->xss_clean($input->post('detail'));
        $nmax           = $this->security->xss_clean($input->post('nmax'));
        $bobot           = $this->security->xss_clean($input->post('bobot'));

        $mdata = array(
            "nmin"      => $nmin,
            "nmax"      => $nmax,
            "detailkriteria"    => $detail,
            "nilai"     => $bobot
        );

        $result = $this->kriteria->updateDetailKriteria($id, $mdata);
        
        if($result['code'] == 200) {
            $this->session->set_flashdata('success', $this->message->success_msg());
            redirect('kriteria');
            return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
            redirect('kriteria/edit_kriteria');
            return;
        }
    }
    
    public function bahan()
    {
        $data = array(
            'title'             => NAMETITLE . ' | Kualitas Bahan',
            'content'           => 'admin/bahan/index',
            'extra'             => 'admin/bahan/js/_js_index',
            'bahan_active'   => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }
    
    public function getAllBahan()
    {
        $result = $this->kriteria->getListBahan();
        echo json_encode($result);
    }
    
    public function tambah_bahan(){
        $kualitas = $this->kriteria->getKualitas();

        $data = array(
            'title'             => NAMETITLE . ' | Kualitas Bahan',
            'content'           => 'admin/bahan/tambah_bahan',
            'bahan_active'   => 'active',
            'kualitas'      => $kualitas
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }
    
    public function tambahbahan_proses(){
        $this->form_validation->set_rules('bahan', 'Bahan', 'trim|required');
		$this->form_validation->set_rules('kualitas', 'Kualitas Bahan', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
			redirect("kriteria/tambah_bahan");
			return;
		}

        
        $input      = $this->input;
        $bahan   = $this->security->xss_clean($input->post('bahan'));
        $kualitas     = $this->security->xss_clean($input->post('kualitas'));

        $datas = array(
            "bahan"          => $bahan, 
            "detailkriteria_id" => $kualitas,
        );


        $result = $this->kriteria->insertKualitas($datas);
  

        if($result['code'] == 200) {
            $this->session->set_flashdata('success', $this->message->success_msg());
			redirect('kriteria/bahan');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect('kriteria/tambah_bahan');
			return;
        }
    }
    
    public function edit_bahan($id){
        $id	= base64_decode($this->security->xss_clean($id));
        $result = $this->kriteria->get_editbahan($id);
        $kualitas = $this->kriteria->getKualitas();

        $data = array(
            'title'             => NAMETITLE . ' | Kualitas Bahan',
            'content'           => 'admin/bahan/edit_bahan',
            'bahan_active'   => 'active',
            'bahan'      => $result,
            'kualitas'      => $kualitas
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }
    
    
    
    
    public function editbahan_proses(){
        $this->form_validation->set_rules('idbahan', 'ID Bahan', 'trim|required');
        $this->form_validation->set_rules('bahan', 'Bahan', 'trim|required');
		$this->form_validation->set_rules('kualitas', 'Kualitas Bahan', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
			redirect("kriteria/tambah_bahan");
			return;
		}

        
        $input      = $this->input;
        $idbahan   = $this->security->xss_clean($input->post('idbahan'));
        $bahan   = $this->security->xss_clean($input->post('bahan'));
        $kualitas     = $this->security->xss_clean($input->post('kualitas'));

        $datas = array(
            "bahan"          => $bahan, 
            "detailkriteria_id" => $kualitas,
        );


        $result = $this->kriteria->updateKualitas($datas,$idbahan);
  

        if($result['code'] == 200) {
            $this->session->set_flashdata('success', $this->message->success_msg());
			redirect('kriteria/bahan');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect('kriteria/tambah_bahan');
			return;
        }
    }
}