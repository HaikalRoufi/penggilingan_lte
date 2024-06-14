<?php
class M_jenis_padi extends CI_Model
{
    public function getAll()
    {
        return $this->db->get('t_jenis')->result();
    }
    public function get_jenis_count() {
        return $this->db->count_all('t_jenis');
    }

    public function add_jenis($data, $table)
    {
        $this->db->insert($table, $data);

    }

    public function update_jenis($where,$table)
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
        $this->db->from('t_jenis');
        $this->db->join('t_barang','t_jenis.id_jenis = t_barang.id_jenis');
        $this->db->where('t_jenis.id_jenis', $id);
        if($this->db->get()->num_rows() > 0){
            return 0;
        }else{
            $this->db->where('t_jenis.id_jenis', $id);
            $this->db->delete($table);
            return 1;
        }
    }

}