<?php
class Transaksi_konsumen_model extends Model{

    function Transaksi_konsumen_model(){
        parent::Model();
        $this->load->model('Produk_model', 'produk');
    }

    function tambah_transaksi($id_produk, $jumlah)
    {
        $x = $this->produk->get_produk_by_id($id_produk);
        //tanggal,produk,jumlah,harga,keuntungan
        $tanggal = date("Y-m-d H:i:s");
        $keuntungan = ($x->harga_jual - $x->harga_beli) * $jumlah;
        $data = array(
            "tanggal" => $tanggal,
            "produk" => $id_produk,
            "jumlah" => $jumlah,
            "harga" => $x->harga_jual,
            "keuntungan" => $keuntungan
        );
        $q = $this->db->insert('transaksi_konsumen',$data);
        if($q){
            $jumlah = -$jumlah;
            return $this->produk->tambah_stok_produk($id_produk,$jumlah,$x->harga_beli, "konsumen");
        }
    }

}