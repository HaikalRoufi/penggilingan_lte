<?php

class C_pembayaran extends CI_Controller
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

        $data['pelanggan'] = $this->m_pembayaran->getAllandNamaPelanggan();
        $data['detail'] = $this->m_pembayaran->getDetailBarang();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('penggilingan/data_pembayaran', $data);
        $this->load->view('templates/footer');
    }

    public function cari()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $kode_barang = $this->input->post('kode_barang');
            $id_pelanggan = $this->input->post('id_pelanggan');
            $id_pelanggan_aktif = "";

            if ($id_pelanggan != "0") {
                $id_pelanggan_aktif = $id_pelanggan;
            }

            echo json_encode($this->m_barang->cari_barang_bayar($kode_barang, $id_pelanggan, $id_pelanggan_aktif));
        }
    }

    public function tambah_detail_barang()
    {
        $this->load->view('penggilingan/table_barang');
    }

    public function add_pembayaran()
    {
        $jumlah_barang = count($this->input->post('nama_jenis_hidden'));

        $total = str_replace(".", "", $this->input->post('total'));
        $bayar = str_replace(".", "", $this->input->post('bayar'));
        $kembali = str_replace(".", "", $this->input->post('kembali'));

        $data_pembayaran = [
            'kode_pembayaran' => $this->m_pembayaran->CreateCode(date('Y-m-d')),
            'id_pelanggan' => $this->input->post('id_pelanggan_bayar'),
            'total_all' => $total,
            'bayar' => $bayar,
            'kembali' => $kembali,
            'tgl_bayar' => date('Y-m-d H:i:s')
        ];

        if ($this->input->post('bayar') != '') {
            $id_pembayaran = $this->m_pembayaran->add_pembayaran($data_pembayaran, 't_pembayaran');

            $data_detail_barang = [];

            for ($i = 0; $i < $jumlah_barang; $i++) {
                // array_push($data_detail_barang, ['nama_jenis' => $this->input->post('nama_jenis_hidden')[$i]]);
                $data_detail_barang[$i]['id_pembayaran'] = $id_pembayaran;
                $data_detail_barang[$i]['id_barang'] = $this->input->post('id_barang_hidden')[$i];
                $data_detail_barang[$i]['berat_kotor'] = $this->input->post('berat_kotor_hidden')[$i];
                $data_detail_barang[$i]['berat_bersih'] = $this->input->post('berat_bersih_hidden')[$i];
                $data_detail_barang[$i]['harga'] = $this->input->post('harga_hidden')[$i];
                $data_detail_barang[$i]['total'] = $this->input->post('total_hidden')[$i];
            }

            $this->m_pembayaran->add_detail_pembayaran($data_detail_barang, 't_pembayaran_detail');

            $data_barang = [];

            for ($i = 0; $i < $jumlah_barang; $i++) {
                $data_barang[$i]['id_barang'] = $this->input->post('id_barang_hidden')[$i];
                $data_barang[$i]['status'] = 3;
            }

            $this->m_barang->update_status_batch('id_barang', $data_barang, 't_barang');

            $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
            redirect('c_pembayaran');
        } else {
            $this->session->set_flashdata('error', "Data Gagal Disimpan");
            redirect('c_pembayaran');
        }
    }

    public function Render_Print($kode)
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $this->data['title_pdf'] = 'Pembayaran ' . $kode;
        $this->data['isi'] = $this->m_pembayaran->getOneandNamaPelangganandJenisPadi($kode);
        foreach ($this->data['isi'] as $i) {
            $this->data['nama_pelanggan'] = $i->nama_pelanggan;
            $this->data['kode_pembayaran'] = $i->kode_pembayaran;
            $this->data['kode_pelanggan'] = $i->kode_pelanggan;
            $this->data['total_all'] = $i->total_all;
        }

        // filename dari pdf ketika didownload
        $file_pdf = 'Pembayaran ' . $kode;
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "landscape";

        $html = $this->load->view('print/pembayaran_print', $this->data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function viewtablebarang($id_pelanggan)
    {
        $data['barang'] = $this->m_barang->getAllBarangandNamaPelanggan($id_pelanggan);
        $this->load->view('penggilingan/table_barang', $data);
    }


}