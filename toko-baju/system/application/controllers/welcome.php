<?php

class Welcome extends Controller {

	function Welcome()
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
        $this->load->view('base', $data);
    }


}