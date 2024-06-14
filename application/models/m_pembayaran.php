<?php
class M_pembayaran extends CI_Model
{
    public function getAllandNamaPelanggan()
    {
        $this->db->from('t_pembayaran');
        $this->db->join('t_pelanggan', 't_pembayaran.id_pelanggan = t_pelanggan.id_pelanggan', 'inner');
        return $this->db->get()->result();
    }
    public function get_pembayaran_count() {
        return $this->db->count_all('t_pembayaran');
    }

    public function getDetailBarang()
    {
        $this->db->from('t_pembayaran_detail');
        $this->db->join('t_barang', 't_pembayaran_detail.id_barang = t_barang.id_barang', 'inner');
        $this->db->join('t_jenis', 't_barang.id_jenis = t_jenis.id_jenis', 'inner');
        return $this->db->get()->result();
    }

    public function getAllandNamaPelangganandJenisPadi()
    {
        $this->db->from('t_pembayaran');
        $this->db->join('t_pembayaran_detail', 't_pembayaran.id_pembayaran = t_pembayaran_detail.id_pembayaran', 'inner');
        $this->db->join('t_barang', 't_pembayaran_detail.id_barang = t_barang.id_barang', 'inner');
        $this->db->join('t_pelanggan', 't_pembayaran.id_pelanggan = t_pelanggan.id_pelanggan', 'inner');
        $this->db->join('t_jenis', 't_barang.id_jenis = t_jenis.id_jenis', 'inner');
        return $this->db->get()->result();
    }

    public function getOneandNamaPelangganandJenisPadi($kode)
    {
        $this->db->from('t_pembayaran');
        $this->db->join('t_pembayaran_detail', 't_pembayaran.id_pembayaran = t_pembayaran_detail.id_pembayaran', 'inner');
        $this->db->join('t_barang', 't_pembayaran_detail.id_barang = t_barang.id_barang', 'inner');
        $this->db->join('t_pelanggan', 't_pembayaran.id_pelanggan = t_pelanggan.id_pelanggan', 'inner');
        $this->db->join('t_jenis', 't_barang.id_jenis = t_jenis.id_jenis', 'inner');
        $this->db->where('t_pembayaran.kode_pembayaran', $kode);
        return $this->db->get()->result();
    }

    public function add_pembayaran($data, $table)
    {
        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;

    }

    public function add_detail_pembayaran($data, $table)
    {
        $this->db->insert_batch($table, $data);
    }

    public function update_pembayaran($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function hapus_data($id, $table)
    {
        $this->db->where('id_pembayaran', $id);
        $this->db->delete($table);
    }

    public function CreateCode($tgl_bayar){
        $this->db->select('MAX(RIGHT(kode_pembayaran, 5)) AS kode', FALSE);
        $this->db->order_by('kode_pembayaran','DESC');    
        $this->db->limit(1);    
        $this->db->where('DATE(tgl_bayar)', $tgl_bayar);
        $query = $this->db->get('t_pembayaran');
            if($query->num_rows() <> 0){      
                 $data = $query->row();
                 $kode = intval($data->kode) + 1; 
            }
            else{      
                 $kode = 1;  
            }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
        $kodetampil = "INV".date('ymd').$batas;
        return $kodetampil;  
    }

}