<?php

class C_user extends CI_Controller
{
    public function __construct()
    {
            parent::__construct();
            cek_session();
            if ($this->session->userdata('akses') != 'superadmin') {
                redirect('dashboard', 'refresh');
            }
    }

    public function index()
    {
        $data['nama_user'] = $this->m_user->getAllandUserRole();
        $data['akses'] = $this->m_role->getAll();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('penggilingan/data_user', $data);
        $this->load->view('templates/footer');
    }
    public function add_user()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[t_user.username]');
        $this->form_validation->set_rules('password', 'Pasword', 'required');
        $this->form_validation->set_rules('akses', 'Akses', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal Di Tambahkan " . validation_errors());
            redirect('c_user');
        } else {
            $nama = $this->input->post('nama');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $akses = $this->input->post('akses');

            $hashed_password = md5($password);

            $data = array(
                'nama' => $nama,
                'username' => $username,
                'password' => $hashed_password,
                'role_id' => $akses,
            );

            $this->m_user->add_user($data, 't_user');
            $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
            redirect('c_user');
        }
    }

    public function update()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'callback_check_username');
        $this->form_validation->set_rules('akses', 'Akses', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal Di Update " . validation_errors());
            redirect('c_user');
        } else {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $akses = $this->input->post('akses');

            $hashed_password = md5($password);

            if ($password != "") {
                $data = array(
                    'nama' => $nama,
                    'username' => $username,
                    'password' => $hashed_password,
                    'role_id' => $akses,
                );
            } else {
                $data = array(
                    'nama' => $nama,
                    'username' => $username,
                    'role_id' => $akses,
                );
            }

            $where = array(
                'id' => $id
            );

            $this->m_jenis_padi->update_data($where, $data, 't_user');
            $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
            redirect('c_user');
        }
    }

    function check_username($username){
        $username_lama = $this->input->post('username_lama');
        if ($username_lama != $username) {
            $result = $this->m_user->check_unique_username($username);
            if ($result == 0) {
                $response = true;
            } else {
                $this->form_validation->set_message('check_username', 'Username must be unique');
                $response = false;
            }
            return $response;
        }
    }

    public function hapus($id)
    {
        if ($id == "") {
            $this->session->set_flashdata('error', "Data Anda Gagal Di Hapus");
            redirect('Modal');
            redirect('c_user');
        } else {
            $this->m_user->hapus_data($id, 't_user');
            $this->session->set_flashdata('sukses', "Data Berhasil Dihapus");
            redirect('c_user');
        }
    }



}