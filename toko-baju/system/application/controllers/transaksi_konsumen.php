<?php
class Transaksi_konsumen extends Controller {

    function Transaksi_konsumen()
    {
        parent::Controller();
        $this->load->model('Produk_model', 'produk');
        $this->load->model('Merek_model', 'merek');
        $this->load->model('Model_baju_model', 'model');
        $this->load->model('Transaksi_konsumen_model', 'transaksi_konsumen');
    }

    function index()
    {
        $info = "";
        if ($this->input->post('submit')) {
            $add = $this->add($this->input->post('id'), $this->input->post('jumlah'));
            if (!$add) $info = "Stok Tidak mencukupi";
        }
        $data = new stdClass();
        $data->info = $info;
        $data->view_konten = 'transaksi_konsumen';
        $data->title = "Transaksi";
        $data->daftar_merek = $this->merek->get_semua_merek();
        $this->load->view('base', $data);
    }
    function bayar(){
        foreach($this->cart->contents() as $item){
            $this->transaksi_konsumen->tambah_transaksi($item['id'], $item['qty']);
        }
        $this->cart->destroy();
        redirect('/transaksi_konsumen');
    }
    function batal(){
        $this->cart->destroy();
    }
    function add($produk, $jumlah)
    {
        $produk = $this->produk->get_produk_by_id($produk);
        if($produk->stok<$jumlah){ return false;}
        else {
        $data = array(
            'id'    => $produk->id,
            'qty'   => $jumlah,
            'price' => $produk->harga_jual,
            'name'  => $produk->model,
            'merek' => $produk->merek,
            'warna' => $produk->warna,
            'ukuran'=> $produk->ukuran
        );
        $this->cart->insert($data);
        return true;
        }
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
        $data->model_baju = $model;
        $this->load->view('ajax_warna', $data);
    }

    function ukuran($model, $warna)
    {
        $x = $this->produk->get_semua_ukuran($model, $warna);
        $data = new stdClass();
        $data->daftar_ukuran = $x;
        $data->model = $model;
        $data->warna = $warna;
        $this->load->view('ajax_ukuran', $data);
    }

}