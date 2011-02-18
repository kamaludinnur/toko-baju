<?php

class Transaksi_pelunasan_model extends Model {

    function Transaksi_pelunasan_model()
    {
        parent::Model();
    }

    function get_belum_lunas()
    {
        $data = array();
        $q = $this->db->query('select order.tanggal as tanggal,order.id as order_id, order.total as total, transaksi_agen.agen as agen_id, agen.nama as agen, agen.kode as kode_agen from `order`,transaksi_agen,agen where order.id=transaksi_agen.order and order.lunas=2 and transaksi_agen.agen=agen.id');

        if($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $order = $row['order_id'];
                $qq = $this->db->query("select sum(jumlah) as jumlah from pembayaran where `order` = $order");
                $sudah_dibayar = $qq->result_array();
                $row['dibayar'] = $sudah_dibayar[0]['jumlah'];
                $row['sisa'] = $row['total'] - $row['dibayar'];
                $data[] = $row;
            }
        }



        $q->free_result();
        return $data;
    }

    function set_lunas($id)
    {
        $data['lunas'] = 1;
        $this->db->where('id', $id);
        $this->db->update('order', $data);
    }

    function get_hutang($id)
    {
        $data = array();
        $q = $this->db->query('select order.tanggal as tanggal,order.id as order_id, order.total as total, transaksi_agen.agen as agen_id, agen.nama as agen, agen.kode as kode_agen from `order`,transaksi_agen,agen where order.id=transaksi_agen.order and order.lunas=2 and transaksi_agen.agen=agen.id and order.id='.$id);

        if($q->num_rows() > 0)
        {
            foreach ($q->result_array() as $row)
            {
                $order = $row['order_id'];
                $qq = $this->db->query("select sum(jumlah) as jumlah from pembayaran where `order` = $order");
                $sudah_dibayar = $qq->result_array();
                $row['dibayar'] = $sudah_dibayar[0]['jumlah'];
                $row['sisa'] = $row['total'] - $row['dibayar'];
                $data[] = $row;
            }
        }

        $q->free_result();
        return $data;
    }

    function get_pembayaran($val, $col = "`order`")
    {
        $data = array();
        $q = $this->db->query("SELECT * FROM pembayaran WHERE $col = $val");

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

    function insert_pembayaran($data)
    {
        return $this->db->insert('pembayaran', $data);
    }

    function update_pembayaran($id_agen, $data)
    {
        $this->db->where('id', $id_agen);
        return $this->db->update('pembayaran', $data);
    }


}