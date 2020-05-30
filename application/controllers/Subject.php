<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends CI_Controller {

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

    public function assign($subjectID, $teacherID) // admin only
    {
        if(isset($_SESSION['roleID']) && $_SESSION['roleID'] == 1) {
            // Check to make sure that 1 teacher = 1 subject coordinator
            $this->db->select('COUNT(*) AS num');
            $this->db->from('subjects');
            $this->db->where('coordinatorID', $teacherID);
            $query = $this->db->get();

            $result = $query->result_array();
            if($result[0]['num'] == "0") {
                $this->db->set('coordinatorID', $teacherID, FALSE);
                $this->db->where('subjectID', $subjectID);
                $this->db->update('subjects');
                $this->session->set_flashdata('success', 'New coordinator set!');
                redirect(base_url() . "dashboard?v=subjects");
            } else {
                $this->session->set_flashdata('error', 'Teacher is already a coordinator!');
                redirect(base_url() . "dashboard?v=subjects");
            }
        }
        else {
            $data['main'] = $this->load->view('include/main', NULL, TRUE);
            $data['navbar'] = $this->load->view('include/navbar', NULL, TRUE);
            $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

            $this->load->view('errors/html/error_permission.php', $data);
        }
    }

    public function teacherAssign($classID, $subjectID, $teacherID) // admin only
    {
        if(isset($_SESSION['roleID']) && $_SESSION['roleID'] == 1) {
            $this->db->set('teacherID', $teacherID, FALSE);
            $this->db->where('subjectID', $subjectID);
            $this->db->where('classID', $classID);
            $this->db->update('teachers');
            $this->session->set_flashdata('success', 'Teacher subject class assignment set!');
            redirect(base_url() . "class/" . $classID . "/view");
        }
        else {
            $data['main'] = $this->load->view('include/main', NULL, TRUE);
            $data['navbar'] = $this->load->view('include/navbar', NULL, TRUE);
            $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

            $this->load->view('errors/html/error_permission.php', $data);
        }
    }

    public function subjectAssign($classID, $subjectID, $teacherID) // admin only
    {
        if(isset($_SESSION['roleID']) && $_SESSION['roleID'] == 1) {
            $this->db->set('teacherID', $teacherID, FALSE);
            $this->db->where('subjectID', $subjectID);
            $this->db->where('classID', $classID);
            $this->db->update('teachers');
            $this->session->set_flashdata('success', 'Teacher subject class assignment set!');
            redirect(base_url() . "subject/" . $subjectID . "/view");
        }
        else {
            $data['main'] = $this->load->view('include/main', NULL, TRUE);
            $data['navbar'] = $this->load->view('include/navbar', NULL, TRUE);
            $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

            $this->load->view('errors/html/error_permission.php', $data);
        }
    }

    public function view($subjectID) // admin only
    {
        // Import CSS, JS, Fonts
        $data['main'] = $this->load->view('include/main', NULL, TRUE);
        $data['navbar'] = $this->load->view('include/navbar', NULL, TRUE);
        $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

        if(isset($_SESSION['roleID']) && $_SESSION['roleID'] == 1) {
            $module['classList'] = $this->admin->getSubjectInfo($subjectID);
            $module['teacherList'] = $this->admin->getTeacherList();
            $module['subjectID'] = $subjectID;
            $data['module'] = $this->load->view('admin-module/action/viewSubject', $module, TRUE);

            $this->load->view('page/dashboard-admin',$data);
        }
        else $this->load->view('errors/html/error_permission.php', $data);
    }

}
?>
