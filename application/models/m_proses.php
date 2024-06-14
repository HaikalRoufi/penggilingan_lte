<?php
class M_proses extends CI_Model
{
    public function getAll()
    {
        return $this->db->get('t_proses');
    }

    public function getAllandNamaPelangganandJenisPadi(){
        $this->db->from('t_proses');
        $this->db->join('t_barang', 't_proses.id_barang = t_barang.id_barang', 'inner');
        $this->db->join('t_pelanggan', 't_proses.id_pelanggan = t_pelanggan.id_pelanggan', 'inner');
        $this->db->join('t_jenis', 't_barang.id_jenis = t_jenis.id_jenis', 'inner');
        return $this->db->get()->result();
    }
    public function add_proses($data, $table)
    {
        $this->db->insert($table, $data);

    }

    public function update_proses($where,$table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where,$data,$table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    // public function hapus_data($id,$table)
    // {
    //     $this->db->where('id_proses', $id);
	// 	$this->db->delete($table);
    // }

    public function CreateCode($tgl_proses){
        $this->db->select('MAX(RIGHT(kode_proses, 5)) AS kode', FALSE);
        $this->db->order_by('kode_proses','DESC');    
        $this->db->limit(1);    
        $this->db->where('DATE(tgl_proses)', $tgl_proses);
        $query = $this->db->get('t_proses');
            if($query->num_rows() <> 0){      
                 $data = $query->row();
                 $kode = intval($data->kode) + 1; 
            }
            else{      
                 $kode = 1;  
            }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
        $kodetampil = "PRS".date('ymd', strtotime($tgl_proses)).$batas;
        return $kodetampil;  
    }

}