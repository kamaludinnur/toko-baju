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
            'kode' => $this->input->post('new_kode'),
            'nama' => $this->input->post('new_nama'),
            'diskon' => floatval($this->input->post('new_diskon')),
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
            'kode' => $this->input->post('kode'),
            'nama' => $this->input->post('nama'),
            'diskon' => floatval($this->input->post('diskon')),
            'keterangan' => $this->input->post('keterangan')
        );

        $id_agen = intval($this->input->post('id'));

        if (empty($agen['nama'])) redirect('master/agen');

        if ($this->agen->update_agen($id_agen, $agen))
        {
            return $id_agen;
        }
    }

    function quick_entry()
    {
        // called via AJAX
        if ($this->input->post('new_nama'))
        {
            $id_agen_baru = $this->insert();

            echo $id_agen_baru;
            exit;
        }

        $this->load->view('master/agen_quick_entry');
    }

    function refresh_agen()
    {
        // me-refresh dropdown agen
        // via AJAX
        $daftar_agen = $this->agen->get_semua_agen();

        echo "<option>Pilih agen:</option>\n";
        foreach ($daftar_agen as $agen)
        {
            echo "<option value='{$agen['id']}'>{$agen['nama']}</option>\n";
        }
    }

    function hapus($id_agen)
    {
        // called via AJAX
        if ($this->agen->aman_dihapus($id_agen))
        {
            $q = $this->db->query("DELETE FROM agen WHERE id = {$id_agen}");

            if ($q) echo "1"; else echo "0";
            exit;

        } else echo "0";
    }

}
