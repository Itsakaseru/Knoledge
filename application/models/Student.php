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
			$query = $this->db->query("SELECT * FROM student_scores WHERE studentID = 13");
			return $query->result_array();
        }

        public function getAverageScore()
        {
            $query = $this->db->query("SELECT TRUNCATE((SUM(assignment)+SUM(midterm)+SUM(finalterm))
                                       / 
                                       (COUNT(assignment)+COUNT(midterm)+COUNT(finalterm)), 1) AS averageScore 
                                       FROM student_scores 
                                       WHERE studentID = 13 AND
                                       assignment != 0 AND
                                       midterm != 0 AND
                                       finalterm != 0");
            $result = $query->result_array();
            return $result[0]['averageScore'];
        }

	}

?>