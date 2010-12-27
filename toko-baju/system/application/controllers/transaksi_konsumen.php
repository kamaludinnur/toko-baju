<?php
class Transaksi_konsumen extends Controller {

    function Transaksi_konsumen()
    {
        parent::Controller();
        $this->load->model('Produk_model', 'produk');
        $this->load->model('Merek_model', 'merek');
        $this->load->model('Model_baju_model', 'model');
    }

    function index()
    {
        $data = new stdClass();
        $data->view_konten = 'transaksi_konsumen';
        $data->title = "Transaksi";
        $data->daftar_merek = $this->merek->get_semua_merek();
        $this->load->view('base', $data);
    }

    function model($merek)
    {
        $x = $this->model->get_semua_model_by_merek($merek);
        $data = new stdClass();
        $data->daftar_model = $x;
        $this->load->view('ajax_model', $data);
    }

    function warna($model)
    {
        $x = $this->produk->get_semua_warna_by_model($model);
        $data = new stdClass();
        $data->daftar_warna = $x;
        $data->model = $model;
        $this->load->view('ajax_warna', $data);
    }

}