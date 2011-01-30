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
                              tk.tanggal        AS tanggal,
                              tk.order          AS id_order
                            FROM transaksi_konsumen AS tk, produk, merek, model, warna, ukuran
                            WHERE tk.produk = produk.id
                              AND produk.model  = model.id
                              AND produk.ukuran = ukuran.id
                              AND produk.warna  = warna.id
                              AND model.merek   = merek.id
                              AND DATE_FORMAT(tk.tanggal, '%Y-%m-%d') >= '{$start_date}' AND DATE_FORMAT(tk.tanggal, '%Y-%m-%d') <= '{$end_date}'";
        if (count($filter) > 0) $query_string .= ' AND ' . implode($filter, ' AND ');
        $query_string .=   " ORDER BY id_order, {$order_by}, merek, model, warna, ukuran";

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
                                ta.tanggal      AS tanggal,
                                ta.order        AS id_order
                            FROM transaksi_agen AS ta, produk, merek, model, warna, ukuran, agen
                            WHERE ta.produk = produk.id
                                AND ta.agen = agen.id
                                AND produk.model = model.id
                                AND produk.ukuran = ukuran.id
                                AND produk.warna = warna.id
                                AND model.merek = merek.id
                                AND DATE_FORMAT(ta.tanggal, '%Y-%m-%d') >= '{$start_date}' AND DATE_FORMAT(ta.tanggal, '%Y-%m-%d') <= '{$end_date}'";
        if (count($filter) > 0) $query_string .= ' AND ' . implode($filter, ' AND ');
        $query_string .=   " ORDER BY id_order, {$order_by}, merek, model, warna, ukuran";

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

    function get_kehilangan($start_date, $end_date, $order_by = 'tanggal ASC', $filter = array())
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
                              tk.kerugian       AS kerugian,
                              tk.tanggal        AS tanggal,
                              tk.order          AS id_order
                            FROM transaksi_kehilangan AS tk, produk, merek, model, warna, ukuran
                            WHERE tk.produk = produk.id
                              AND produk.model  = model.id
                              AND produk.ukuran = ukuran.id
                              AND produk.warna  = warna.id
                              AND model.merek   = merek.id
                              AND DATE_FORMAT(tk.tanggal, '%Y-%m-%d') >= '{$start_date}' AND DATE_FORMAT(tk.tanggal, '%Y-%m-%d') <= '{$end_date}'";
        if (count($filter) > 0) $query_string .= ' AND ' . implode($filter, ' AND ');
        $query_string .=   " ORDER BY id_order, {$order_by}, merek, model, warna, ukuran";

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



    // retur classes ===========================================================

    function get_retur_konsumen($start_date, $end_date, $order_by = 'tanggal ASC', $filter = array())
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
                              tk.refund         AS refund,
                              tk.tanggal        AS tanggal,
                              tk.order          AS id_order
                            FROM transaksi_retur AS tk, produk, merek, model, warna, ukuran
                            WHERE tk.produk = produk.id
                              AND produk.model  = model.id
                              AND produk.ukuran = ukuran.id
                              AND produk.warna  = warna.id
                              AND model.merek   = merek.id
                              AND tk.agen       = 0
                              AND DATE_FORMAT(tk.tanggal, '%Y-%m-%d') >= '{$start_date}' AND DATE_FORMAT(tk.tanggal, '%Y-%m-%d') <= '{$end_date}'";
        if (count($filter) > 0) $query_string .= ' AND ' . implode($filter, ' AND ');
        $query_string .=   " ORDER BY id_order, {$order_by}, merek, model, warna, ukuran";

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

    function get_retur_agen($start_date, $end_date, $order_by = 'tanggal ASC', $filter = array())
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
                                ta.refund       AS refund,
                                ta.tanggal      AS tanggal,
                                ta.order        AS id_order
                            FROM transaksi_retur AS ta, produk, merek, model, warna, ukuran, agen
                            WHERE ta.produk = produk.id
                                AND ta.agen = agen.id
                                AND produk.model = model.id
                                AND produk.ukuran = ukuran.id
                                AND produk.warna = warna.id
                                AND model.merek = merek.id
                                AND DATE_FORMAT(ta.tanggal, '%Y-%m-%d') >= '{$start_date}' AND DATE_FORMAT(ta.tanggal, '%Y-%m-%d') <= '{$end_date}'";
        if (count($filter) > 0) $query_string .= ' AND ' . implode($filter, ' AND ');
        $query_string .=   " ORDER BY id_order, {$order_by}, merek, model, warna, ukuran";

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

    // retur classes ===========================================================

    function get_reject_konsumen($start_date, $end_date, $order_by = 'tanggal ASC', $filter = array())
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
                              tk.refund         AS refund,
                              tk.tanggal        AS tanggal,
                              tk.order          AS id_order
                            FROM transaksi_reject AS tk, produk, merek, model, warna, ukuran
                            WHERE tk.produk = produk.id
                              AND produk.model  = model.id
                              AND produk.ukuran = ukuran.id
                              AND produk.warna  = warna.id
                              AND model.merek   = merek.id
                              AND tk.agen       = 0
                              AND DATE_FORMAT(tk.tanggal, '%Y-%m-%d') >= '{$start_date}' AND DATE_FORMAT(tk.tanggal, '%Y-%m-%d') <= '{$end_date}'";
        if (count($filter) > 0) $query_string .= ' AND ' . implode($filter, ' AND ');
        $query_string .=   " ORDER BY id_order, {$order_by}, merek, model, warna, ukuran";

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

    function get_reject_agen($start_date, $end_date, $order_by = 'tanggal ASC', $filter = array())
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
                                ta.refund       AS refund,
                                ta.tanggal      AS tanggal,
                                ta.order        AS id_order
                            FROM transaksi_reject AS ta, produk, merek, model, warna, ukuran, agen
                            WHERE ta.produk = produk.id
                                AND ta.agen = agen.id
                                AND produk.model = model.id
                                AND produk.ukuran = ukuran.id
                                AND produk.warna = warna.id
                                AND model.merek = merek.id
                                AND DATE_FORMAT(ta.tanggal, '%Y-%m-%d') >= '{$start_date}' AND DATE_FORMAT(ta.tanggal, '%Y-%m-%d') <= '{$end_date}'";
        if (count($filter) > 0) $query_string .= ' AND ' . implode($filter, ' AND ');
        $query_string .=   " ORDER BY id_order, {$order_by}, merek, model, warna, ukuran";

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

    // =========================================================================

    function get_record_stok_by_produk($id_merek = 0, $id_model = 0, $id_warna = 0, $id_ukuran = 0, $order_by = 'tanggal ASC')
    {
        $data = array();

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
                              rs.tanggal        AS tanggal,
                              rs.stok_akhir     AS stok_akhir,
                              rs.jenis          AS jenis
                            FROM record_stok AS rs, produk, merek, model, warna, ukuran
                            WHERE rs.produk = produk.id
                              AND produk.model  = model.id
                              AND produk.ukuran = ukuran.id
                              AND produk.warna  = warna.id
                              AND model.merek   = merek.id ";

        if ($id_merek != 0) $query_string .= " AND merek.id = {$id_merek}";
        if ($id_model != 0) $query_string .= " AND produk.model = {$id_model}";
        if ($id_warna != 0) $query_string .= " AND produk.warna = {$id_warna}";
        if ($id_ukuran != 0) $query_string .= " AND produk.ukuran = {$id_ukuran}";

        $query_string .=   " ORDER BY {$order_by}, merek, model, warna, ukuran";

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

    function get_record_stok_by_tanggal($start_date, $end_date, $order_by = 'tanggal ASC')
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
                              rs.tanggal        AS tanggal,
                              rs.stok_akhir     AS stok_akhir,
                              rs.jenis          AS jenis
                            FROM record_stok AS rs, produk, merek, model, warna, ukuran
                            WHERE rs.produk = produk.id
                              AND produk.model  = model.id
                              AND produk.ukuran = ukuran.id
                              AND produk.warna  = warna.id
                              AND model.merek   = merek.id
                              AND DATE_FORMAT(rs.tanggal, '%Y-%m-%d') >= '{$start_date}' AND DATE_FORMAT(rs.tanggal, '%Y-%m-%d') <= '{$end_date}'";

        $query_string .=   " ORDER BY {$order_by}, merek, model, warna, ukuran";

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