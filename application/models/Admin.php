<?php 
defined('BASEPATH') OR exit('No direct script access allowed !');

class Admin extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getTotalData() {
        $this->db->select("SUM(users.roleID = 3) AS 'totalStudent',
                           SUM(users.roleID = 2) AS 'totalTeacher',
                           (SELECT COUNT(subjectID) FROM subjects) AS 'totalSubject'");
        $this->db->from('users');
        $query = $this->db->get();

        return $query->result_array()[0];
    }

    public function getStudentList() {
        $this->db->select('*');
        $this->db->from('user_info');
        $this->db->where('roleId', 3);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getAverageScore()
    {
        $this->db->select('TRUNCATE((SUM(assignment)+SUM(midterm)+SUM(finalterm))
                           / 
                           (COUNT(assignment)+COUNT(midterm)+COUNT(finalterm)), 1) AS averageScore');
        $this->db->from('student_scores');
        $this->db->where('assignment !=', 0);
        $this->db->where('midterm !=', 0);
        $this->db->where('finalterm !=', 0);
        $query = $this->db->get();
        $result = $query->result_array();

        return $result[0]['averageScore'];
    }

}
?>