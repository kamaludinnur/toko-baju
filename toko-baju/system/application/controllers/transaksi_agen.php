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
            if(!$this->input->post('id')) $info = "Input produk tidak lengkap";
            else{
                $add = $this->add($this->input->post('id'), $this->input->post('jumlah'));
                if (!$add) $info = "Stok Tidak mencukupi";
            }
        }
        $data = new stdClass();
        $data->info = $info;
        if (!$this->session->userdata('metode'))
        {
            $this->session->set_userdata('metode', 1);
        }
        $metode = $this->session->userdata('metode');
        if (!$this->session->userdata('pembayaran'))
        {
            $this->session->set_userdata('pembayaran', 1);
        }
        $pembayaran = $this->session->userdata('pembayaran');
        $data->pembayaran = $pembayaran;
        $data->metode_pembayaran = $metode;
        $data->view_konten = 'transaksi_agen';
        $data->title = "Transaksi Agen";
        $id_agen = $this->session->userdata('id_agen');
        $data->nama_agen = "";
        $data->nama_agen .= $this->agen->get_agen($id_agen)->nama;
        $data->daftar_agen = $this->agen->get_semua_agen();
        $data->daftar_merek = $this->merek->get_semua_merek();
        $this->load->view('base', $data);
    }

    function pembayaran($id)
    {
        $this->session->set_userdata('pembayaran', $id);
        redirect('/transaksi_agen');
    }

    function metode_pembayaran($id=1)
    {
        $this->session->set_userdata('metode', $id);
        redirect('/transaksi_agen');
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
    
    function bayar($pembayaran, $poin){
        $tanggal = date("Y-m-d H:i:s");
        $this->load->model('Order_model', 'order');
        
        // ====================Order====================
        $data = array(
            "tanggal"   => $tanggal,
            "total"     => $this->cart->total(),
            "jenis"     => "agen",
            "lunas"     => $this->session->userdata('pembayaran')
        );
        $id_order = $this->order->insert_order($data);

        // ====================Transaksi_agen========================
        foreach($this->cart->contents() as $item){
            $this->transaksi_agen->tambah_transaksi($item['id'], $item['qty'], $this->session->userdata('id_agen'), $id_order);
        }

        //=======================Pembayaran=============================
        $data = array(
            "tanggal"   => $tanggal,
            "order"     => $id_order,
            "jumlah"    => $pembayaran,
            "metode"    => $this->session->userdata('metode')
        );
        
        $this->order->insert_pembayaran($data);

        $this->session->set_userdata('print_metode_bayar', $data['metode']);

        //=========================Poin==========================
        $data = array(
            "tanggal"   => $tanggal,
            "agen"      => $this->session->userdata('id_agen'),
            "order"     => $id_order,
            "poin"    => $poin
        );

        $this->order->insert_poin($data);

        $this->session->set_userdata('metode', 1);

        $this->session->set_userdata('print_order_id', $id_order);

        redirect('/transaksi_agen/print_confirm');
    }

    function batal(){
        $this->cart->destroy();
        $this->session->unset_userdata('id_agen');
        redirect('/transaksi_agen');
    }

    function add($produk, $jumlah)
    {
        $produk = $this->produk->get_produk_by_id($produk);
        $agen = $this->agen->get_agen($this->session->userdata('id_agen'));
        if($produk->stok<$jumlah){ return false;}
        else {
        $data = array(
            'id'    => $produk->id,
            'qty'   => $jumlah,
            'harga_satuan' => $produk->harga_jual,
            'diskon'=> $agen->diskon,
            'price' => $produk->harga_jual*(100-$agen->diskon)/100,
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

    function print_confirm()
    {
        $data = new stdClass();

        $data->view_konten = 'print_transaksi_agen_confirm';
        $data->title = "Transaksi Agen &raquo; Print";
        $data->return_page = "transaksi_agen";

        // transfer dulu datanya
        $data->nomer_transaksi = $this->session->userdata('print_order_id');
        $data->metode_bayar = $this->session->userdata('print_metode_bayar');
        $data->isi_transaksi = $this->cart->contents();
        $data->agen = $this->agen->get_agen($this->session->userdata('id_agen'));

        // baru dihancurin
        $this->cart->destroy();
        $this->session->unset_userdata('print_order_id');
        $this->session->unset_userdata('print_metode_bayar');
        $this->session->unset_userdata('id_agen');

        $this->load->view('base', $data);
    }

}