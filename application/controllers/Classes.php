<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!isset($_SESSION['logged']) || $_SESSION['logged'] != 1) redirect(base_url("login"));
        
        $this->load->model('admin');
    }

    public function index()
    {
        redirect(base_url() . "dashboard");
    }

    public function assign($classID, $teacherID) // admin only
    {
        if(isset($_SESSION['roleID']) && $_SESSION['roleID'] == 1) {
            // Check to make sure that 1 teacher = 1 subject coordinator
            $this->db->select('COUNT(*) AS num');
            $this->db->from('classes');
            $this->db->where('instructorID', $teacherID);
            $query = $this->db->get();

            $result = $query->result_array();
            if($result[0]['num'] == "0") {
                $this->db->set('instructorID', $teacherID, FALSE);
                $this->db->where('classID', $classID);
                $this->db->update('classes');
                $this->session->set_flashdata('success', 'New instructor set!');
                redirect(base_url() . "dashboard?v=classes");
            } else {
                $this->session->set_flashdata('error', 'Teacher is already a instructor!');
                redirect(base_url() . "dashboard?v=classes");
            }
        }
        else {
            $data['main'] = $this->load->view('include/main', NULL, TRUE);
            $data['navbar'] = $this->load->view('include/navbar', NULL, TRUE);
            $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

            $this->load->view('errors/html/error_permission.php', $data);
        }
    }

    public function view($classID) // admin only
    {
        // Import CSS, JS, Fonts
        $data['main'] = $this->load->view('include/main', NULL, TRUE);
        $data['navbar'] = $this->load->view('include/navbar', NULL, TRUE);
        $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

        if(isset($_SESSION['roleID']) && $_SESSION['roleID'] == 1) {
            $module['subjectList'] = $this->admin->getClassInfo($classID);
            $module['teacherList'] = $this->admin->getTeacherList();
            $module['classID'] = $classID;
            $data['module'] = $this->load->view('admin-module/action/viewClass', $module, TRUE);

            $this->load->view('page/dashboard-admin',$data);
        }
        else $this->load->view('errors/html/error_permission.php', $data);
    }

}
?>
