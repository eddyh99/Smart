<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Smart extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
			redirect('/');
		}
        $this->load->model('Data_model', 'datasmart');

    }

    public function index()
    {
        $products=$this->datasmart->getData();
        $kriteria=$this->datasmart->getBobot();
        $kriteria_values = $this->datasmart->getMaxMin();

        //Normalisasi bobot
        $total_bobot = array_sum(array_column($kriteria, 'bobot'));
        foreach ($kriteria as &$k) {
            $k['normalized_bobot'] = $k['bobot'] / $total_bobot;
        }

        //Normalisasi Matriks Keputusan
        $cmin_cmax = [];
        foreach ($kriteria_values as $kv) {
            $cmin_cmax[$kv['id_kriteria']] = [
                'Cmin' => $kv['Cmin'],
                'Cmax' => $kv['Cmax']
            ];
        }
        
        // Apply the formulas
        foreach ($products as &$product) {
            $product['K1'] = ($cmin_cmax[1]['Cmax'] - $product['ModalNilai']) / ($cmin_cmax[1]['Cmax'] - $cmin_cmax[1]['Cmin']);
            $product['K2'] = ($product['PeminatNilai'] - $cmin_cmax[2]['Cmin']) / ($cmin_cmax[2]['Cmax'] - $cmin_cmax[2]['Cmin']);
            $product['K3'] = ($product['LabaNilai'] - $cmin_cmax[3]['Cmin']) / ($cmin_cmax[3]['Cmax'] - $cmin_cmax[3]['Cmin']);
            $product['K4'] = ($cmin_cmax[4]['Cmax'] - $product['HargaJualNilai']) / ($cmin_cmax[4]['Cmax'] - $cmin_cmax[4]['Cmin']);
            $product['K5'] = ($product['KualitasNilai'] - $cmin_cmax[5]['Cmin']) / ($cmin_cmax[5]['Cmax'] - $cmin_cmax[5]['Cmin']);
        }

        //Normalisasi Data Set dengan Normalisasi Bobot
        foreach ($products as &$product) {
            $product['NormalizedScore'] = 
                $product['K1'] * $kriteria[0]['normalized_bobot'] +
                $product['K2'] * $kriteria[1]['normalized_bobot'] +
                $product['K3'] * $kriteria[2]['normalized_bobot'] +
                $product['K4'] * $kriteria[3]['normalized_bobot'] +
                $product['K5'] * $kriteria[4]['normalized_bobot'];
        }

        //Perangkingan
        usort($products, function($a, $b) {
            return $b['NormalizedScore'] <=> $a['NormalizedScore'];
        });

        
        foreach ($products as $rank => &$product) {
            $product['Rank'] = $rank + 1;
        }


        // Display the ranked products
        foreach ($products as $dt) {
            echo "Rank: {$dt['Rank']} : {$dt['ProductName']}, Score: {$dt['NormalizedScore']}<br>";
        }
    }
}
