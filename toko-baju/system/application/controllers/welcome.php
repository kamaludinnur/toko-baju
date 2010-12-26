<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
	
	function index()
	{
            #$this->load->model('Transaksi_konsumen', 'trans_konsumen');
            #echo $this->trans_konsumen->tambah_transaksi(1,2);
            #echo $this->trans_konsumen->tambah_transaksi(2,2);
            #echo $this->trans_konsumen->tambah_transaksi(3,1);
            #echo $this->trans_konsumen->tambah_transaksi(11,2);
            //$this->load->model('Transaksi_agen', 'trans_agen');
//            echo $this->trans_agen->tambah_transaksi(1,5,1);
//            echo $this->trans_agen->tambah_transaksi(2,5,1);
//            echo $this->trans_agen->tambah_transaksi(3,5,1);
            $this->load->model('Reject_model', 'reject');
            echo $this->reject->reject_konsumen(11,1,160000);
//            $this->load->model('Retur', 'retur');
//            echo $this->retur->retur_konsumen(2,2,26000);
            /*$this->load->model('Produk', 'produk');
            $data = array("model"=>2,
                    "ukuran"=>2,
                    "warna"=>4,
                    "stok"=>20,
                    "harga_beli"=>63000,
                    "harga_jual"=>160000
                    );
            $s=array("stok"=>10,"harga_beli"=>8000);
            echo $this->produk->insert_produk($data);*/
            /*$this->load->model('Agen', 'agen');
            $data = array("kode"=>"X007",
                    "nama"=>"Arief",
                    "hp"=>"0856890004",
                    "alamat"=>"Kp geledug RT sekian RW sekian",
                    "diskon"=>30,
                    "keterangan"=>"Ini sangat rajin belanja"
                    );
            echo $this->agen->update_agen(1,$data);*/


            //echo $this->produk->get_produk(35,2,1)->nama;

//		$this->load->view('welcome_message');
             
             
	}
        
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */