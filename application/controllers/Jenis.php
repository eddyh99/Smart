<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
			redirect('/');
		}
        $this->load->model('Jenis_model', 'jenis');

    }

    public function index()
    {
        $data = array(
            'title'             => NAMETITLE . ' | Jenis Produk',
            'content'           => 'admin/jenis/index',
            'extra'             => 'admin/jenis/js/_js_index',
            'jenis_active'   => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }
    
    public function getAllJenis()
    {
        $result = $this->jenis->getListJenis();
        echo json_encode($result);
    }
    
    public function tambah_jenis(){
        $data = array(
            'title'             => NAMETITLE . ' | Jenis Produk',
            'content'           => 'admin/jenis/tambah_jenis',
            'jenis_active'   => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }
    
    public function tambahjenis_proses(){
        $this->form_validation->set_rules('jenis', 'Jenis Produk', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
			redirect("jenis/tambah_jenis");
			return;
		}

        
        $input      = $this->input;
        $jenis   = $this->security->xss_clean($input->post('jenis'));

        $datas = array(
            "jenis"          => $jenis, 
        );


        $result = $this->jenis->insertJenis($datas);
  

        if($result['code'] == 200) {
            $this->session->set_flashdata('success', $this->message->success_msg());
			redirect('jenis');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect('jenis/tambah_jenis');
			return;
        }
    }
    
    public function edit_jenis($id){
        $id	= base64_decode($this->security->xss_clean($id));
        $result = $this->jenis->get_editjenis($id);

        $data = array(
            'title'             => NAMETITLE . ' | Jenis Produk',
            'content'           => 'admin/jenis/edit_jenis',
            'jenis_active'   => 'active',
            'jenis'      => $result,
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }
    
    
    
    
    public function editjenis_proses(){
        $this->form_validation->set_rules('idjenis', 'ID Jenis', 'trim|required');
        $this->form_validation->set_rules('jenis', 'Jenis Produk', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
			redirect("jenis/tambah_jenis");
			return;
		}

        
        $input      = $this->input;
        $idjenis   = $this->security->xss_clean($input->post('idjenis'));
        $jenis   = $this->security->xss_clean($input->post('jenis'));

        $datas = array(
            "jenis"          => $jenis, 
        );


        $result = $this->jenis->updateJenis($datas,$idjenis);
  

        if($result['code'] == 200) {
            $this->session->set_flashdata('success', $this->message->success_msg());
			redirect('jenis');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect('jenis/tambah_jenis');
			return;
        }
    }
}