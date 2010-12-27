<?php

class Produk extends Controller {

    function Produk()
    {
        parent::Controller();
        $this->load->model('Produk_model', 'produk');
        $this->load->model('Model_baju_model', 'model_baju');
        $this->load->model('Warna_model', 'warna');
        $this->load->model('Ukuran_model', 'ukuran');
        $this->load->model('Merek_model', 'merek');
    }

    function index()
    {
        redirect('master/produk/manage');
    }

    function manage($sort_by = 'id')
    {
        $data = new stdClass();

        $data->daftar_produk = $this->produk->get_semua_produk();

        // view yang memuat isi halamannya
        $data->view_konten = "produk";
        $data->title = "Manajemen Produk";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }

    function entri()
    {
        // $this->session->unset_userdata('produk_temp');

        $data = new stdClass();

        /* masa lalu

        $daftar_produk = unserialize($this->session->userdata('produk_temp'));
        
        // onsubmit
        if ($this->input->post('submit'))
        {
            $id_model = $this->input->post('id_model');
            $id_warna = $this->input->post('id_warna');
            $id_ukuran = $this->input->post('id_ukuran');
            $stok = $this->input->post('stok');
            $harga_beli = $this->input->post('harga_beli');
            $harga_jual = $this->input->post('harga_jual');
            $keterangan = $this->input->post('keterangan');

            // cek di databes
            $sudah_ada_di_db = is_object($this->produk->get_produk($id_model, $id_warna, $id_ukuran));

            $new_produk = array(
                'model' => $id_model,
                'warna' => $id_warna,
                'ukuran' => $id_ukuran,
                'stok' => $stok,
                'harga_beli' => $harga_beli,
                'harga_jual' => $harga_jual,
                'keterangan' => $keterangan
            );

            // cek di kukis
            foreach ($daftar_produk as $produk)
            {
                $sudah_ada_di_kukis = ($produk['model'] == $id_model) AND ($produk['warna'] == $id_warna) AND ($produk['ukuran'] == $id_ukuran);
            }

            if ($sudah_ada_di_kukis) echo "UDAH ADA"; else echo "BELUM ADA";

            $daftar_produk[] = $new_produk;

            $this->session->set_userdata('produk_temp', serialize($daftar_produk));

            echo "<pre>";
            print_r(unserialize($this->session->userdata('produk_temp')));
            echo "</pre>";

            die();

        }

        $data->daftar_produk = $daftar_produk;

        */


        $data->daftar_merek = $this->merek->get_semua_merek();
        $data->daftar_warna = $this->warna->get_semua_warna();
        $data->daftar_ukuran = $this->ukuran->get_semua_ukuran('id');

        // view yang memuat isi halamannya
        $data->view_konten = "produk_entri";
        $data->title = "Entri Produk";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }

    function cek_database($id_model, $id_warna, $id_ukuran)
    {
        // dipanggil oleh AJAX
        // 
        // cek di databes
        $sudah_ada_di_db = is_object($this->produk->get_produk($id_model, $id_warna, $id_ukuran));

        if ($sudah_ada_di_db)
        {
            echo "1";
            exit;
        }
    }

    function load_model($merek)
    {
        $x = $this->model_baju->get_semua_model_by_merek($merek);
        $data = new stdClass();
        $data->daftar_model = $x;
        $this->load->view('master/ajax_model', $data);
    }

}