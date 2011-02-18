<?php
class Transaksi_pelunasan extends Controller {

    function Transaksi_pelunasan()
    {
        parent::Controller();
        $this->load->model('Transaksi_pelunasan_model', 'pelunasan');
    }

    function index()
    {
        $data = new stdClass();
        $data->view_konten = 'transaksi_pelunasan';
        $data->title = "Transaksi Pelunasan";
        $data->daftar_hutang = $this->pelunasan->get_belum_lunas();
        $this->load->view('base', $data);
    }

    function add($id)
    {
        $data = new stdClass();
        $data->view_konten = 'transaksi_pelunasan_add';
        $data->title = "Transaksi Pelunasan";
        $data->daftar_hutang = $this->pelunasan->get_hutang($id);
        if (!$this->session->userdata('metode')) $this->session->set_userdata('metode', 1);
        $data->metode_pembayaran = $this->session->userdata('metode');
        $data->pembayaran = $this->pelunasan->get_pembayaran($id);
        $metode = $data->pembayaran;
        

        
        $data->id_trx = $id;
        $this->load->view('base', $data);
    }

    function tambah()
    {
        if($this->input->post('submit'))
        {
            $order_id = $this->input->post('id');
            $hutang = $this->pelunasan->get_hutang($order_id);
            $sisa = $hutang[0]['sisa'];
            if($this->input->post('jumlah')==$sisa)
            {
                $this->pelunasan->set_lunas($order_id);
                redirect('transaksi_pelunasan');
            }
            else
            {
                $data = array();
                $data['order'] = $this->input->post('id');
                $data['jumlah'] = $this->input->post('jumlah');
                $data['metode'] = $this->input->post('metode');
                $data['tanggal'] = date("Y-m-d H:i:s");
                $this->pelunasan->insert_pembayaran($data);
                redirect('transaksi_pelunasan/add/' . $data['order']);
            }
        }
    }

    function metode_pembayaran($id_trx, $id=1)
    {
        $this->session->set_userdata('metode', $id);
        redirect('transaksi_pelunasan/add/'.$id_trx);
    }

}