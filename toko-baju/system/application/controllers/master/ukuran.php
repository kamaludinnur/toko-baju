<?php

class Ukuran extends Controller {

    function Ukuran()
    {
        parent::Controller();
        $this->load->model('Ukuran_model', 'ukuran');
    }

    function index()
    {
        redirect('master/ukuran/manage');
    }

    function manage($sort_by = 'id')
    {
        $data = new stdClass();

        $data->id_ukuran_baru = 0;

        echo $this->input->get('search');

        // kalo ada bau-bau submit
        if($this->input->post('submit'))
        {
            $data->id_ukuran_baru = $this->insert();
        }

        if($this->input->post('edit_submit'))
        {
            $data->id_ukuran_baru = $this->update();
        }

        $data->daftar_ukuran = $this->ukuran->get_semua_ukuran($sort_by);
        $data->title = "Manajemen Ukuran";

        $data->sort_by = $sort_by;

        // view yang memuat isi halamannya
        $data->view_konten = "ukuran";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }

    function insert()
    {
        $ukuran = array(
            'nama' => $this->input->post('new_nama'),
            'keterangan' => $this->input->post('new_keterangan')
        );

        if (empty($ukuran['nama'])) redirect('master/ukuran');

        if ($this->ukuran->insert_ukuran($ukuran))
        {
            return $this->db->insert_id();
        }
    }

    function update()
    {
        $ukuran = array(
            'nama' => $this->input->post('nama'),
            'keterangan' => $this->input->post('keterangan')
        );

        $id_ukuran = intval($this->input->post('id'));

        if (empty($ukuran['nama'])) redirect('master/ukuran');

        if ($this->ukuran->update_ukuran($id_ukuran, $ukuran))
        {
            return $id_ukuran;
        }
    }

    function quick_entry()
    {
        // called via AJAX
        if ($this->input->post('new_nama'))
        {
            $id_ukuran_baru = $this->insert();

            echo $id_ukuran_baru;
            exit;
        }

        $this->load->view('master/ukuran_quick_entry');
    }

    function refresh_ukuran()
    {
        // me-refresh dropdown ukuran
        // via AJAX
        $daftar_ukuran = $this->ukuran->get_semua_ukuran();

        echo "<option>Pilih ukuran:</option>\n";
        foreach ($daftar_ukuran as $ukuran)
        {
            echo "<option value='{$ukuran['id']}'>{$ukuran['nama']}</option>\n";
        }
    }

    function hapus($id_ukuran)
    {
        // called via AJAX
        if ($this->ukuran->aman_dihapus($id_ukuran))
        {
            $q = $this->db->query("DELETE FROM ukuran WHERE id = {$id_ukuran}");

            if ($q) echo "1"; else echo "0";
            exit;

        } else echo "0";
    }
}