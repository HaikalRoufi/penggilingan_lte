<?php

class C_barang extends CI_Controller
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
        $data['nama_barang'] = $this->m_barang->getAllandNamaPelanggan();
        $data['nama_jenis'] = $this->m_jenis_padi->getAll();
        $data['nama_pelanggan'] = $this->m_pelanggan->getAll();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('penggilingan/data_barang', $data);
        $this->load->view('templates/footer');
    }

    public function add_barang()
    {
        $this->form_validation->set_rules('jenis', 'Jenis', 'required');
        $this->form_validation->set_rules('pelanggan', 'Pelanggan', 'required');
        $this->form_validation->set_rules('berat_kotor', 'Berat Kotor', 'required');
        $this->form_validation->set_rules('tgl_diterima', 'Tanggal Diterima', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal Di Tambahkan " . validation_errors());
            redirect('c_barang');
        } else {
            $kode_barang = $this->m_barang->CreateCode();
            $jenis = $this->input->post('jenis');
            $pelanggan = $this->input->post('pelanggan');
            $berat_kotor = $this->input->post('berat_kotor');
            $tgl_diterima = $this->input->post('tgl_diterima');

            $data = array(
                'kode_barang' => $kode_barang,
                'id_jenis' => $jenis,
                'id_pelanggan' => $pelanggan,
                'berat_kotor' => $berat_kotor,
                'tgl_diterima' => date('Y-m-d H:i:s', strtotime($tgl_diterima)),
            );

            $this->m_barang->add_barang($data, 't_barang');
            $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
            redirect('c_barang');
        }
    }


    public function update()
    {
        $this->form_validation->set_rules('jenis', 'Jenis', 'required');
        $this->form_validation->set_rules('pelanggan', 'Pelanggan', 'required');
        $this->form_validation->set_rules('berat_kotor', 'Berat Kotor', 'required');
        $this->form_validation->set_rules('tgl_diterima', 'Tanggal Diterima', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Data Gagal Di Update " . validation_errors());
            redirect('c_barang');
        } else {
            $id = $this->input->post('id_barang');
            $jenis = $this->input->post('jenis');
            $pelanggan = $this->input->post('pelanggan');
            $berat_kotor = $this->input->post('berat_kotor');
            $tgl_diterima = $this->input->post('tgl_diterima');

            $data = array(
                'id_jenis' => $jenis,
                'id_pelanggan' => $pelanggan,
                'berat_kotor' => $berat_kotor,
                'tgl_diterima' => date('Y-m-d H:i:s', strtotime($tgl_diterima)),
            );

            $where = array(
                'id_barang' => $id
            );

            $this->m_barang->update_data($where, $data, 't_barang');
            $this->session->set_flashdata('sukses', "Data Berhasil Disimpan");
            redirect('c_barang');
        }
    }

    public function hapus($id)
    {
        if ($id == "") {
            $this->session->set_flashdata('error', "Data Anda Gagal Di Hapus");
            redirect('Modal');
            redirect('c_barang');
        } else {
            if ($this->m_barang->hapus_data($id, 't_barang') == 0) {
                $this->session->set_flashdata('error', "Data Gagal Dihapus");
                redirect('c_barang');
            } else {
                $this->session->set_flashdata('sukses', "Data Berhasil Dihapus");
                redirect('c_barang');
            }

        }
    }

    public function Barcode($kode)
    {
        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');
        //generate barcode
        Zend_Barcode::render('code128', 'image', array('text' => $kode), array());
    }

    public function Render_Print($kode)
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $this->data['title_pdf'] = 'Barang ' . $kode;
        $this->data['isi'] = $this->m_barang->getOneandNamaPelanggan($kode);

        // filename dari pdf ketika didownload
        $file_pdf = 'Barang ' . $kode;
        // setting paper
        $paper = 'A5';
        //orientasi paper potrait / landscape
        $orientation = "landscape";

        $html = $this->load->view('print/barang_print', $this->data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }




}