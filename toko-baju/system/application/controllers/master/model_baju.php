<?php

class Model_baju extends Controller {

    function Model_baju()
    {
        parent::Controller();
        $this->load->model('Model_baju_model', 'model_baju');
        $this->load->model('Merek_model', 'merek');

        if(!$this->session->userdata('master_login'))
            redirect('master/home/login');

    }

    function index()
    {
        redirect('master/model_baju/manage');
    }

    function manage($sort_by = 'id')
    {
        $data = new stdClass();

        $data->id_model_baju_baru = 0;

        echo $this->input->get('search');

        // kalo ada bau-bau submit
        if($this->input->post('submit'))
        {
            $data->id_model_baju_baru = $this->insert();
        }

        if($this->input->post('edit_submit'))
        {
            $data->id_model_baju_baru = $this->update();
        }

        $data->daftar_model_baju = $this->model_baju->get_semua_model($sort_by);
        $data->title = "Manajemen Model";

        $data->sort_by = $sort_by;
        $data->daftar_merek = $this->merek->get_semua_merek();

        // view yang memuat isi halamannya
        $data->view_konten = "model_baju";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }

    function insert()
    {
        $model_baju = array(
            'nama' => $this->input->post('new_nama'),
            'merek' => $this->input->post('new_merek'),
            'keterangan' => $this->input->post('new_keterangan')
        );

        if (empty($model_baju['nama'])) redirect('master/model_baju');

        if ($this->model_baju->insert_model($model_baju))
        {
            return $this->db->insert_id();
        }
    }

    function update()
    {
        $model_baju = array(
            'nama' => $this->input->post('nama'),
            'merek' => $this->input->post('merek'),
            'keterangan' => $this->input->post('keterangan')
        );

        $id_model_baju = intval($this->input->post('id'));

        if (empty($model_baju['nama'])) redirect('master/model_baju');

        if ($this->model_baju->update_model($id_model_baju, $model_baju))
        {
            return $id_model_baju;
        }
    }

    function tambah_untuk_merek($merek)
    {
        // submit (via AJAX)
        if($this->input->post('new_merek'))
        {
            $id_model_baru = $this->insert();

            echo $id_model_baru;
            exit;
        }
        
        $data = new stdClass();
        $data->merek = $merek;

        $this->load->view('master/model_baju_quick_entry', $data);
    }

    function hapus($id_model)
    {
        // called via AJAX
        if ($this->model_baju->aman_dihapus($id_model))
        {
            $q = $this->db->query("DELETE FROM model WHERE id = {$id_model}");

            if ($q) echo "1"; else echo "0";
            exit;

        } else echo "0";
    }
}