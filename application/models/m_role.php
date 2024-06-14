<?php
class M_role extends CI_Model
{
    public function getAll()
    {
        return $this->db->get('t_role')->result();
    }
}