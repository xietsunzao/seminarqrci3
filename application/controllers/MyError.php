<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MyError extends CI_Controller
{
    public function index()
    {
        $this->load->view('errors/html/myerror_v');
    }
}
