<?php
class Order_model extends Model {

    function Order_model()
    {
        parent::Model();
    }

    function insert_order($data)
    {
        $this->db->insert('order', $data);
        return $this->db->insert_id();
    }
    
    function insert_pembayaran($data)
    {
        return $this->db->insert('pembayaran', $data);
    }

    function insert_poin($data)
    {
        if($data['poin']!=0) return $this->db->insert('poin_agen', $data);
    }

    function get_order($id_order)
    {
        $q = $this->db->get_where('order', array('id' => intval($id_order)));

        if($q->num_rows() > 0)
        {
            return $q->row();
        }
        else return false;
    }

    function get_detail_order($tabel, $id_order, $transactor = 'konsumen')
    {
        $data = array();

        $agen_string = '';

        if ($transactor == 'agen') $agen_string = ", t.agen AS agen";

        $q = $this->db->query("SELECT
                                  produk.id         AS id_produk,
                                  merek.id          AS id_merek,
                                  merek.nama        AS merek,
                                  produk.model      AS id_model,
                                  model.nama        AS model,
                                  produk.warna      AS id_warna,
                                  warna.nama        AS warna,
                                  produk.ukuran     AS id_ukuran,
                                  ukuran.nama       AS ukuran,
                                  t.jumlah         AS jumlah,
                                  t.harga          AS harga
                                  {$agen_string}
                                FROM {$tabel} AS t, produk, merek, model, warna, ukuran
                                WHERE t.produk = produk.id
                                  AND produk.model  = model.id
                                  AND produk.ukuran = ukuran.id
                                  AND produk.warna  = warna.id
                                  AND model.merek   = merek.id
                                  AND t.order       = {$id_order}");

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

}