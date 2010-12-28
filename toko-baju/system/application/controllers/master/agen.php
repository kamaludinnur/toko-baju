<?php

class Agen extends Controller {

    function Agen()
    {
        parent::Controller();
        $this->load->model('Agen_model', 'agen');
    }

    function index()
    {
        redirect('master/agen/manage');
    }

    function manage($sort_by = 'id')
    {
        $data = new stdClass();

        $data->id_agen_baru = 0;

        echo $this->input->get('search');

        // kalo ada bau-bau submit
        if($this->input->post('submit'))
        {
            $data->id_agen_baru = $this->insert();
        }

        if($this->input->post('edit_submit'))
        {
            $data->id_agen_baru = $this->update();
        }

        $data->daftar_agen = $this->agen->get_semua_agen($sort_by);
        $data->title = "Manajemen Agen";

        $data->sort_by = $sort_by;

        // view yang memuat isi halamannya
        $data->view_konten = "agen";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }

    function insert()
    {
        $agen = array(
            'nama' => $this->input->post('new_nama'),
            'keterangan' => $this->input->post('new_keterangan')
        );

        if (empty($agen['nama'])) redirect('master/agen');

        if ($this->agen->insert_agen($agen))
        {
            return $this->db->insert_id();
        }
    }

    function update()
    {
        $agen = array(
            'nama' => $this->input->post('nama'),
            'keterangan' => $this->input->post('keterangan')
        );

        $id_agen = intval($this->input->post('id'));

        if (empty($agen['nama'])) redirect('master/agen');

        if ($this->agen->update_agen($id_agen, $agen))
        {
            return $id_agen;
        }
    }

    function search($term)
    {

    }

}