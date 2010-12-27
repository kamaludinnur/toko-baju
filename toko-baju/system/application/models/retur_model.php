<?php
class Retur_model extends Model {

    function Retur_model(){
        parent::Model();
        $this->load->model('Produk_model', 'produk');
        $this->load->model('Agen_model', 'agen');
    }

    function retur_konsumen($id_produk, $jumlah, $harga)
    {
        $x = $this->produk->get_produk_by_id($id_produk);
        #produk,tanggal,jumlah,harga,agen,refund
        $tanggal = date("Y-m-d H:i:s");
        $refund = ($harga - $x->harga_beli) * $jumlah;
        $data = array(
            "tanggal" => $tanggal,
            "agen" => 0,
            "produk" => $id_produk,
            "jumlah" => $jumlah,
            "harga" => $harga,
            "refund" => $refund
        );
        $q = $this->db->insert('transaksi_retur',$data);
        if($q){
            return $this->produk->tambah_stok_produk($id_produk,$jumlah,$x->harga_beli, "retur_konsumen");
        }
    }

    function tambah_cookie_retur_konsumen()
    {
        
    }

    function retur_agen($id_produk, $jumlah, $harga, $agen)
    {
        $x = $this->produk->get_produk_by_id($id_produk);
        #produk,tanggal,jumlah,harga,agen,refund
        $tanggal = date("Y-m-d H:i:s");
        $refund = ($harga - $x->harga_beli) * $jumlah;
        $data = array(
            "tanggal" => $tanggal,
            "agen" => $agen,
            "produk" => $id_produk,
            "jumlah" => $jumlah,
            "harga" => $harga,
            "refund" => $refund
        );
        $q = $this->db->insert('transaksi_retur',$data);
        if($q){
            return $this->produk->tambah_stok_produk($id_produk,$jumlah,$x->harga_beli, "retur_agen");
        }
    }

}