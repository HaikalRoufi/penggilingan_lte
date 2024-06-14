<?php
class auth Extends CI_Controller {

    public function index()
    {
        $this->load->view('form_login');
    }

    public function cek_login(){
        if (isset($_POST['submit'])) {
            # proses login disini
            # ambil data inputan (user & pass) dari form
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            # cek data input ada/tidak pada DB
            $tes = $this->m_auth->login($username, $password);
            $akses = $this->m_auth->akses($username, $password);
            $nama = $this->m_auth->getDataLogin($username, $password) != "" ? $this->m_auth->getDataLogin($username, $password)->nama : "";
            if ($tes == 1) {
                # jika data ditemukan set session & redirect ke home
                $data = array(
                    'status_login' => 'okemasuk',
                    'nama' => $nama,
                    'username' => $username,
                    'akses' => $akses
                );
                
                $this->session->set_userdata($data);
                redirect('dashboard', 'refresh');
            } else {
                # jika data tidak ditemukan kembali ke form login
                $this->session->set_flashdata('error', "Data tidak ditemukan!!!");
                redirect('auth/cek_login','refresh');
            }
        } else {
            # cek session login, jika session sebelumnya masih ada/tidak
            cek_session_login();
            $this->load->view('form_login');
        }

    }

    public function logout(){
        # mengakhiri session, dan redirect ke form_login
        $this->session->sess_destroy();
        redirect('/auth', 'refresh'); 
    }
}