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
    }


    function index()
    {

    }

    function transaksi_konsumen()
    {
        $data = new stdClass();

        // view yang memuat isi halamannya
        $data->view_konten = "rekap_transaksi_konsumen";
        $data->title = "Rekap Transaksi Konsumen";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }

    function format_date($date)
    {
        // inputted date dd/mm/yyyy
        // output should mm/dd/yyyy
        $d = explode('/', $date); // 0 = dd, 1 = mm, 2 = yy
        return $d[1].'/'.$d[0].'/'.$d[2];
    }

    function transaksi_konsumen_get()
    {
        $data = new stdClass();

        $start_date = $this->input->post('start');
        $end_date   = $this->input->post('end');

        $data->start_date = $this->format_date($start_date);
        $data->end_date = $this->format_date($end_date);

        $data->sehari_doang = ($start_date == $end_date);
        $data->data_rekapan = $this->rekap->get_transaksi_konsumen($this->format_date($start_date), $this->format_date($end_date));

        $this->load->view('master/rekap_transaksi_konsumen_table', $data);
    }

    function transaksi_agen()
    {
        $data = new stdClass();

        // view yang memuat isi halamannya
        $data->view_konten = "rekap_transaksi_agen";
        $data->title = "Rekap Transaksi Agen";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }

    function transaksi_agen_get()
    {
        $data = new stdClass();

        $start_date = $this->input->post('start');
        $end_date   = $this->input->post('end');

        $data->start_date = $this->format_date($start_date);
        $data->end_date = $this->format_date($end_date);

        $data->sehari_doang = ($start_date == $end_date);
        $data->data_rekapan = $this->rekap->get_transaksi_agen($this->format_date($start_date), $this->format_date($end_date));

        $this->load->view('master/rekap_transaksi_agen_table', $data);
    }

    function record_stok()
    {
        $data = new stdClass();

        $data->daftar_merek = $this->merek->get_semua_merek();
        $data->daftar_warna = $this->warna->get_semua_warna();
        $data->daftar_model = $this->model_baju->get_semua_model();
        $data->daftar_ukuran = $this->ukuran->get_semua_ukuran('id');

        // view yang memuat isi halamannya
        $data->view_konten = "rekap_record_stok";
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

        $this->load->view('master/rekap_record_stok_per_produk_table', $data);
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

        $this->load->view('master/rekap_record_stok_per_tanggal_table', $data);
    }

}
