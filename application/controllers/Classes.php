<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        redirect(base_url() . "dashboard");
    }

    public function assign($classID, $teacherID)
    {
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

}
?>
