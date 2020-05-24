<?php 
defined('BASEPATH') OR exit('No direct script access allowed !');

class Student extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Debug for 50% Presentation Only
    public function getData()
    {
        $this->db->select('*');
        $this->db->from('student_scores');
        $this->db->where('studentID', 13);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function getAverageScore()
    {
        $this->db->select('TRUNCATE((SUM(assignment)+SUM(midterm)+SUM(finalterm))
                           / 
                           (COUNT(assignment)+COUNT(midterm)+COUNT(finalterm)), 1) AS averageScore');
        $this->db->from('student_scores');
        $this->db->where('studentID', 13);
        $this->db->where('assignment !=', 0);
        $this->db->where('midterm !=', 0);
        $this->db->where('finalterm !=', 0);
        $query = $this->db->get();

        $result = $query->result_array();
        return $result[0]['averageScore'];
    }

}
?>