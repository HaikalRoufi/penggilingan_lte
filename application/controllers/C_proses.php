<?php

class C_proses extends CI_Controller
{
    public function __construct()
    {
            parent::__construct();
            cek_session();
            if ($this->session->userdata('akses') != 'superadmin' && $this->session->userdata('akses') != 'petugas') {
                redirect('dashboard', 'refresh');
            }
    }

    public function index()
    {
        $data['proses'] = $this->m_proses->getAllandNamaPelangganandJenisPadi();
        $data['nama_jenis'] = $this->m_jenis_padi->getAll();
        $data['nama_pelanggan'] = $this->m_pelanggan->getAll();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('penggilingan/data_proses', $data);
        $this->load->view('templates/footer');
    }

    public function cari(){
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
         }else{
            $kode_barang = $this->input->post('kode_barang');
            echo json_encode($this->m_barang->cari_barang($kode_barang));
         }
    }

    public function add_proses()
    {
        $this->form_validation->set_rules('nama_jenis', 'Nama Jenis', 'required');
        $this->form_validation->set_rules('pelanggan', 'Pelanggan', 'required');
        $this->form_validation->set_rules('berat_kotor', 'Berat Kotor', 'required');
        $this->form_validation->set_rules('tgl_proses', 'Tanggal Proses', 'required');
        $this->form_validation->set_rules('id_barang', 'Id Barang', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal Di Tambahkan " . validation_errors());
            redirect('c_proses');
        } 
        else {
            $id_pelanggan = $this->input->post('id_pelanggan');
            $berat_kotor = $this->input->post('berat_kotor');
            $tgl_proses = $this->input->post('tgl_proses');
            $id_barang = $this->input->post('id_barang');
            $kode_proses = $this->m_proses->CreateCode(date('y-m-d', strtotime($tgl_proses)));

            $data = array(
                'id_barang' => $id_barang,
                'id_pelanggan' => $id_pelanggan,
                'berat_kotor' => $berat_kotor,
                'tgl_proses' => date('Y-m-d H:i:s', strtotime($tgl_proses)),
                'kode_proses' => $kode_proses
            );

            $data1 = array(
                'status' => 1,
            );

            $where = array(
                'id_barang' => $id_barang,
                'status' => 0,
            );

            $this->m_proses->add_proses($data, 't_proses');
            $this->m_barang->update_status($where, $data1, 't_barang');
            $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
            redirect('c_proses');
        }
    }   

    public function update()
    {
        $this->form_validation->set_rules('berat_bersih', 'Berat Bersih', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('tgl_selesai', 'Tanggal Selesai', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal Di Update " . validation_errors());
            redirect('c_proses');
        } else {
            $id = $this->input->post('id_proses');
            $berat_bersih = $this->input->post('berat_bersih');
            $tgl_selesai= $this->input->post('tgl_selesai');
            $id_barang = $this->input->post('id_barang');

            $data = array(
                'berat_bersih' => $berat_bersih,
                'tgl_selesai' => date('Y-m-d H:i:s', strtotime($tgl_selesai))
            );

            $where = array(
                'id_proses' => $id
            );

            $data1 = array(
                'status' => 2,
            );

            $where1 = array(
                'id_barang' => $id_barang,
                'status' => 1,
            );

            $this->m_proses->update_data($where, $data, 't_proses');
            $this->m_barang->update_status($where1, $data1, 't_barang');
            $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
            redirect('c_proses');
        }
    }

    // public function hapus($id)
    // {
    //     if ($id == "") {
    //         $this->session->set_flashdata('error',"Data Anda Gagal Di Hapus");
	// 		redirect('Modal');
    //         redirect('admin/c_proses');
    //     } else {
    //         $this->m_proses->hapus_data($id, 't_proses');
    //         $this->session->set_flashdata('sukses',"Data Berhasil Dihapus");
    //         redirect('admin/c_proses');
    //     }
    // }




}