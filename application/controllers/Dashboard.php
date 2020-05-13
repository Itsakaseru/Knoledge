<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

        public function __construct()
	{
	parent::__construct();
                $this->load->model('student');
        }

	public function index()
	{
                // Import CSS, JS, Fonts
                $data['main'] = $this->load->view('include/main', NULL, TRUE);
                $data['navbar'] = $this->load->view('include/navbar', NULL, TRUE);
                $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

                $data['studentScores'] = $this->student->getData();
                $data['averageScore'] = $this->student->getAverageScore();
                
                $this->load->view('page/dashboard-siswa',$data);
	}
}
