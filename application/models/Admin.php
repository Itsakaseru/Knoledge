<?php 
defined('BASEPATH') OR exit('No direct script access allowed !');

class Admin extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getTotalData()
    {
        $this->db->select("SUM(users.roleID = 3) AS 'totalStudent',
                           SUM(users.roleID = 2) AS 'totalTeacher',
                           (SELECT COUNT(subjectID) FROM subjects) AS 'totalSubject'");
        $this->db->from('users');
        $query = $this->db->get();

        return $query->result_array()[0];
    }

    public function getStudentList()
    {
        $this->db->select('*');
        $this->db->from('user_info');
        $this->db->where('roleId', 3);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getTeacherList()
    {
        $this->db->select('*');
        $this->db->from('user_info');
        $this->db->where('roleId', 2);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getSubjectList()
    {
        $this->db->select('subjects.*, user_info.fullName');
        $this->db->from('subjects');
        $this->db->join('user_info', 'subjects.coordinatorID = user_info.userID');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getClassList()
    {
        $this->db->select('classes.*, user_info.fullName');
        $this->db->from('classes');
        $this->db->where('classId !=', 0);
        $this->db->join('user_info', 'classes.instructorID = user_info.userID');
        $query = $this->db->get();

        return $query->result_array();
    }
    
    public function getUserList()
    {
        $this->db->select('userID, fullName, dob, email, genderName, roleName');
        $this->db->from('user_info');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getAverageScore()
    {
        $this->db->select('TRUNCATE((SUM(assignment)+SUM(midterm)+SUM(finalterm))
                           / 
                           (COUNT(assignment)+COUNT(midterm)+COUNT(finalterm)), 1) AS averageScore');
        $this->db->from('student_currentscores');
        $this->db->where('assignment !=', 0);
        $this->db->where('midterm !=', 0);
        $this->db->where('finalterm !=', 0);
        $query = $this->db->get();
        $result = $query->result_array();

        return $result[0]['averageScore'];
    }

    public function getData($id)
    {
        $this->db->select('users.userID, users.firstName, users.lastName, users.dob, users.email, users.ppPath, users.roleID, genders.genderID, genders.genderName');
        $this->db->from('users');
        $this->db->where('userID', $id);
        $this->db->join('genders', 'users.genderID = genders.genderID');
        $query = $this->db->get();

        return $query->result_array()[0];
    }

    public function updateUserData($id, $data)
    {
        $this->db->where('userID', $id);
        $this->db->update('users', $data);
    }

}
?>