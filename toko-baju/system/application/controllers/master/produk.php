<?php

class Produk extends Controller {

    function Produk()
    {
        parent::Controller();
        $this->load->model('Produk_model', 'produk');
        $this->load->model('Model_baju_model', 'model_baju');
        $this->load->model('Warna_model', 'warna');
        $this->load->model('Ukuran_model', 'ukuran');
        $this->load->model('Merek_model', 'merek');
    }

    function index()
    {
        redirect('master/produk/manage');
    }

    function manage()
    {
        $this->load->library('pagination');

        $data = new stdClass();

        // store the sorting
        // kalo belum ada, default
        if (!$this->session->userdata('prod_sort_0'))
        {
            $prod_sorting = array(
                'prod_sort_0' => 'merek',
                'prod_sort_1' => 'model',
                'prod_sort_2' => 'warna',
                'prod_sort_3' => 'id_ukuran'
            );

            $this->session->set_userdata($prod_sorting);
        }

        $order0 = $this->session->userdata('prod_sort_0');
        $order1 = $this->session->userdata('prod_sort_1');
        $order2 = $this->session->userdata('prod_sort_2');
        $order3 = $this->session->userdata('prod_sort_3');

        // paging
        $mulai = $this->uri->segment(4, 0);
        $limit_per_halaman = 25;

        $data->daftar_produk = $this->produk->get_semua_produk($order0, $order1, $order2, $order3, $mulai, $limit_per_halaman);

        $paging['base_url']     = site_url("master/produk/manage");
        $paging['total_rows']   = $this->produk->jumlah_semua_produk();
        $paging['per_page']     = $limit_per_halaman;
        $paging['uri_segment']  = 4;
        $paging['next_link'] 	= 'Berikutnya &raquo;';
        $paging['prev_link'] 	= '&laquo; Sebelumnya ';
        $paging['first_link']   = '&lsaquo; Awal';
        $paging['last_link']    = 'Akhir &rsaquo;';

        $this->pagination->initialize($paging);

        $data->page_links = $this->pagination->create_links();

        // view yang memuat isi halamannya
        $data->view_konten = "produk";
        $data->title = "Manajemen Produk";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }

    function sort($by, $dir = "ASC")
    {
        /* sorting schema:
         * default   : merek, model, warna, ukuran
         * by merek  : merek, model, warna, ukuran
         * by model  : model, merek, warna, ukuran
         * by warna  : warna, merek, model, ukuran
         * by ukuran : ukuran, merek, model, warna
         * by stok   : stok, merek, model, warna
         * by h_b    : h_b, merek, model, warna
         * by h_j    : h_j, merek, model, warna
         */

        $sort_by = array();
        $prod_sort = array();

        switch($by)
        {
            case 'merek'      : $sort_by = array('merek', 'model', 'warna', 'id_ukuran'); break;
            case 'model'      : $sort_by = array('model', 'merek', 'warna', 'id_ukuran'); break;
            case 'warna'      : $sort_by = array('warna', 'merek', 'model', 'id_ukuran'); break;
            case 'ukuran'     : $sort_by = array('id_ukuran', 'merek', 'model', 'warna'); break;
            case 'stok'       : $sort_by = array('stok', 'merek', 'model', 'warna'); break;
            case 'harga_beli' : $sort_by = array('harga_beli', 'merek', 'model', 'warna'); break;
            case 'harga_jual' : $sort_by = array('harga_jual', 'merek', 'model', 'warna'); break;
            default           : $sort_by = array('merek', 'model', 'warna', 'id_ukuran'); break;
        }

        for($i = 0; $i <= 3; $i++)
        {
            $prod_sort['prod_sort_' . $i] = $sort_by[$i] . " " . $dir;
        }

        $this->session->set_userdata($prod_sort);

        redirect('master/produk');

    }

    function entri()
    {
        // $this->session->unset_userdata('produk_temp');

        $data = new stdClass();

        /* masa lalu

        $daftar_produk = unserialize($this->session->userdata('produk_temp'));
        
        // onsubmit
        if ($this->input->post('submit'))
        {
            $id_model = $this->input->post('id_model');
            $id_warna = $this->input->post('id_warna');
            $id_ukuran = $this->input->post('id_ukuran');
            $stok = $this->input->post('stok');
            $harga_beli = $this->input->post('harga_beli');
            $harga_jual = $this->input->post('harga_jual');
            $keterangan = $this->input->post('keterangan');

            // cek di databes
            $sudah_ada_di_db = is_object($this->produk->get_produk($id_model, $id_warna, $id_ukuran));

            $new_produk = array(
                'model' => $id_model,
                'warna' => $id_warna,
                'ukuran' => $id_ukuran,
                'stok' => $stok,
                'harga_beli' => $harga_beli,
                'harga_jual' => $harga_jual,
                'keterangan' => $keterangan
            );

            // cek di kukis
            foreach ($daftar_produk as $produk)
            {
                $sudah_ada_di_kukis = ($produk['model'] == $id_model) AND ($produk['warna'] == $id_warna) AND ($produk['ukuran'] == $id_ukuran);
            }

            if ($sudah_ada_di_kukis) echo "UDAH ADA"; else echo "BELUM ADA";

            $daftar_produk[] = $new_produk;

            $this->session->set_userdata('produk_temp', serialize($daftar_produk));

            echo "<pre>";
            print_r(unserialize($this->session->userdata('produk_temp')));
            echo "</pre>";

            die();

        }

        $data->daftar_produk = $daftar_produk;

        */

        $data->custom_sidebar = "sidebar_entri_produk";

        $data->daftar_merek = $this->merek->get_semua_merek();
        $data->daftar_warna = $this->warna->get_semua_warna();
        $data->daftar_ukuran = $this->ukuran->get_semua_ukuran('id');

        // view yang memuat isi halamannya
        $data->view_konten = "produk_entri";
        $data->title = "Entri Produk";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }

    function cek_database($id_model, $id_warna, $id_ukuran)
    {
        // dipanggil oleh AJAX
        // 
        // cek di databes
        $sudah_ada_di_db = is_object($this->produk->get_produk($id_model, $id_warna, $id_ukuran));

        if ($sudah_ada_di_db)
        {
            echo "1";
            exit;
        }
    }

    function load_model($merek)
    {
        $x = $this->model_baju->get_semua_model_by_merek($merek);
        $data = new stdClass();
        $data->daftar_model = $x;
        $data->merek = $merek;
        $this->load->view('master/ajax_model', $data);
    }

    function post()
    {
        // called via AJAX
        // TODO: server-side sanitize
        $data = array(
            'model' => $this->input->post('model'),
            'warna' => $this->input->post('warna'),
            'ukuran' => $this->input->post('ukuran'),
            'stok' => $this->input->post('stok'),
            'harga_beli' => $this->input->post('harga_beli'),
            'harga_jual' => $this->input->post('harga_jual'),
            'keterangan' => $this->input->post('keterangan'),
        );

        if ($this->produk->insert_produk($data))
        {
            $data['id'] = $this->db->insert_id();
            echo json_encode($data);
            exit;
        }
    }

    function tambah_stok($id)
    {
        $data = new stdClass();

        // called via AJAX
        if ($this->input->post('new_id'))
        {
            $stok_baru = intval($this->input->post('new_stok'));
            $hb_baru   = floatval($this->input->post('new_harga_beli'));

            if ($stok_baru < 0) $stok_baru = 0; // wkwkwk
            if ($hb_baru < 0) $hb_baru = 0;

            $id_stok_baru = $this->produk->tambah_stok_produk($this->input->post('new_id'), $stok_baru, $hb_baru);

            if ($id_stok_baru)
            {
                $produk = $this->produk->get_produk_by_id($id);

                $data_produk = array(
                    'newStok' => $produk->stok,
                    'newHB' => number_format($produk->harga_beli, 0, ',', '.')
                );

                echo json_encode($data_produk);
                exit;
            }
        }

        $data->id = $id;

        $data->data_produk = $this->produk->get_produk_by_id($id);

        $this->load->view('master/produk_tambah_stok_dialog', $data);
    }

}