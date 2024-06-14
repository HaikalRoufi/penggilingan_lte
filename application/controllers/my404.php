<?php
class my404 Extends CI_Controller {

    public function index()
    {
        $this->output->set_status_header('404'); 
        $this->load->view('my404');
    }
}