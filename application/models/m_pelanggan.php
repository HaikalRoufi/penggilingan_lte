<?php
class M_pelanggan extends CI_Model
{
    public function getAll()
    {
        return $this->db->get('t_pelanggan')->result();
    }

    public function get_penggilingan_count() {
        return $this->db->count_all('t_pelanggan');
    }

    public function add_pelanggan($data, $table)
    {
        $this->db->insert($table, $data);

    }

    public function update_pelanggan($where,$table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where,$data,$table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    public function hapus_data($id,$table)
    {
        $this->db->where('id_pelanggan', $id);
		$this->db->delete($table);
    }

    public function CreateCode(){
        $this->db->select('RIGHT(t_pelanggan.kode_pelanggan,5) as kode_pelanggan', FALSE);
        $this->db->order_by('kode_pelanggan','DESC');    
        $this->db->limit(1);    
        $query = $this->db->get('t_pelanggan');
            if($query->num_rows() <> 0){      
                 $data = $query->row();
                 $kode = intval($data->kode_pelanggan) + 1; 
            }
            else{      
                 $kode = 1;  
            }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
        $kodetampil = "PLG".$batas;
        return $kodetampil;  
    }

}