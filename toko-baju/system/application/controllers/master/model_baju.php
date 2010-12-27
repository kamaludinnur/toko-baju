<?php

class Model_baju extends Controller {

    function Model_baju()
    {
        parent::Controller();
        $this->load->model('Model_baju_model', 'model_baju');
        $this->load->model('Merek_model', 'merek');
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
        $data->title = "Manajemen Model_baju";

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

}