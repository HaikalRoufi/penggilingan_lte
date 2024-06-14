<?php

class C_jenis_padi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_session();
        if ($this->session->userdata('akses') != 'superadmin' && $this->session->userdata('akses') != 'admin') {
            redirect('dashboard', 'refresh');
        }
    }

    public function index()
    {
        $data['nama_jenis'] = $this->m_jenis_padi->getAll();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('penggilingan/jenis_padi', $data);
        $this->load->view('templates/footer');
    }

    public function add_jenis()
    {
        $this->form_validation->set_rules('nama_jenis', 'Nama Jenis', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal Di Tambahkan " . validation_errors());
            redirect('c_jenis_padi');
        } else {
            $nama_jenis = $this->input->post('nama_jenis');
            $harga = $this->input->post('harga');

            $data = array(
                'nama_jenis' => $nama_jenis,
                'harga' => str_replace(".", "", $harga),
            );

            $this->m_jenis_padi->add_jenis($data, 't_jenis');
            $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
            redirect('c_jenis_padi');
        }
    }


    public function update()
    {
        $this->form_validation->set_rules('nama_jenis', 'Nama Jenis', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal Di Update " . validation_errors());
            redirect('c_jenis_padi');
        } else {
            $id = $this->input->post('id_jenis');
            $nama_jenis = $this->input->post('nama_jenis');
            $harga = $this->input->post('harga');

            $data = array(
                'nama_jenis' => $nama_jenis,
                'harga' => str_replace(".", "", $harga),
            );

            $where = array(
                'id_jenis' => $id
            );

            $this->m_jenis_padi->update_data($where, $data, 't_jenis');
            $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
            redirect('c_jenis_padi');
        }
    }

    public function hapus($id)
    {
        if ($id == "") {
            $this->session->set_flashdata('error', "Data Anda Gagal Di Hapus");
            redirect('Modal');
            redirect('c_jenis_padi');
        } else {
            if ($this->m_jenis_padi->hapus_data($id, 't_jenis') == 0) {
                $this->session->set_flashdata('error', "Data Gagal Dihapus");
                redirect('c_jenis_padi');
            } else {
                $this->session->set_flashdata('sukses', "Data Berhasil Dihapus");
                redirect('c_jenis_padi');
            }
        }
    }



}