<?php

class Transaksi_agen extends Model {

    function Transaksi_agen()
    {
        parent::Model();
        $this->load->model('Produk', 'produk');
        $this->load->model('Agen', 'agen');
    }

    function tambah_transaksi($id_produk, $jumlah, $id_agen)
    {
        $x = $this->produk->get_produk_by_id($id_produk);
        $a = $this->agen->get_agen($id_agen);

        $harga_jual = $x->harga_jual * (100 - $a->diskon) / 100;

        //tanggal,produk,jumlah,harga,keuntungan
        $tanggal = date("Y-m-d H:i:s");
        $keuntungan = ($harga_jual - $x->harga_beli) * $jumlah;
        $data = array(
            "tanggal" => $tanggal,
            "produk" => $id_produk,
            "jumlah" => $jumlah,
            "harga" => $harga_jual,
            "keuntungan" => $keuntungan,
            "agen" => $id_agen
        );
        
        $q = $this->db->insert('transaksi_agen', $data);
        if($q)
        {
            $jumlah = -$jumlah;
            return $this->produk->tambah_stok_produk($id_produk, $jumlah, $x->harga_beli, "agen");
        }
    }

}

