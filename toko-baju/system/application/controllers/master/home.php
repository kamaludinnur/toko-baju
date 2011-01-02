<?php

class Home extends Controller {

    function Home()
    {
        parent::Controller();
    }


    function index()
    {
        $data = new stdClass();

        $data->title = "Home";

        // view yang memuat isi halamannya
        $data->view_konten = "home";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }


}