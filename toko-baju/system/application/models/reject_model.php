<?php
class Reject_model extends Model {

    function Reject_model(){
        parent::Model();
        $this->load->model('Produk_model', 'produk');
        $this->load->model('Agen_model', 'agen');
    }

    function reject_konsumen($id_produk, $jumlah, $harga)
    {
        $x = $this->produk->get_produk_by_id($id_produk);
        #produk,tanggal,jumlah,harga,agen,refund
        $tanggal = date("Y-m-d H:i:s");
        $refund = $harga * $jumlah;
        $data = array(
            "tanggal" => $tanggal,
            "agen" => 0,
            "produk" => $id_produk,
            "jumlah" => $jumlah,
            "harga" => $harga,
            "refund" => $refund
        );
        $q = $this->db->insert('transaksi_reject',$data);
        return $q;
    }

    function reject_agen($id_produk, $jumlah, $harga, $agen)
    {
        $x = $this->produk->get_produk_by_id($id_produk);
        #produk,tanggal,jumlah,harga,agen,refund
        $tanggal = date("Y-m-d H:i:s");
        $refund = $harga * $jumlah;
        $data = array(
            "tanggal" => $tanggal,
            "agen" => $agen,
            "produk" => $id_produk,
            "jumlah" => $jumlah,
            "harga" => $harga,
            "refund" => $refund
        );
        $q = $this->db->insert('transaksi_reject',$data);
        return $q;
    }


}

?>
