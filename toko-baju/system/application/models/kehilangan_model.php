<?php
class Kehilangan_model extends Model {

    function Kehilangan_model()
    {
        parent::Model();
        $this->load->model('Produk_model', 'produk');
    }

    function insert_kehilangan($id_produk, $jumlah)
    {
        $x = $this->produk->get_produk_by_id($id_produk);
        #produk, tanggal, jumlah, harga
        $tanggal = date("Y-m-d H:i:s");
        $refund = $x->harga_beli * $jumlah;
        $data = array(
            "tanggal" => $tanggal,
            "produk" => $id_produk,
            "jumlah" => $jumlah,
            "harga" => $x->harga_beli,
            "kerugian" => $refund
        );
        $q = $this->db->insert('transaksi_kehilangan',$data);
        if($q){
            $jumlah = -$jumlah;
            return $this->produk->tambah_stok_produk($id_produk,$jumlah,$x->harga_beli, "kehilangan");
        }
    }

}
?>
