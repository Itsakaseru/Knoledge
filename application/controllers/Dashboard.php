<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('quotes');

        // if session doesn't exist, return to login page
        if(!isset($_SESSION['logged']) || $_SESSION['logged'] != 1)
        {
            echo "<script>window.location.href = \"" . base_url('login') . "\"</script>";
            exit();
        }

        // If Student load this
        $this->load->model('student');

        // If Teacher load this
        //

        // If Admin load this
        //
    }

    public function index()
    {
        // Import CSS, JS, Fonts
        $data['main'] = $this->load->view('include/main', NULL, TRUE);
        $data['navbar'] = $this->load->view('include/navbar', NULL, TRUE);
        $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

        $data['qotd'] = $this->quotes->getQuote();

        $data['studentScores'] = $this->student->getData();
        $data['averageScore'] = $this->student->getAverageScore();

        $this->load->view('page/dashboard-student',$data);
    }

}
?>
