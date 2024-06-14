<?php
class M_user extends CI_Model
{
    public function getAll()
    {
        return $this->db->get('t_user')->result();
    }
    public function getAllandUserRole()
    {
        $this->db->from('t_user');
        $this->db->join('t_role', 't_user.role_id = t_role.role_id', 'inner');
        return $this->db->get()->result();
    }

    public function add_user($data, $table)
    {
        $this->db->insert($table, $data);

    }

    public function update_user($where,$table)
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
        $this->db->where('id', $id);
		$this->db->delete($table);
    }

    public function check_unique_username($username)
    {
        $this->db->where_not_in('username', $username);
        return $this->db->get('t_user')->num_rows();
    }


}