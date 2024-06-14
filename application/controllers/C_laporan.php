<?php

class C_laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_session();
        if ($this->session->userdata('akses') != 'superadmin' && $this->session->userdata('akses') != 'pemilik') {
            redirect('dashboard', 'refresh');
        }
    }

    public function laporan_pelanggan()
    {
        $data['nama_pelanggan'] = $this->m_pelanggan->getAll();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/pelanggan', $data);
        $this->load->view('templates/footer');
    }

    public function laporan_barang()
    {
        $data['nama_barang'] = $this->m_barang->getAllandNamaPelanggan();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/barang', $data);
        $this->load->view('templates/footer');
    }


    public function laporan_proses()
    {
        $data['proses'] = $this->m_proses->getAllandNamaPelangganandJenisPadi();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/proses', $data);
        $this->load->view('templates/footer');
    }

    public function laporan_pembayaran()
    {
        $data['pelanggan'] = $this->m_pembayaran->getAllandNamaPelanggan();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/pembayaran', $data);
        $this->load->view('templates/footer');
    }

}