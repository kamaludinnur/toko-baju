<?php
class Retur_konsumen extends Controller {

    function Retur_konsumen()
    {
        parent::Controller();
        $this->load->model('Produk_model', 'produk');
        $this->load->model('Merek_model', 'merek');
        $this->load->model('Model_baju_model', 'model');
        $this->load->model('Retur_model', 'retur');
    }

    function index()
    {
        if($this->session->userdata('transaksi')!='retur_konsumen'){
            $this->cart->destroy();
            $this->session->set_userdata('transaksi', 'retur_konsumen');
        }
        $info = "";
        if ($this->input->post('submit')) {
            if(!$this->input->post('id')) $info = "Input produk tidak lengkap";
            else{
                $add = $this->add($this->input->post('id'), $this->input->post('jumlah'), $this->input->post('harga'));
                if (!$add) $info = "Stok Tidak mencukupi";
            }
        }
        $data = new stdClass();
        $data->info = $info;
        $data->view_konten = 'retur_konsumen';
        $data->title = "Retur Retail";
        $data->daftar_merek = $this->merek->get_semua_merek();
        $this->load->view('base', $data);
    }
    function refund(){
        $tanggal = date("Y-m-d H:i:s");
        $this->load->model('Order_model', 'order');

        // ====================Order====================
        $data = array(
            "tanggal"   => $tanggal,
            "total"     => $this->cart->total(),
            "jenis"     => "retur_konsumen",
            "lunas"     => $this->session->userdata('pembayaran')
        );
        $id_order = $this->order->insert_order($data);

        //=========================Retur==========================
        foreach($this->cart->contents() as $item){
            $this->retur->retur_konsumen($item['id'], $item['qty'], $item['price'], $id_order);
        }
        //$this->cart->destroy();
        $this->session->set_userdata('print_order_id', $id_order);

        redirect('/retur_konsumen/print_confirm');
    }
    function batal(){
        $this->cart->destroy();
        redirect('/retur_konsumen');
    }
    function add($produk, $jumlah, $harga)
    {
        $produk = $this->produk->get_produk_by_id($produk);
        // kita gak perlu cek stok gan
        $data = array(
            'id'    => $produk->id,
            'qty'   => $jumlah,
            'price' => $harga,
            'name'  => $produk->model,
            'merek' => $produk->merek,
            'warna' => $produk->warna,
            'ukuran'=> $produk->ukuran
        );
        $this->cart->insert($data);
        return true;
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
        $this->load->view('ajax_ukuran_2', $data);
    }

    function harga($id_produk)
    {
        $produk = $this->produk->get_produk_by_id($id_produk);
        echo round($produk->harga_jual);
        exit;
    }

    function print_confirm()
    {
        $data = new stdClass();

        $data->view_konten = 'print_transaksi_confirm';
        $data->title = "Retur Retail &raquo; Print";
        $data->return_page = "retur_konsumen";
        $data->jenis = "RETUR";

        // transfer dulu datanya
        $data->nomer_transaksi = $this->session->userdata('print_order_id');
        $data->isi_transaksi = $this->cart->contents();

        // baru dihancurin
        $this->cart->destroy();
        $this->session->unset_userdata('print_order_id');

        $this->load->view('base', $data);
    }


}