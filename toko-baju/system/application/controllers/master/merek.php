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

    function manage()
    {
        $data = new stdClass();

        $data->daftar_merek = $this->merek->get_semua_merek('id');
        $data->title = "Manajemen Merek";

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
            $this->session->set_flashdata('id_merek_baru', $this->db->insert_id());
            redirect('master/merek/manage');
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
            $this->session->set_flashdata('id_merek_baru', $id_merek);
            redirect('master/merek/manage');
        }
    }

}