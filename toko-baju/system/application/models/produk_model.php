<?php
class Produk_model extends Model {

    function Produk_model()
    {
        parent::Model();
    }

    function get_semua_produk($order0 = 'merek', $order1 = 'model', $order2 = 'warna', $order3 = 'id_ukuran', $mulai = 0, $sebanyak = 25, $filter = array())
    {
        $data = array();
        $query_string  =   "SELECT
                              produk.id         AS id,
                              merek.id          AS id_merek,
                              merek.nama        AS merek,
                              produk.model      AS id_model,
                              model.nama        AS model,
                              produk.warna      AS id_warna,
                              warna.nama        AS warna,
                              produk.ukuran     AS id_ukuran,
                              ukuran.nama       AS ukuran,
                              produk.stok       AS stok,
                              produk.harga_beli AS harga_beli,
                              produk.harga_jual AS harga_jual,
                              produk.keterangan AS keterangan
                            FROM produk, model, ukuran, warna, merek
                            WHERE produk.model  = model.id
                              AND produk.ukuran = ukuran.id
                              AND produk.warna  = warna.id
                              AND model.merek   = merek.id ";

        if (count($filter) > 0) $query_string .= ' AND ' . implode($filter, ' AND ');

        $query_string .=   " ORDER by $order0, $order1, $order2, $order3
                            LIMIT $mulai, $sebanyak";

        $q = $this->db->query($query_string);

        if($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data[] = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    function jumlah_semua_produk()
    {
        return $this->db->count_all('produk');
    }

    function get_produk($model, $warna, $ukuran)
    {
        $data = "";
        $q = $this->db->query("SELECT * FROM produk WHERE model = $model and warna = $warna and ukuran = $ukuran");

        if($q->num_rows() > 0)
        {
            $data = $q->row();
        }

        $q->free_result();
        return $data;
    }

    function get_produk_by_id($id_produk)
    {

        $data = "";
        $q = $this->db->query("SELECT
                                  produk.id         AS id,
                                  merek.id          AS id_merek,
                                  merek.nama        AS merek,
                                  produk.model      AS id_model,
                                  model.nama        AS model,
                                  produk.warna      AS id_warna,
                                  warna.nama        AS warna,
                                  produk.ukuran     AS id_ukuran,
                                  ukuran.nama       AS ukuran,
                                  produk.stok       AS stok,
                                  produk.harga_beli AS harga_beli,
                                  produk.harga_jual AS harga_jual,
                                  produk.keterangan AS keterangan
                                FROM produk, model, ukuran, warna, merek
                                WHERE produk.model  = model.id
                                  AND produk.ukuran = ukuran.id
                                  AND produk.warna  = warna.id
                                  AND model.merek   = merek.id
                                  AND produk.id = $id_produk");

        if($q->num_rows() > 0)
        {
            $data = $q->row();
        }

        $q->free_result();
        return $data;

    }

    function get_semua_warna_by_model($model)
    {
        $data = array();
        $q = $this->db->query("SELECT produk.warna as id, warna.nama as nama FROM produk join warna WHERE model = $model And produk.warna = warna.id GROUP BY produk.warna ORDER BY produk.id");

        if($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data[] = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    function get_semua_ukuran($model, $warna)
    {
        $data = array();
        $q = $this->db->query("SELECT produk.id as id, ukuran.nama as nama FROM produk join ukuran WHERE produk.model = $model And produk.ukuran = ukuran.id AND produk.warna=$warna  ORDER BY produk.id");

        if($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $data[] = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    function tambah_stok_produk($id_produk, $jumlah, $harga, $jenis="tambah")
    {
        $q = $this->get_produk_by_id($id_produk);
        $stok_awal = $q->stok;
        $harga_awal = $q->harga_beli * $stok_awal;
        $harga_sekarang = $harga * $jumlah;
        $total_stok = $stok_awal + $jumlah;
        $harga_rata_rata = ($harga_awal + $harga_sekarang)/$total_stok;

        // insert ke record_stok
        $data = array(
            "tanggal" => date("Y-m-d H:i:s"),
            "produk" => $id_produk,
            "jumlah" => $jumlah,
            "stok_akhir" => $total_stok,
            "jenis" => $jenis
        );
        $inserted_ke_stok = $this->db->insert('record_stok',$data);

        // update produk
        if($inserted_ke_stok)
        {
            $data_update = array(
                'harga_beli' => $harga_rata_rata,
                'stok' => $total_stok
            );
            
            return $this->update_produk($id_produk, $data_update);
        }

    }

    function insert_produk($data)
    {
        $q = $this->db->insert('produk', $data);

        // sekalian ke record_stok
        if ($q) {
            $id_produk = $this->db->insert_id();

            $data = array(  
                "produk" => $id_produk,
                "jumlah" => $data['stok'],
                "stok_akhir" => $data['stok'],
                "jenis" => "tambah",
                "tanggal" => date("Y-m-d H:i:s")
            );
            return $this->db->insert('record_stok',$data);
        }
    }
    
    function update_produk($id_produk, $data)
    {
        $this->db->where('id', $id_produk);
        return $this->db->update('produk', $data);
    }

    // pengecek apakah suatu produk aman dihapus atau nggak
    function aman_dihapus($id_produk)
    {
        // syarat aman dihapus: belum pernah ditransaksiin
        // hapus dari: produk, record_stok

        $jumlah_transaksi = $this->db->query("SELECT id FROM record_stok WHERE jenis != 'tambah' AND produk = {$id_produk}")->num_rows();

        if ($jumlah_transaksi > 0)
            return false; // kalo > 0 berarti ada modelnya => gak aman dihapus
        else
            return true;
    }

    function aman_diedit($id_produk)
    {
        // syarat aman diedit: belum pernah ditransaksiin + belum pernah tambah stok (baru pernah ditambahkan)
        // update: produk, record_stok

        $jumlah_transaksi = $this->db->query("SELECT id FROM record_stok WHERE jenis != 'tambah' AND produk = {$id_produk}")->num_rows();
        $jumlah_tambah_stok = $this->db->query("SELECT id FROM record_stok WHERE jenis = 'tambah' AND produk = {$id_produk}")->num_rows();

        if ($jumlah_tambah_stok == 1 && $jumlah_transaksi == 0)
            return true;
        else
            return false;

    }

}
