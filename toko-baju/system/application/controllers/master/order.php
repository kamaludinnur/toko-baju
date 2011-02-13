<?php

class Order extends Controller {

    function Order()
    {
        parent::Controller();
        $this->load->model('Order_model', 'order');
    }


    function index()
    {
        redirect('master/order/cari');
    }

    function cari()
    {
        $data = new stdClass();

        $data->title = "Cari Transaksi";

        // view yang memuat isi halamannya
        $data->view_konten = "order_cari";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }

    function cari_get($id_order)
    {
        $id_order = intval($id_order);
        $data = new stdClass();
        $tabel = '';
        $jenis = '';

        $data->order = $this->order->get_order($id_order);
        $data->transactor = 'konsumen'; // default view

        if(is_object($data->order)) $jenis = $data->order->jenis;

        $data->nomor_transaksi = $id_order;

        if ($jenis == false)
        {
            $data->notfound = true;
        }
        else
        {
            $data->notfound = false;
            switch ($jenis) {
                case 'transaksi_konsumen': $tabel = 'transaksi_konsumen'; break;
                case 'transaksi_agen'    : $tabel = 'transaksi_agen'; break;
                case 'retur_konsumen'    : $tabel = 'transaksi_retur'; break;
                case 'retur_agen'        : $tabel = 'transaksi_retur'; break;
                case 'reject_konsumen'   : $tabel = 'transaksi_reject'; break;
                case 'reject_agen'       : $tabel = 'transaksi_reject'; break;
            }

            $data->transactor = substr($jenis, strpos($jenis, '_') + 1);
            $data->jenis_transaksi = substr($jenis, 0, strpos($jenis, '_'));

            $data->isi_transaksi = $this->order->get_detail_order($tabel, $id_order, $data->transactor);

            if($data->transactor == 'agen')
            {
                $this->load->model('Agen_model', 'agen');
                $data->agen = $this->agen->get_agen($data->isi_transaksi[0]['agen']);
            }

        }

        $this->load->view("master/order_{$data->transactor}_hasil_cari", $data);

    }

}