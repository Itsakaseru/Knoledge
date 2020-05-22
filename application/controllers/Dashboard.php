<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('quotes');
        $this->load->model('user');

        // if session doesn't exist, return to login page
        if(!isset($_SESSION['logged']) || $_SESSION['logged'] != 1)
        {
            echo "<script>window.location.href = \"" . base_url('login') . "\"</script>";
            exit();
        }

        // role query
        $query = $this->user->getRole($_SESSION['id']);
        foreach($query as $row) $roleid = $row['roleID'];
        unset($query);

        // If Admin load this
        if($roleid == 1)
        {
            // admin
        }
        // If Teacher load this
        else if($roleid == 2)
        {
            // teacher
        }
        // If Student load this
        else if($roleid == 3)
        {
            $this->load->model('student');
        }
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

    public function reqReview()
    {
        // Import CSS, JS, Fonts
        $data['main'] = $this->load->view('include/main', NULL, TRUE);
        $data['navbar'] = $this->load->view('include/navbar', NULL, TRUE);
        $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

        $this->load->view('page/reqReview',$data);
    }

}
?>
