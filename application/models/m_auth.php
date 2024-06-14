<?php
class M_auth extends CI_Model
{
    function login($username, $password){
        $val = array(
            'username Like binary' => $username,
            'password Like binary' => md5($password)
        );

        # cek apakah data dari form ada/tidak di DB
        $cek = $this->db->get_where('t_user', $val);
        if ($cek->num_rows()>0) {
            # jika data ada
            return 1;
        } else {
            # jika data tidak ada
            return 0;
        }
    }

    function akses($username, $password){
        $val = array(
            'username' => $username,
            'password' => md5($password)
        );

        # cek apakah data dari form ada/tidak di DB
        $cek = $this->db->get_where('t_user', $val);
        if ($cek->num_rows() > 0) {
            # jika data ada
            $role_id = $cek->row()->role_id;
            $akses = $this->db->get_where('t_role', array('role_id' => $role_id))->row();
            return $akses->akses;
        }
    }

    function getDataLogin($username, $password){
        $val = array(
            'username' => $username,
            'password' => md5($password)
        );

        
        # cek apakah data dari form ada/tidak di DB
        $cek = $this->db->get_where('t_user', $val);
        if ($cek->num_rows() > 0) {
            $cek = $cek->row();
            return $cek;
        }else{
            return "";
        }
    }

}