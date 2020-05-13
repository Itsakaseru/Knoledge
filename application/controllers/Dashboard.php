<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
        // Import CSS, JS, Fonts
        $data['main'] = $this->load->view('include/main', NULL, TRUE);
        $data['navbar'] = $this->load->view('include/navbar', NULL, TRUE);
        $data['assets'] = $this->load->view('assets-import/dashboard-siswa', NULL, TRUE);
        
        $this->load->view('page/dashboard-siswa',$data);
	}
}
