<?php

class Merek extends Controller {

    function Merek()
    {
        parent::Controller();
        $this->load->model('Merek_model', 'merek');
    }

    function index()
    {
        redirect('master/merek/manage');
    }

    function manage($sort_by = 'id')
    {
        $data = new stdClass();

        $data->id_merek_baru = 0;

        echo $this->input->get('search');

        // kalo ada bau-bau submit
        if($this->input->post('submit'))
        {
            $data->id_merek_baru = $this->insert();
        }

        if($this->input->post('edit_submit'))
        {
            $data->id_merek_baru = $this->update();
        }

        $data->daftar_merek = $this->merek->get_semua_merek($sort_by);
        $data->title = "Manajemen Merek";

        $data->sort_by = $sort_by;

        // view yang memuat isi halamannya
        $data->view_konten = "merek";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }

    function insert()
    {
        $merek = array(
            'nama' => $this->input->post('new_nama'),
            'keterangan' => $this->input->post('new_keterangan')
        );

        if (empty($merek['nama'])) redirect('master/merek');

        if ($this->merek->insert_merek($merek))
        {
            return $this->db->insert_id();
        }
    }

    function update()
    {
        $merek = array(
            'nama' => $this->input->post('nama'),
            'keterangan' => $this->input->post('keterangan')
        );

        $id_merek = intval($this->input->post('id'));

        if (empty($merek['nama'])) redirect('master/merek');

        if ($this->merek->update_merek($id_merek, $merek))
        {
            return $id_merek;
        }
    }

    function quick_entry()
    {
        // called via AJAX
        if ($this->input->post('new_nama'))
        {
            $id_merek_baru = $this->insert();

            echo $id_merek_baru;
            exit;
        }

        $this->load->view('master/merek_quick_entry');
    }

    function refresh_merek()
    {
        // me-refresh dropdown merek
        // via AJAX
        $daftar_merek = $this->merek->get_semua_merek();

        echo "<option>Pilih merek:</option>\n";
        foreach ($daftar_merek as $merek)
        {
            echo "<option value='{$merek['id']}'>{$merek['nama']}</option>\n";
        }
    }

}