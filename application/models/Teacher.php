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
    
    public function getTeacherProfile($id)
    {
        $this->db->select('teacher.teacherName, teacher.teacherGender, teacher.teacherAge');
        $this->db->from('teacher');
        $this->db->where('teacherID', $id);
        $query = $this->db->get();

        return $query->result_array()[0];
    }

    public function isHomeroomTeacher($id)
    {
        $this->db->select('instructorID, className');
        $this->db->from('classes');
        $this->db->where('instructorID', $id);
        $query = $this->db->get();

        if($query->num_rows() == 0) {
            return false;
        } else {
            return $query->result_array()[0];
        }
    }

    public function getAverageScoreClass($className)
    {
        $this->db->select('TRUNCATE((SUM(assignment)+SUM(midterm)+SUM(finalterm))
                           / 
                           (COUNT(assignment)+COUNT(midterm)+COUNT(finalterm)), 1) AS averageScore');
        $this->db->from('student_currentscores');
        $this->db->where('className', $className);
        $this->db->where('assignment !=', 0);
        $this->db->where('midterm !=', 0);
        $this->db->where('finalterm !=', 0);
        $query = $this->db->get();
        $result = $query->result_array();

        return $result[0]['averageScore'];;

    }

    public function getTeachingSubject($id)
    {
        $this->db->select('classes.className, subjects.subjectID, subjects.subjectName');
        $this->db->from('teachers');
        $this->db->join('subjects', 'subjects.subjectID = teachers.subjectID');
        $this->db->join('classes', 'classes.classID = teachers.classID');
        $this->db->where('teacherID', $id);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function getStudentScoreHomeroom($id, $className)
    {
        $this->db->select('user_info.fullName, assignments.classID, classes.className, assignments.subjectID, subjects.subjectName, assignments.assignmentScore, assignments.midtermScore, assignments.finaltermScore');
        $this->db->from('assignments');
        $this->db->join('user_info', 'user_info.userID = assignments.studentID');
        $this->db->join('classes', 'classes.classID = assignments.classID');
        $this->db->join('subjects', 'subjects.subjectID = assignments.subjectID');
        $this->db->where('classes.className', $className);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getStudentScoreSubjects($id)
    {
        // Get subjects info
        $subjects = $this->getTeachingSubject($id);

        $this->db->select('user_info.fullName, assignments.classID, classes.className, assignments.subjectID, subjects.subjectName, assignments.assignmentScore, assignments.midtermScore, assignments.finaltermScore');
        $this->db->from('assignments');
        $this->db->join('user_info', 'user_info.userID = assignments.studentID');
        $this->db->join('classes', 'classes.classID = assignments.classID');
        $this->db->join('subjects', 'subjects.subjectID = assignments.subjectID');
        
        foreach($subjects as $subject)
        {
            $this->db->or_where('classes.className', $subject['className']);
            $this->db->where('assignments.subjectID', $subject['subjectID']);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getSubjectList()
    {
        $this->db->select('subjectID, subjectName');
        $this->db->from('subjects');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getStudentScorebySubject($id, $subjectName)
    {
        // Get subjects score by subjectName
        $subjects = $this->getTeachingSubject($id);

        $this->db->select('user_info.fullName, assignments.classID, classes.className, assignments.subjectID, subjects.subjectName, assignments.assignmentScore, assignments.midtermScore, assignments.finaltermScore');
        $this->db->from('assignments');
        $this->db->join('user_info', 'user_info.userID = assignments.studentID');
        $this->db->join('classes', 'classes.classID = assignments.classID');
        $this->db->join('subjects', 'subjects.subjectID = assignments.subjectID');
        
        foreach($subjects as $subject)
        {
            $this->db->or_where('classes.className', $subject['className']);
            $this->db->where('assignments.subjectID', $subject['subjectID']);
            $this->db->where('subjects.subjectName', "$subjectName");
        }

        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getStudentScorebySubjectInHomeroom($id, $subjectName, $className)
    {
        $this->db->select('user_info.fullName, assignments.classID, classes.className, assignments.subjectID, subjects.subjectName, assignments.assignmentScore, assignments.midtermScore, assignments.finaltermScore');
        $this->db->from('assignments');
        $this->db->join('user_info', 'user_info.userID = assignments.studentID');
        $this->db->join('classes', 'classes.classID = assignments.classID');
        $this->db->join('subjects', 'subjects.subjectID = assignments.subjectID');
        $this->db->where('classes.className', $className);
        $this->db->where('subjects.subjectName', $subjectName);

        $query = $this->db->get();
        return $query->result_array();
        
    }

    public function reqEditProfile($id, $data)
    {
        if($this->db->insert('reqeditprofile', $data)) return true; else false;
    }
}

?>