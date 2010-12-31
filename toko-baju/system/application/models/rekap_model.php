<?php

class Rekap_model extends Model {

    function Rekap_model()
    {
        parent::Model();
    }

    function get_transaksi_konsumen($start_date, $end_date, $order_by = 'tanggal ASC', $filter = array())
    {
        $data = array();

        // formatting
        // from mm/dd/yyyy to yyyy-mm-dd

        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));
        
        $query_string = "   SELECT
                              produk.id         AS id_produk,
                              merek.id          AS id_merek,
                              merek.nama        AS merek,
                              produk.model      AS id_model,
                              model.nama        AS model,
                              produk.warna      AS id_warna,
                              warna.nama        AS warna,
                              produk.ukuran     AS id_ukuran,
                              ukuran.nama       AS ukuran,
                              tk.jumlah         AS jumlah,
                              tk.harga          AS harga,
                              tk.keuntungan     AS keuntungan,
                              tk.tanggal        AS tanggal
                            FROM transaksi_konsumen AS tk, produk, merek, model, warna, ukuran
                            WHERE tk.produk = produk.id
                              AND produk.model  = model.id
                              AND produk.ukuran = ukuran.id
                              AND produk.warna  = warna.id
                              AND model.merek   = merek.id
                              AND DATE_FORMAT(tk.tanggal, '%Y-%m-%d') >= '{$start_date}' AND DATE_FORMAT(tk.tanggal, '%Y-%m-%d') <= '{$end_date}'";
        if (count($filter) > 0) $query_string .= ' AND ' . implode($filter, ' AND ');
        $query_string .=   "ORDER BY {$order_by}, merek, model, warna, ukuran";

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

    function get_transaksi_agen($start_date, $end_date, $order_by = 'tanggal ASC', $filter = array())
    {
        $data = array();

        // formatting
        // from mm/dd/yyyy to yyyy-mm-dd

        $start_date = date('Y-m-d', strtotime($start_date));
        $end_date = date('Y-m-d', strtotime($end_date));

        $query_string = "   SELECT
                                produk.id       AS id_produk,
                                merek.id        AS id_merek,
                                merek.nama      AS merek,
                                produk.model    AS id_model,
                                model.nama      AS model,
                                produk.warna    AS id_warna,
                                warna.nama      AS warna,
                                produk.ukuran   AS id_ukuran,
                                ukuran.nama     AS ukuran,
                                ta.agen         AS id_agen,
                                agen.nama       AS agen,
                                agen.kode       AS kode_agen,
                                ta.jumlah       AS jumlah,
                                ta.harga        AS harga,
                                ta.keuntungan   AS keuntungan,
                                ta.tanggal      AS tanggal
                            FROM transaksi_agen AS ta, produk, merek, model, warna, ukuran, agen
                            WHERE ta.produk = produk.id
                                AND ta.agen = agen.id
                                AND produk.model = model.id
                                AND produk.ukuran = ukuran.id
                                AND produk.warna = warna.id
                                AND model.merek = merek.id
                                AND DATE_FORMAT(ta.tanggal, '%Y-%m-%d') >= '{$start_date}' AND DATE_FORMAT(ta.tanggal, '%Y-%m-%d') <= '{$end_date}'";
        if (count($filter) > 0) $query_string .= ' AND ' . implode($filter, ' AND ');
        $query_string .=   "ORDER BY {$order_by}, merek, model, warna, ukuran";

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

}