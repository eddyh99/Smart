<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
			redirect('/');
		}
        $this->load->model('Produk_model', 'produk');

    }

    public function index()
    {

        $data = array(
            'title'             => NAMETITLE . ' | Produk',
            'content'           => 'admin/produk/index',
            'extra'             => 'admin/produk/js/_js_index',
            'produk_active'     => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function list_produk()
    {
        $produk =  $this->produk->getProduk();

        echo json_encode($produk);
    }

    public function tambah_produk()
    {
        $data = array(
            'title'         => NAMETITLE . ' | Tambah Produk',
            'content'       => 'admin/produk/tambah_produk',
            'produk_active'   => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function tambah_proses()
    {
        $this->form_validation->set_rules('produk', 'Nama Produk', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
			redirect("produk/tambah_produk");
			return;
		}

        $input      = $this->input;
        $produk     = $this->security->xss_clean($input->post('produk'));

        $mdata = array(
            "namaproduk"    => $produk,
            "userid"        => $_SESSION["logged_status"]["username"],
            "created_at"    => date("Y-m-d H:i:s"),
            "updated_at"    => date("Y-m-d H:i:s"),
        );

        $result = $this->produk->insertProduk($mdata);

        if($result['code'] == 200) {
            $this->session->set_flashdata('success', $result['messages']);
            redirect('produk');
            return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
            redirect('produk/tambah_produk');
            return;
        }
    }

    public function edit_produk($id)
    {

        $id_produk	= base64_decode($this->security->xss_clean($id));
        $result = $this->produk->getEditProduk($id_produk);

        // echo '<pre>'.print_r($result,true).'</pre>';
        // die;
        $data = array(
            'title'         => NAMETITLE . ' | Tambah Produk',
            'content'       => 'admin/produk/edit_produk',
            'produk_active'   => 'active',
            'produk'        => $result
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function editproduk_proses()
    {
        $this->form_validation->set_rules('id', 'ID Produk', 'trim|required');
        $this->form_validation->set_rules('produk', 'Nama Produk', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
			redirect("produk/edit_produk");
			return;
		}

        $input      = $this->input;
        $id     = $this->security->xss_clean($input->post('id'));
        $produk     = $this->security->xss_clean($input->post('produk'));

        $mdata = array(
            "namaproduk"    => $produk,
            "userid"        => $_SESSION["logged_status"]["username"],
            "updated_at"    => date("Y-m-d H:i:s"),
        );

        $result = $this->produk->updateProduk($id, $mdata);

        if($result['code'] == 200) {
            $this->session->set_flashdata('success', $result['messages']);
            redirect('produk');
            return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
            redirect('produk/edit_produk');
            return;
        }
    }

    public function delete_produk($id){
        $id_produk	= base64_decode($this->security->xss_clean($id));
        $result = $this->produk->deleteProduk($id_produk);

        if($result['code'] == 200) {
            $this->session->set_flashdata('success', $this->message->delete_msg());
            redirect('produk');
            return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
            redirect('produk');
            return;
        }
    }


    public function list_penjualan()
    {

        $data = array(
            'title'             => NAMETITLE . ' | List Penjualan',
            'content'           => 'admin/produk/list_penjualan',
            'extra'             => 'admin/produk/js/_js_penjualan',
            'penjualan_active'  => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function list_allpenjualan()
    {
        $penjualan =  $this->produk->getListPenjualan();
        echo json_encode($penjualan);
    }

    public function penjualan()
    {
        $produk =  $this->produk->getProduk();

        $data = array(
            'title'             => NAMETITLE . ' | Penjualan',
            'content'           => 'admin/produk/penjualan',
            'extra'             => 'admin/produk/js/_js_penjualan',
            'penjualan_active'  => 'active',
            'produk'            => $produk,
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }


    public function penjualan_proses()
    {
        $this->form_validation->set_rules('produk', 'Nama Produk', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('total', 'Total', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
			redirect("produk/penjualan");
			return;
		}

        $input      = $this->input;
        $produk     = $this->security->xss_clean($input->post('produk'));
        $tanggal    = $this->security->xss_clean($input->post('tanggal'));
        $total    = $this->security->xss_clean($input->post('total'));

        $mdata = array(
            "id_produk"    => $produk,
            "tanggal"   => $tanggal.'-01',
            "total"     => $total
        );
        
        
        $result = $this->produk->insertPenjualan($mdata);
        // echo '<pre>'.print_r($result,true).'</pre>';
        // die;

        if($result['code'] == 200) {
            $this->session->set_flashdata('success', $result['messages']);
            redirect('produk/list_penjualan');
            return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
            redirect('produk/penjualan');
            return;
        }
    }

}