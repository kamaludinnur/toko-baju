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

}