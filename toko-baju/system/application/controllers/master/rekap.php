<?php

class Rekap extends Controller {

    function Rekap()
    {
        parent::Controller();
        $this->load->model('Rekap_model', 'rekap');
        $this->load->helper('fungsi');
        $this->load->model('Produk_model', 'produk');
        $this->load->model('Model_baju_model', 'model_baju');
        $this->load->model('Warna_model', 'warna');
        $this->load->model('Ukuran_model', 'ukuran');
        $this->load->model('Merek_model', 'merek');
        $this->load->model('Agen_model', 'agen');

        if(!$this->session->userdata('master_login'))
            redirect('master/home/login');

    }


    function index()
    {
        redirect('master/rekap/transaksi_konsumen');
    }

    function format_date($date)
    {
        // inputted date dd/mm/yyyy
        // output should mm/dd/yyyy
        $d = explode('/', $date); // 0 = dd, 1 = mm, 2 = yy
        return $d[1].'/'.$d[0].'/'.$d[2];
    }

    function transaksi_konsumen()
    {
        $data = new stdClass();

        $data->daftar_merek = $this->merek->get_semua_merek();
        $data->daftar_warna = $this->warna->get_semua_warna();
        $data->daftar_model = $this->model_baju->get_semua_model();
        $data->daftar_ukuran = $this->ukuran->get_semua_ukuran('id');

        // view yang memuat isi halamannya
        $data->view_konten = "rekap/rekap_transaksi_konsumen";
        $data->title = "Rekap Transaksi Retail";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }


    function transaksi_konsumen_get()
    {
        $data = new stdClass();

        $filter = array();

        $start_date = $this->input->post('start');
        $end_date   = $this->input->post('end');

        if ($this->input->post('is_filtered') == 1)
        {
            $f = array();

            $f[0] = ($this->input->post('f_merek')) ? "merek.nama = '" . $this->input->post('f_merek') . "'" : "";
            $f[1] = ($this->input->post('f_model')) ? "model.nama = '" . $this->input->post('f_model') . "'" : "";
            $f[2] = ($this->input->post('f_warna')) ? "warna.nama = '" . $this->input->post('f_warna') . "'" : "";
            $f[3] = ($this->input->post('f_ukuran')) ? "ukuran.nama = '" . $this->input->post('f_ukuran') . "'" : "";

            $f[4] = ($this->input->post('f_jumlah') != "") ? "tk.jumlah" . $this->input->post('f_jumlah_op') . $this->input->post('f_jumlah') : "";
            $f[5] = ($this->input->post('f_harga') != "") ? "tk.harga" . $this->input->post('f_harga_op') . $this->input->post('f_harga') : "";
            $f[6] = ($this->input->post('f_keuntungan') != "") ? "tk.keuntungan" . $this->input->post('f_keuntungan_op') . $this->input->post('f_keuntungan') : "";

            foreach ($f as $g) {
                if($g != '') $filter[] = $g;
            }
        }

        $data->start_date = $this->format_date($start_date);
        $data->end_date = $this->format_date($end_date);

        $data->sehari_doang = ($start_date == $end_date);
        $data->data_rekapan = $this->rekap->get_transaksi_konsumen($this->format_date($start_date), $this->format_date($end_date), 'tanggal ASC' ,$filter);

        $this->load->view('master/rekap/rekap_transaksi_konsumen_table', $data);
    }

    function transaksi_konsumen_xls()
    {
        $start_date = $this->input->post('start');
        $end_date   = $this->input->post('end');
        $data_dump  = $this->input->post('data_dump');

        // gak perlu di-format_date lagi karena udah dateng dalam bentuk ter-format
        $data->start_date = $start_date;
        $data->end_date = $end_date;

        $data->data_rekapan = $this->rekap->get_transaksi_konsumen($start_date, $end_date, 'tanggal ASC');

        $this->load->plugin('phpexcel');

        $this->load->view('master/rekap/rekap_transaksi_konsumen_xls', $data);

    }

    function transaksi_agen()
    {
        $data = new stdClass();

        $data->daftar_merek = $this->merek->get_semua_merek();
        $data->daftar_warna = $this->warna->get_semua_warna();
        $data->daftar_model = $this->model_baju->get_semua_model();
        $data->daftar_ukuran = $this->ukuran->get_semua_ukuran('id');
        $data->daftar_agen = $this->agen->get_semua_agen('kode');

        // view yang memuat isi halamannya
        $data->view_konten = "rekap/rekap_transaksi_agen";
        $data->title = "Rekap Transaksi Agen";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }

    function transaksi_agen_get()
    {
        $data = new stdClass();

        $filter = array();

        $start_date = $this->input->post('start');
        $end_date   = $this->input->post('end');

        if ($this->input->post('is_filtered') == 1)
        {
            $f = array();

            $f[0] = ($this->input->post('f_merek')) ? "merek.nama = '" . $this->input->post('f_merek') . "'" : "";
            $f[1] = ($this->input->post('f_model')) ? "model.nama = '" . $this->input->post('f_model') . "'" : "";
            $f[2] = ($this->input->post('f_warna')) ? "warna.nama = '" . $this->input->post('f_warna') . "'" : "";
            $f[3] = ($this->input->post('f_ukuran')) ? "ukuran.nama = '" . $this->input->post('f_ukuran') . "'" : "";

            $f[4] = ($this->input->post('f_jumlah') != "") ? "tk.jumlah" . $this->input->post('f_jumlah_op') . $this->input->post('f_jumlah') : "";
            $f[5] = ($this->input->post('f_harga') != "") ? "tk.harga" . $this->input->post('f_harga_op') . $this->input->post('f_harga') : "";
            $f[6] = ($this->input->post('f_keuntungan') != "") ? "tk.keuntungan" . $this->input->post('f_keuntungan_op') . $this->input->post('f_keuntungan') : "";

            $f[7] = ($this->input->post('f_agen')) ? "agen.kode = '" . $this->input->post('f_agen') . "'" : "";
            
            foreach ($f as $g) {
                if($g != '') $filter[] = $g;
            }
        }

        $data->start_date = $this->format_date($start_date);
        $data->end_date = $this->format_date($end_date);

        $data->sehari_doang = ($start_date == $end_date);
        $data->data_rekapan = $this->rekap->get_transaksi_agen($this->format_date($start_date), $this->format_date($end_date), 'tanggal ASC', $filter);

        $this->load->view('master/rekap/rekap_transaksi_agen_table', $data);
    }

    function transaksi_agen_xls()
    {
        $start_date = $this->input->post('start');
        $end_date   = $this->input->post('end');
        $data_dump  = $this->input->post('data_dump');

        // gak perlu di-format_date lagi karena udah dateng dalam bentuk ter-format
        $data->start_date = $start_date;
        $data->end_date = $end_date;

        $data->data_rekapan = $this->rekap->get_transaksi_agen($start_date, $end_date, 'tanggal ASC');

        $this->load->plugin('phpexcel');

        $this->load->view('master/rekap/rekap_transaksi_agen_xls', $data);

    }


    function record_stok()
    {
        $data = new stdClass();

        $data->daftar_merek = $this->merek->get_semua_merek();
        $data->daftar_warna = $this->warna->get_semua_warna();
        $data->daftar_model = $this->model_baju->get_semua_model();
        $data->daftar_ukuran = $this->ukuran->get_semua_ukuran('id');

        // view yang memuat isi halamannya
        $data->view_konten = "rekap/rekap_record_stok";
        $data->title = "Record Stok Produk";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }

    function record_stok_per_produk()
    {
        $data = new stdClass();

        $id_merek = intval($this->input->post('merek'));
        $id_model = intval($this->input->post('model'));
        $id_warna = intval($this->input->post('warna'));
        $id_ukuran = intval($this->input->post('ukuran'));

        $data->data_rekapan = $this->rekap->get_record_stok_by_produk($id_merek, $id_model, $id_warna, $id_ukuran);

        $this->load->view('master/rekap/rekap_record_stok_per_produk_table', $data);
    }

    function record_stok_per_tanggal()
    {
        $data = new stdClass();

        $start_date = $this->input->post('start');
        $end_date   = $this->input->post('end');

        $data->start_date = $this->format_date($start_date);
        $data->end_date = $this->format_date($end_date);

        $data->sehari_doang = ($start_date == $end_date);
        $data->data_rekapan = $this->rekap->get_record_stok_by_tanggal($this->format_date($start_date), $this->format_date($end_date));

        $this->load->view('master/rekap/rekap_record_stok_per_tanggal_table', $data);
    }

    function record_stok_xls()
    {
        $data = new stdClass();

        $start_date = $this->input->post('start');
        $end_date   = $this->input->post('end');

        $data->start_date = $start_date;
        $data->end_date = $end_date;

        $data->data_rekapan = $this->rekap->get_record_stok_by_tanggal($start_date, $end_date);

        $this->load->plugin('phpexcel');

        $this->load->view('master/rekap/rekap_record_stok_xls', $data);
    }


// ==========

    function kehilangan()
    {
        $data = new stdClass();

        $data->daftar_merek = $this->merek->get_semua_merek();
        $data->daftar_warna = $this->warna->get_semua_warna();
        $data->daftar_model = $this->model_baju->get_semua_model();
        $data->daftar_ukuran = $this->ukuran->get_semua_ukuran('id');

        // view yang memuat isi halamannya
        $data->view_konten = "rekap/rekap_kehilangan";
        $data->title = "Rekap Kehilangan";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }


    function kehilangan_get()
    {
        $data = new stdClass();

        $filter = array();

        $start_date = $this->input->post('start');
        $end_date   = $this->input->post('end');

        if ($this->input->post('is_filtered') == 1)
        {
            $f = array();

            $f[0] = ($this->input->post('f_merek')) ? "merek.nama = '" . $this->input->post('f_merek') . "'" : "";
            $f[1] = ($this->input->post('f_model')) ? "model.nama = '" . $this->input->post('f_model') . "'" : "";
            $f[2] = ($this->input->post('f_warna')) ? "warna.nama = '" . $this->input->post('f_warna') . "'" : "";
            $f[3] = ($this->input->post('f_ukuran')) ? "ukuran.nama = '" . $this->input->post('f_ukuran') . "'" : "";

            $f[4] = ($this->input->post('f_jumlah') != "") ? "tk.jumlah" . $this->input->post('f_jumlah_op') . $this->input->post('f_jumlah') : "";
            $f[5] = ($this->input->post('f_harga') != "") ? "tk.harga" . $this->input->post('f_harga_op') . $this->input->post('f_harga') : "";
            $f[6] = ($this->input->post('f_keuntungan') != "") ? "tk.kerugian" . $this->input->post('f_keuntungan_op') . $this->input->post('f_keuntungan') : "";

            foreach ($f as $g) {
                if($g != '') $filter[] = $g;
            }
        }

        $data->start_date = $this->format_date($start_date);
        $data->end_date = $this->format_date($end_date);

        $data->sehari_doang = ($start_date == $end_date);
        $data->data_rekapan = $this->rekap->get_kehilangan($this->format_date($start_date), $this->format_date($end_date), 'tanggal ASC' ,$filter);

        $this->load->view('master/rekap/rekap_kehilangan_table', $data);
    }

    function kehilangan_xls()
    {
        $start_date = $this->input->post('start');
        $end_date   = $this->input->post('end');
        $data_dump  = $this->input->post('data_dump');

        // gak perlu di-format_date lagi karena udah dateng dalam bentuk ter-format
        $data->start_date = $start_date;
        $data->end_date = $end_date;

        $data->data_rekapan = $this->rekap->get_kehilangan($start_date, $end_date, 'tanggal ASC');

        $this->load->plugin('phpexcel');

        $this->load->view('master/rekap/rekap_kehilangan_xls', $data);

    }

    // retur classes ===========================================================

    function retur_konsumen()
    {
        $data = new stdClass();

        $data->daftar_merek = $this->merek->get_semua_merek();
        $data->daftar_warna = $this->warna->get_semua_warna();
        $data->daftar_model = $this->model_baju->get_semua_model();
        $data->daftar_ukuran = $this->ukuran->get_semua_ukuran('id');

        // view yang memuat isi halamannya
        $data->view_konten = "rekap/rekap_retur_konsumen";
        $data->title = "Rekap Retur Retail";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }


    function retur_konsumen_get()
    {
        $data = new stdClass();

        $filter = array();

        $start_date = $this->input->post('start');
        $end_date   = $this->input->post('end');

        if ($this->input->post('is_filtered') == 1)
        {
            $f = array();

            $f[0] = ($this->input->post('f_merek')) ? "merek.nama = '" . $this->input->post('f_merek') . "'" : "";
            $f[1] = ($this->input->post('f_model')) ? "model.nama = '" . $this->input->post('f_model') . "'" : "";
            $f[2] = ($this->input->post('f_warna')) ? "warna.nama = '" . $this->input->post('f_warna') . "'" : "";
            $f[3] = ($this->input->post('f_ukuran')) ? "ukuran.nama = '" . $this->input->post('f_ukuran') . "'" : "";

            $f[4] = ($this->input->post('f_jumlah') != "") ? "tk.jumlah" . $this->input->post('f_jumlah_op') . $this->input->post('f_jumlah') : "";
            $f[5] = ($this->input->post('f_harga') != "") ? "tk.harga" . $this->input->post('f_harga_op') . $this->input->post('f_harga') : "";
            $f[6] = ($this->input->post('f_keuntungan') != "") ? "tk.refund" . $this->input->post('f_keuntungan_op') . $this->input->post('f_keuntungan') : "";

            foreach ($f as $g) {
                if($g != '') $filter[] = $g;
            }
        }

        $data->start_date = $this->format_date($start_date);
        $data->end_date = $this->format_date($end_date);

        $data->sehari_doang = ($start_date == $end_date);
        $data->data_rekapan = $this->rekap->get_retur_konsumen($this->format_date($start_date), $this->format_date($end_date), 'tanggal ASC' ,$filter);

        $this->load->view('master/rekap/rekap_retur_konsumen_table', $data);
    }

    function retur_konsumen_xls()
    {
        $start_date = $this->input->post('start');
        $end_date   = $this->input->post('end');
        $data_dump  = $this->input->post('data_dump');

        // gak perlu di-format_date lagi karena udah dateng dalam bentuk ter-format
        $data->start_date = $start_date;
        $data->end_date = $end_date;

        $data->data_rekapan = $this->rekap->get_retur_konsumen($start_date, $end_date, 'tanggal ASC');

        $this->load->plugin('phpexcel');

        $this->load->view('master/rekap/rekap_retur_konsumen_xls', $data);

    }



    function retur_agen()
    {
        $data = new stdClass();

        $data->daftar_merek = $this->merek->get_semua_merek();
        $data->daftar_warna = $this->warna->get_semua_warna();
        $data->daftar_model = $this->model_baju->get_semua_model();
        $data->daftar_ukuran = $this->ukuran->get_semua_ukuran('id');
        $data->daftar_agen = $this->agen->get_semua_agen('kode');

        // view yang memuat isi halamannya
        $data->view_konten = "rekap/rekap_retur_agen";
        $data->title = "Rekap Retur Agen";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }

    function retur_agen_get()
    {
        $data = new stdClass();

        $filter = array();

        $start_date = $this->input->post('start');
        $end_date   = $this->input->post('end');

        if ($this->input->post('is_filtered') == 1)
        {
            $f = array();

            $f[0] = ($this->input->post('f_merek')) ? "merek.nama = '" . $this->input->post('f_merek') . "'" : "";
            $f[1] = ($this->input->post('f_model')) ? "model.nama = '" . $this->input->post('f_model') . "'" : "";
            $f[2] = ($this->input->post('f_warna')) ? "warna.nama = '" . $this->input->post('f_warna') . "'" : "";
            $f[3] = ($this->input->post('f_ukuran')) ? "ukuran.nama = '" . $this->input->post('f_ukuran') . "'" : "";

            $f[4] = ($this->input->post('f_jumlah') != "") ? "tk.jumlah" . $this->input->post('f_jumlah_op') . $this->input->post('f_jumlah') : "";
            $f[5] = ($this->input->post('f_harga') != "") ? "tk.harga" . $this->input->post('f_harga_op') . $this->input->post('f_harga') : "";
            $f[6] = ($this->input->post('f_keuntungan') != "") ? "tk.refund" . $this->input->post('f_keuntungan_op') . $this->input->post('f_keuntungan') : "";

            $f[7] = ($this->input->post('f_agen')) ? "agen.kode = '" . $this->input->post('f_agen') . "'" : "";

            foreach ($f as $g) {
                if($g != '') $filter[] = $g;
            }
        }

        $data->start_date = $this->format_date($start_date);
        $data->end_date = $this->format_date($end_date);

        $data->sehari_doang = ($start_date == $end_date);
        $data->data_rekapan = $this->rekap->get_retur_agen($this->format_date($start_date), $this->format_date($end_date), 'tanggal ASC', $filter);

        $this->load->view('master/rekap/rekap_retur_agen_table', $data);
    }

    function retur_agen_xls()
    {
        $start_date = $this->input->post('start');
        $end_date   = $this->input->post('end');
        $data_dump  = $this->input->post('data_dump');

        // gak perlu di-format_date lagi karena udah dateng dalam bentuk ter-format
        $data->start_date = $start_date;
        $data->end_date = $end_date;

        $data->data_rekapan = $this->rekap->get_retur_agen($start_date, $end_date, 'tanggal ASC');

        $this->load->plugin('phpexcel');

        $this->load->view('master/rekap/rekap_retur_agen_xls', $data);

    }



    // reject classes ==========================================================

    function reject_konsumen()
    {
        $data = new stdClass();

        $data->daftar_merek = $this->merek->get_semua_merek();
        $data->daftar_warna = $this->warna->get_semua_warna();
        $data->daftar_model = $this->model_baju->get_semua_model();
        $data->daftar_ukuran = $this->ukuran->get_semua_ukuran('id');

        // view yang memuat isi halamannya
        $data->view_konten = "rekap/rekap_reject_konsumen";
        $data->title = "Rekap Reject Retail";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }


    function reject_konsumen_get()
    {
        $data = new stdClass();

        $filter = array();

        $start_date = $this->input->post('start');
        $end_date   = $this->input->post('end');

        if ($this->input->post('is_filtered') == 1)
        {
            $f = array();

            $f[0] = ($this->input->post('f_merek')) ? "merek.nama = '" . $this->input->post('f_merek') . "'" : "";
            $f[1] = ($this->input->post('f_model')) ? "model.nama = '" . $this->input->post('f_model') . "'" : "";
            $f[2] = ($this->input->post('f_warna')) ? "warna.nama = '" . $this->input->post('f_warna') . "'" : "";
            $f[3] = ($this->input->post('f_ukuran')) ? "ukuran.nama = '" . $this->input->post('f_ukuran') . "'" : "";

            $f[4] = ($this->input->post('f_jumlah') != "") ? "tk.jumlah" . $this->input->post('f_jumlah_op') . $this->input->post('f_jumlah') : "";
            $f[5] = ($this->input->post('f_harga') != "") ? "tk.harga" . $this->input->post('f_harga_op') . $this->input->post('f_harga') : "";
            $f[6] = ($this->input->post('f_keuntungan') != "") ? "tk.refund" . $this->input->post('f_keuntungan_op') . $this->input->post('f_keuntungan') : "";

            foreach ($f as $g) {
                if($g != '') $filter[] = $g;
            }
        }

        $data->start_date = $this->format_date($start_date);
        $data->end_date = $this->format_date($end_date);

        $data->sehari_doang = ($start_date == $end_date);
        $data->data_rekapan = $this->rekap->get_reject_konsumen($this->format_date($start_date), $this->format_date($end_date), 'tanggal ASC' ,$filter);

        $this->load->view('master/rekap/rekap_reject_konsumen_table', $data);
    }

    function reject_konsumen_xls()
    {
        $start_date = $this->input->post('start');
        $end_date   = $this->input->post('end');
        $data_dump  = $this->input->post('data_dump');

        // gak perlu di-format_date lagi karena udah dateng dalam bentuk ter-format
        $data->start_date = $start_date;
        $data->end_date = $end_date;

        $data->data_rekapan = $this->rekap->get_reject_konsumen($start_date, $end_date, 'tanggal ASC');

        $this->load->plugin('phpexcel');

        $this->load->view('master/rekap/rekap_reject_konsumen_xls', $data);

    }

    function reject_agen()
    {
        $data = new stdClass();

        $data->daftar_merek = $this->merek->get_semua_merek();
        $data->daftar_warna = $this->warna->get_semua_warna();
        $data->daftar_model = $this->model_baju->get_semua_model();
        $data->daftar_ukuran = $this->ukuran->get_semua_ukuran('id');
        $data->daftar_agen = $this->agen->get_semua_agen('kode');

        // view yang memuat isi halamannya
        $data->view_konten = "rekap/rekap_reject_agen";
        $data->title = "Rekap Reject Agen";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }

    function reject_agen_get()
    {
        $data = new stdClass();

        $filter = array();

        $start_date = $this->input->post('start');
        $end_date   = $this->input->post('end');

        if ($this->input->post('is_filtered') == 1)
        {
            $f = array();

            $f[0] = ($this->input->post('f_merek')) ? "merek.nama = '" . $this->input->post('f_merek') . "'" : "";
            $f[1] = ($this->input->post('f_model')) ? "model.nama = '" . $this->input->post('f_model') . "'" : "";
            $f[2] = ($this->input->post('f_warna')) ? "warna.nama = '" . $this->input->post('f_warna') . "'" : "";
            $f[3] = ($this->input->post('f_ukuran')) ? "ukuran.nama = '" . $this->input->post('f_ukuran') . "'" : "";

            $f[4] = ($this->input->post('f_jumlah') != "") ? "tk.jumlah" . $this->input->post('f_jumlah_op') . $this->input->post('f_jumlah') : "";
            $f[5] = ($this->input->post('f_harga') != "") ? "tk.harga" . $this->input->post('f_harga_op') . $this->input->post('f_harga') : "";
            $f[6] = ($this->input->post('f_keuntungan') != "") ? "tk.refund" . $this->input->post('f_keuntungan_op') . $this->input->post('f_keuntungan') : "";

            $f[7] = ($this->input->post('f_agen')) ? "agen.kode = '" . $this->input->post('f_agen') . "'" : "";

            foreach ($f as $g) {
                if($g != '') $filter[] = $g;
            }
        }

        $data->start_date = $this->format_date($start_date);
        $data->end_date = $this->format_date($end_date);

        $data->sehari_doang = ($start_date == $end_date);
        $data->data_rekapan = $this->rekap->get_reject_agen($this->format_date($start_date), $this->format_date($end_date), 'tanggal ASC', $filter);

        $this->load->view('master/rekap/rekap_reject_agen_table', $data);
    }

    function reject_agen_xls()
    {
        $start_date = $this->input->post('start');
        $end_date   = $this->input->post('end');
        $data_dump  = $this->input->post('data_dump');

        // gak perlu di-format_date lagi karena udah dateng dalam bentuk ter-format
        $data->start_date = $start_date;
        $data->end_date = $end_date;

        $data->data_rekapan = $this->rekap->get_reject_agen($start_date, $end_date, 'tanggal ASC');

        $this->load->plugin('phpexcel');

        $this->load->view('master/rekap/rekap_reject_agen_xls', $data);

    }

    // poin

    function poin_agen($id_agen = 0)
    {
        $data = new stdClass();

        $data->daftar_agen = $this->agen->get_semua_agen('kode');
        $data->id_agen = $id_agen;

        if($id_agen != 0) $data->langsung_tampilin = true;

        // view yang memuat isi halamannya
        $data->view_konten = "rekap/rekap_poin_agen";
        $data->title = "Rekap Poin Agen";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }

    function poin_agen_get()
    {
        $data = new stdClass();

        $agen       = $this->input->post('agen');
        $start_date = $this->input->post('start');
        $end_date   = $this->input->post('end');
        $range      = $this->input->post('range');

        $data->start_date = $this->format_date($start_date);
        $data->end_date = $this->format_date($end_date);

        if ($range == 'all')
            $data->data_rekapan = $this->rekap->get_poin_agen($agen);
        elseif ($range == 'range')
        {
            $data->data_rekapan = $this->rekap->get_poin_agen($agen, $this->format_date($start_date), $this->format_date($end_date));
            $data->is_range = true;
        }

        $this->load->view('master/rekap/rekap_poin_agen_table', $data);
    }
}
