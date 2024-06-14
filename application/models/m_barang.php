<?php
class M_barang extends CI_Model
{
    public function getAll()
    {
        return $this->db->get('t_barang')->result();
    }

    public function get_barang_count() {
        return $this->db->count_all('t_barang');
    }

    public function getAllandNamaPelanggan()
    {
        $this->db->from('t_barang');
        $this->db->join('t_jenis', 't_barang.id_jenis = t_jenis.id_jenis', 'inner');
        $this->db->join('t_pelanggan', 't_barang.id_pelanggan = t_pelanggan.id_pelanggan', 'inner');
        return $this->db->get()->result();
    }

    public function getOneandNamaPelanggan($kode)
    {
        $this->db->from('t_barang');
        $this->db->join('t_jenis', 't_barang.id_jenis = t_jenis.id_jenis', 'inner');
        $this->db->join('t_pelanggan', 't_barang.id_pelanggan = t_pelanggan.id_pelanggan', 'inner');
        $this->db->where('t_barang.kode_barang', $kode);
        return $this->db->get()->row();
    }

    public function getAllBarangandNamaPelanggan($id_pelanggan)
    {
        $this->db->from('t_barang');
        $this->db->join('t_jenis', 't_barang.id_jenis = t_jenis.id_jenis', 'inner');
        $this->db->join('t_pelanggan', 't_barang.id_pelanggan = t_pelanggan.id_pelanggan', 'inner');
        $this->db->join('t_proses', 't_barang.id_barang = t_proses.id_barang', 'inner');
        $this->db->where('t_pelanggan.id_pelanggan', $id_pelanggan);
        $this->db->where('t_barang.status', 3);
        return $this->db->get()->result();
    }

    public function cek_barang($id)
    {
        $this->db->from('t_barang');
        $this->db->join('t_pelanggan', 't_barang.id_pelanggan = t_pelanggan.id_pelanggan', 'inner');
        $this->db->where('t_pelanggan.id_pelanggan', $id);
        if ($this->db->get()->num_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function cari_barang($kode)
    {

        if ($this->db->get_where('t_barang', array('kode_barang' => $kode, 'status' => 0))->num_rows() > 0) {
            $this->db->from('t_barang');
            $this->db->join('t_pelanggan', 't_barang.id_pelanggan = t_pelanggan.id_pelanggan', 'inner');
            $this->db->join('t_jenis', 't_barang.id_jenis = t_jenis.id_jenis', 'inner');
            $this->db->where('kode_barang', $kode);
            return $this->db->get()->row();
        } else {
            return 0;
        }
    }

    public function cari_barang_bayar($kode, $id_pelanggan, $id_pelanggan_aktif)
    {
        if ($id_pelanggan == "0") {
            if ($this->db->get_where('t_barang', array('kode_barang' => $kode, 'status' => 2))->num_rows() > 0) {
                $this->db->from('t_barang');
                $this->db->join('t_pelanggan', 't_barang.id_pelanggan = t_pelanggan.id_pelanggan', 'inner');
                $this->db->join('t_jenis', 't_barang.id_jenis = t_jenis.id_jenis', 'inner');
                $this->db->join('t_proses', 't_proses.id_barang = t_barang.id_barang', 'inner');
                $this->db->where('t_barang.kode_barang', $kode);
            } else {
                return 0;
            }
        } else {
            if ($id_pelanggan_aktif == $id_pelanggan) {
                if ($this->db->get_where('t_barang', array('kode_barang' => $kode, 'status' => 2, 'id_pelanggan' => $id_pelanggan_aktif))->num_rows() > 0) {
                    $this->db->from('t_barang');
                    $this->db->join('t_pelanggan', 't_barang.id_pelanggan = t_pelanggan.id_pelanggan', 'inner');
                    $this->db->join('t_jenis', 't_barang.id_jenis = t_jenis.id_jenis', 'inner');
                    $this->db->join('t_proses', 't_proses.id_barang = t_barang.id_barang', 'inner');
                    $this->db->where('t_barang.kode_barang', $kode);
                } else {
                    return 0;
                }
            }
        }

        return $this->db->get()->row();



        // if ($this->db->get_where('t_barang', array('kode_barang' => $kode, 'status' => 2))->num_rows() > 0) {
        //     $this->db->where('kode_barang', $kode);
        //     $this->db->update('t_barang', array('status' => '3'));

        //     $this->db->from('t_barang');
        //     $this->db->join('t_pelanggan', 't_barang.id_pelanggan = t_pelanggan.id_pelanggan', 'inner');
        //     if ($id_pelanggan == "0") {
        //         $this->db->where('t_barang.kode_barang', $kode);
        //         $id_pelanggan_aktif = $id_pelanggan;
        //     } else {
        //         if ($id_pelanggan_aktif == $id_pelanggan) {
        //             $this->db->where('t_barang.kode_barang', $kode);
        //             $this->db->where('t_barang.id_pelanggan', $id_pelanggan);
        //         } else {
        //             return 0;
        //         }
        //     }

        //     return $this->db->get()->row();
    }


    public function add_barang($data, $table)
    {
        $this->db->insert($table, $data);

    }

    public function update_barang($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function update_status_batch($where, $data, $table)
    {
        // $this->db->where($where);
        // $this->db->update($table, $data);
        $this->db->update_batch($table, $data, $where); 
    }

    public function update_status($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function hapus_data($id, $table)
    {
        $cek = $this->db->get_where('t_barang', array('status' => 0, 'id_barang' => $id));
        if ($cek->num_rows() == 0) {
            return 0;
        } else {
            $this->db->where('id_barang', $id);
            $this->db->delete($table);
            return 1;
        }
    }

    public function CreateCode()
    {
        $this->db->select('RIGHT(t_barang.kode_barang,5) as kode_barang', FALSE);
        $this->db->order_by('kode_barang', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('t_barang');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_barang) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $kodetampil = "BRG" . $batas;
        return $kodetampil;
    }

}