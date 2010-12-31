<?php

class Rekap extends Controller {

    function Rekap()
    {
        parent::Controller();
        $this->load->model('Rekap_model', 'rekap');
        $this->load->helper('fungsi');
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

}
