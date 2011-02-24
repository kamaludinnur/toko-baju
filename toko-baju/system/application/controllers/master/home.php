<?php

class Home extends Controller {

    function Home()
    {
        parent::Controller();
    }


    function index()
    {
        if(!$this->session->userdata('master_login'))
            redirect('master/home/login');

        $data = new stdClass();

        $data->title = "Home";

        // view yang memuat isi halamannya
        $data->view_konten = "home";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }

    function login()
    {
        // jangan login ulang
        if($this->session->userdata('master_login'))
            redirect('master/home');

        if($this->input->post('submit'))
        {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));

            $admin_username = $this->db->get_where('setting', array('item' => 'admin_username'))->result();
            $admin_username = $admin_username[0]->value;
            $admin_password = $this->db->get_where('setting', array('item' => 'admin_password'))->result();
            $admin_password = $admin_password[0]->value;

            if($username == $admin_username && $password == $admin_password)
            {
                $this->session->set_userdata('master_login', true);
                redirect('master/home');
            }
            else
            {
                $this->session->set_flashdata('login_fail', true);
                redirect('master/home/login');
            }

        }

        $this->load->view('master/login');
    }

    function logout()
    {
        if(!$this->session->userdata('master_login'))
            redirect('master/home/login');

        $this->session->unset_userdata('master_login');
        
        $this->load->view('master/login', array('logout' => true));
    }

    function ganti_password()
    {
        if(!$this->session->userdata('master_login'))
            redirect('master/home/login');

        $data = new stdClass();

        if($this->input->post('submit'))
        {
            $password_lama = md5($this->input->post('password_lama'));
            $password_baru = $this->input->post('password_baru2');

            $password_sekarang = $this->db->get_where('setting', array('item' => 'admin_password'))->result();
            $password_sekarang = $password_sekarang[0]->value;

            if($password_lama == $password_sekarang)
            {
                $data_update = array('value' => md5($password_baru));

                $this->db->where('item', 'admin_password');
                $this->db->update('setting', $data_update);

                $data->password_diganti = true;
            }
            else
            {
                $data->password_lama_salah = true;
            }

        }


        $data->title = "Ganti password";

        // view yang memuat isi halamannya
        $data->view_konten = "ch_pass";

        // ambil view "master_base.php" (templet dasar)
        $this->load->view('master/master_base', $data);
    }

    function db_dump()
    {
        header("Content-type: text/x-sql");
        header('Content-Disposition: attachment; filename="backup_database_' . date('d-M-Y_H-i-s')  . '.sql"');
        echo `mysqldump --opt --host=localhost --user=root --password=1234 tokobaju`;
    }

}