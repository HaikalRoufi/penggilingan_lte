<?php
function cek_session()
{
  $CI =& get_instance();
  $session = $CI->session->userdata('status_login');
  if ($session != 'okemasuk') {
    # jika status_login tidak sesuai kriteria
    redirect('auth/cek_login','refresh');
  }
}


function cek_session_login()
{
  $CI =& get_instance();
  $session = $CI->session->userdata('status_login');
  if ($session =='okemasuk') {
    # jika status_login sesuai kriteria
    redirect('dashboard', 'refresh');
  }
}

/* End of file login_helper.php */
/* Location: ./application/helpers/login_helper.php */