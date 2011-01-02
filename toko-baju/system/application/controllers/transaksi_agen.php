<?php
class Transaksi_agen extends Controller {

    function Transaksi_agen()
    {
        parent::Controller();
        $this->load->model('Produk_model', 'produk');
        $this->load->model('Merek_model', 'merek');
        $this->load->model('Model_baju_model', 'model');
        $this->load->model('Transaksi_agen_model', 'transaksi_agen');
        $this->load->model('Agen_model', 'agen');
    }

    function index()
    {
        if($this->session->userdata('transaksi')!='transaksi_agen'){
            $this->cart->destroy();
            $this->session->set_userdata('transaksi', 'transaksi_agen');
            $this->session->unset_userdata('id_agen');
        }
        if(!$this->session->userdata('id_agen')) redirect('/transaksi_agen/tentukan_agen');
        $info = "";
        if ($this->input->post('submit')) {
            $add = $this->add($this->input->post('id'), $this->input->post('jumlah'));
            if (!$add) $info = "Stok Tidak mencukupi";
        }
        $data = new stdClass();
        $data->info = $info;
        $data->view_konten = 'transaksi_agen';
        $data->title = "Transaksi Agen";
        $id_agen = $this->session->userdata('id_agen');
        $data->nama_agen = "";
        $data->nama_agen .= $this->agen->get_agen($id_agen)->nama;
        $data->daftar_agen = $this->agen->get_semua_agen();
        $data->daftar_merek = $this->merek->get_semua_merek();
        $this->load->view('base', $data);
    }

    function pilih_agen($id)
    {
        $agen = $this->agen->get_agen($id);
        if ($agen) $this->session->set_userdata('id_agen', $id);
        redirect('/transaksi_agen');
    }

    function tentukan_agen()
    {
        $data = new stdClass();
        $data->view_konten = 'tentukan_agen';
        $data->title = "Transaksi Agen";
        $data->nama_agen = "";
        $data->nama_agen .= $this->session->userdata('id_agen');
        $data->daftar_agen = $this->agen->get_semua_agen();
        $data->daftar_merek = $this->merek->get_semua_merek();
        $this->load->view('base', $data);
    }
    
    function bayar(){
        foreach($this->cart->contents() as $item){
            $this->transaksi_agen->tambah_transaksi($item['id'], $item['qty'], $this->session->userdata('id_agen'));
        }
        $this->cart->destroy();
        $this->session->unset_userdata('id_agen');
        redirect('/transaksi_agen');
    }

    function batal(){
        $this->cart->destroy();
        $this->session->unset_userdata('id_agen');
        redirect('/transaksi_agen');
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