<?php

class C_pelanggan extends CI_Controller
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
        $data['nama_pelanggan'] = $this->m_pelanggan->getAll();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('penggilingan/data_pelanggan', $data);
        $this->load->view('templates/footer');
    }

    public function add_pelanggan()
    {
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal Di Tambahkan " . validation_errors());
            redirect('c_pelanggan');
        } else {
            $kode_pelanggan = $this->m_pelanggan->CreateCode();
            $nama_pelanggan = $this->input->post('nama_pelanggan');
            $alamat = $this->input->post('alamat');
            $no_hp = $this->input->post('no_hp');

            $data = array(
                'kode_pelanggan' => $kode_pelanggan,
                'nama_pelanggan' => $nama_pelanggan,
                'alamat' => $alamat,
                'no_hp' => $no_hp,
            );

            $this->m_pelanggan->add_pelanggan($data, 't_pelanggan');
            $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
            redirect('c_pelanggan');
        }
    }


    public function update()
    {
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal Di Update " . validation_errors());
            redirect('c_pelanggan');
        } else {
            $id = $this->input->post('id_pelanggan');
            $nama_pelanggan = $this->input->post('nama_pelanggan');
            $alamat = $this->input->post('alamat');
            $no_hp = $this->input->post('no_hp');

            $data = array(
                'nama_pelanggan' => $nama_pelanggan,
                'alamat' => $alamat,
                'no_hp' => $no_hp,
            );

            $where = array(
                'id_pelanggan' => $id,
            );

            $this->m_pelanggan->update_data($where, $data, 't_pelanggan');
            $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
            redirect('c_pelanggan');
        }
    }

    public function hapus($id)
    {
        if ($id == "") {
            $this->session->set_flashdata('error', "Data Anda Gagal Di Hapus");
            redirect('Modal');
            redirect('c_pelanggan');
        } else {
            if ($this->m_barang->cek_barang($id)) {
                $this->m_pelanggan->hapus_data($id, 't_pelanggan');
                $this->session->set_flashdata('sukses', "Data Berhasil Dihapus");
                redirect('c_pelanggan');
            } else {
                $this->session->set_flashdata('error', "Data Gagal Dihapus");
                redirect('c_pelanggan');
            }

        }
    }



}