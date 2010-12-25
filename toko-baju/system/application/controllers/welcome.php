<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
	
	function index()
	{
            $this->load->model('Transaksi_konsumen', 'trans_konsumen');
            echo $this->trans_konsumen->tambah_transaksi(146,2);
            /*$this->load->model('Produk', 'produk');
            $data = array("model"=>35,
                    "ukuran"=>2,
                    "warna"=>1,
                    "stok"=>20,
                    "harga_beli"=>12000,
                    "harga_jual"=>26000
                    );
            $s=array("stok"=>10,"harga_beli"=>8000);
            $this->produk->tambah_stok_produk(146, 20, 10000); /*
            $this->load->model('Agen', 'agen');
            $data = array("kode"=>"X0097",
                    "nama"=>"Arief",
                    "hp"=>"0856890004",
                    "alamat"=>"Kp geledug RT sekian RW sekian",
                    "diskon"=>0.3,
                    "keterangan"=>"Ini sangat rajin belanja"
                    );
            echo $this->agen->update_agen(1,$data);

            //echo $this->produk->get_produk(35,2,1)->nama;

//		$this->load->view('welcome_message');
             *
             */
	}
        
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */