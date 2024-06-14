<?php

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_session();
    }

    public function index()
    {
        $data['jenis_count'] = $this->m_jenis_padi->get_jenis_count();
        $data['pelanggan_count'] = $this->m_pelanggan->get_penggilingan_count();
        $data['barang_count'] = $this->m_barang->get_barang_count();
        $data['pembayaran_count'] = $this->m_pembayaran->get_pembayaran_count();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }
}