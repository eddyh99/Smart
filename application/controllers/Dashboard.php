<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
			redirect('/');
		}
        //$this->load->model('Penduduk_model', 'penduduk');

    }

    public function index()
    {
        // echo "<pre>".print_r($_SESSION['logged_status'],true)."</pre>";
        // die;

        $data = array(
            "penduduk"      =>  0,//$this->penduduk->count_penduduk(),
            "diajukan"      =>  0,//$this->penduduk->count_maju(),
            "ditolak"       =>  0,//$this->penduduk->count_tolak(),
            "disetujui"     =>  0,//$this->penduduk->count_setujui(),
            'title'         => NAMETITLE . ' | Dashboard',
            'content'       => 'admin/dashboard/index',
            'extra'         => 'admin/dashboard/js/_js_index',
            'dash_active'   => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

}
