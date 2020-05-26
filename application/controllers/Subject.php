<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin');
    }

    public function index()
    {
        redirect(base_url() . "dashboard");
    }

    public function assign($subjectID, $teacherID)
    {
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
            redirect(base_url() . "dashboard?v=subjects");
        } else {
            redirect(base_url() . "dashboard?v=subjects");
        }
    }

}
?>
