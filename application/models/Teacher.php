<?php
defined('BASEPATH') OR exit('No direct script access allowed !');

class Teacher extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function updateUserData($id, $data)
    {
        if($this->db->insert('notifications', array('description' => 'Request for Edit Profile', 'notificationType' => 1, 'jsonMsg' => $data, 'readStatus' => 0))) return true; else false;
    }

    public function getTeacherInfo($id){
        $this->db->select('users.userID, users.firstName, users.lastName, users.dob, users.email, users.ppPath, users.roleID, genders.genderID, genders.genderName');
        $this->db->from('users');
        $this->db->where('userID', $id);
        $this->db->join('genders', 'users.genderID = genders.genderID');
        $query = $this->db->get();

        return $query->result_array()[0];
    }
    
    public function getTeacherProfile($id){
        $this->db->select('teacher.teacherName, teacher.teacherGender, teacher.teacherAge');
        $this->db->from('teacher');
        $this->db->where('teacherID', $id);
        $query = $this->db->get();

        return $query->result_array()[0];
    }

    public function updateTeacherProfile($id){
        $this->db->query('SELECT * FROM teacher UPDATE teacherName, teacherGender, teacherAge WHERE teacherID');
        $query = $this->db->get();
    }

    public function updateStudentScore($id){
        $this->db->query('SELECT * FROM student UPDATE student_allscores WHERE studentID');
        $query = $this->db->get();
    }
}

?>