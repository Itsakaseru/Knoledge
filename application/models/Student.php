<?php 
defined('BASEPATH') OR exit('No direct script access allowed !');

class Student extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function reqEditProfile($id, $data)
    {
        if($this->db->insert('reqeditprofile', $data)) return true; else false;
    }

    public function reqReview($id, $data)
    {
        if($this->db->insert('reqreview', $data)) return true; else false;
    }

    public function getStudentInfo($id)
    {
        $this->db->select('users.userID, users.firstName, users.lastName, users.dob, users.email, users.ppPath, users.roleID, genders.genderID, genders.genderName');
        $this->db->from('users');
        $this->db->where('userID', $id);
        $this->db->join('genders', 'users.genderID = genders.genderID');
        $query = $this->db->get();

        return $query->result_array()[0];
    }

    public function getStudentClass($id)
    {
        $this->db->select('*');
        $this->db->from('student_class');
        $this->db->where('studentID', $id);
        $query = $this->db->get();

        return $query->result_array()[0];
    }

    public function getCurrentClass($id)
    {
        $this->db->select('classID, className');
        $this->db->from('student_class');
        $this->db->where('studentID', $id);
        $query = $this->db->get();

        return $query->result_array()[0];
    }

    public function getCurrentScores($id)
    {
        $this->db->select('*');
        $this->db->from('student_currentscores');
        $this->db->where('studentID', $id);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function getAllScores($id)
    {
        $this->db->select('*');
        $this->db->from('student_allscores');
        $this->db->where('studentID', $id);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function getClass1Scores($id)
    {
        $this->db->select('*');
        $this->db->from('student_allscores');
        $this->db->where('studentID', $id);
        $this->db->like('className', 1);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function getClass2Scores($id)
    {
        $this->db->select('*');
        $this->db->from('student_allscores');
        $this->db->where('studentID', $id);
        $this->db->like('className', 2);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function getClass3Scores($id)
    {
        $this->db->select('*');
        $this->db->from('student_allscores');
        $this->db->where('studentID', $id);
        $this->db->like('className', 3);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function getCurrentAverage($id)
    {
        $this->db->select('TRUNCATE((SUM(assignment)+SUM(midterm)+SUM(finalterm))
                           / 
                           (COUNT(assignment)+COUNT(midterm)+COUNT(finalterm)), 1) AS averageScore');
        $this->db->from('student_currentscores');
        $this->db->where('studentID', $id);
        $this->db->where('assignment !=', 0);
        $this->db->where('midterm !=', 0);
        $this->db->where('finalterm !=', 0);
        $query = $this->db->get();

        $result = $query->result_array();
        return $result[0]['averageScore'];
    }

    public function getAllAverage($id)
    {
        $this->db->select('TRUNCATE((SUM(assignment)+SUM(midterm)+SUM(finalterm))
                           / 
                           (COUNT(assignment)+COUNT(midterm)+COUNT(finalterm)), 1) AS averageScore');
        $this->db->from('student_allscores');
        $this->db->where('studentID', $id);
        $this->db->where('assignment !=', 0);
        $this->db->where('midterm !=', 0);
        $this->db->where('finalterm !=', 0);
        $query = $this->db->get();

        $result = $query->result_array();
        return $result[0]['averageScore'];
    }

    public function getClass1Average($id)
    {
        $this->db->select('TRUNCATE((SUM(assignment)+SUM(midterm)+SUM(finalterm))
                           / 
                           (COUNT(assignment)+COUNT(midterm)+COUNT(finalterm)), 1) AS averageScore');
        $this->db->from('student_allscores');
        $this->db->where('studentID', $id);
        $this->db->like('className', 1);
        $this->db->where('assignment !=', 0);
        $this->db->where('midterm !=', 0);
        $this->db->where('finalterm !=', 0);
        $query = $this->db->get();

        $result = $query->result_array();
        return $result[0]['averageScore'];
    }

    public function getClass2Average($id)
    {
        $this->db->select('TRUNCATE((SUM(assignment)+SUM(midterm)+SUM(finalterm))
                           / 
                           (COUNT(assignment)+COUNT(midterm)+COUNT(finalterm)), 1) AS averageScore');
        $this->db->from('student_currentscores');
        $this->db->where('studentID', $id);
        $this->db->like('className', 2);
        $this->db->where('assignment !=', 0);
        $this->db->where('midterm !=', 0);
        $this->db->where('finalterm !=', 0);
        $query = $this->db->get();

        $result = $query->result_array();
        return $result[0]['averageScore'];
    }

    public function getClass3Average($id)
    {
        $this->db->select('TRUNCATE((SUM(assignment)+SUM(midterm)+SUM(finalterm))
                           / 
                           (COUNT(assignment)+COUNT(midterm)+COUNT(finalterm)), 1) AS averageScore');
        $this->db->from('student_currentscores');
        $this->db->where('studentID', $id);
        $this->db->like('className', 3);
        $this->db->where('assignment !=', 0);
        $this->db->where('midterm !=', 0);
        $this->db->where('finalterm !=', 0);
        $query = $this->db->get();

        $result = $query->result_array();
        return $result[0]['averageScore'];
    }

    public function getCurrentSubject($id)
    {
        $query = $this->db->query("SELECT studentID, student_currentscores.fullName, student_currentscores.classID, student_currentscores.className, student_currentscores.subjectID, teacher_subjects.subjectName, teacherID, teacher_subjects.fullName AS teacherName FROM student_currentscores JOIN teacher_subjects ON student_currentscores.subjectID=teacher_subjects.subjectID AND student_currentscores.classID=teacher_subjects.classID WHERE studentID = $id"); 
        return $query->result_array();
    }

    public function getAllSubject($id)
    {
        $query = $this->db->query("SELECT studentID, student_allscores.fullName, student_allscores.classID, student_allscores.className, student_allscores.subjectID, teacher_subjects.subjectName, teacherID, teacher_subjects.fullName AS teacherName FROM student_allscores JOIN teacher_subjects ON student_allscores.subjectID=teacher_subjects.subjectID AND student_allscores.classID=teacher_subjects.classID WHERE studentID = $id"); 
        return $query->result_array();
    }

    public function getClass1Subject($id)
    {
        $query = $this->db->query("SELECT studentID, student_allscores.fullName, student_allscores.classID, student_allscores.className, student_allscores.subjectID, teacher_subjects.subjectName, teacherID, teacher_subjects.fullName AS teacherName FROM student_allscores JOIN teacher_subjects ON student_allscores.subjectID=teacher_subjects.subjectID AND student_allscores.classID=teacher_subjects.classID WHERE studentID = $id AND student_allscores.className LIKE '%1%' ESCAPE '!'"); 
        return $query->result_array();
    }

    public function getClass2Subject($id)
    {
        $query = $this->db->query("SELECT studentID, student_allscores.fullName, student_allscores.classID, student_allscores.className, student_allscores.subjectID, teacher_subjects.subjectName, teacherID, teacher_subjects.fullName AS teacherName FROM student_allscores JOIN teacher_subjects ON student_allscores.subjectID=teacher_subjects.subjectID AND student_allscores.classID=teacher_subjects.classID WHERE studentID = $id AND student_allscores.className LIKE '%2%' ESCAPE '!'"); 
        return $query->result_array();
    }

    public function getClass3Subject($id)
    {
        $query = $this->db->query("SELECT studentID, student_allscores.fullName, student_allscores.classID, student_allscores.className, student_allscores.subjectID, teacher_subjects.subjectName, teacherID, teacher_subjects.fullName AS teacherName FROM student_allscores JOIN teacher_subjects ON student_allscores.subjectID=teacher_subjects.subjectID AND student_allscores.classID=teacher_subjects.classID WHERE studentID = $id AND student_allscores.className LIKE '%3%' ESCAPE '!'"); 
        return $query->result_array();
    }

    public function getSubjectInfo($id, $subjectID)
    {
        $query = $this->db->query("SELECT studentID, student_allscores.fullName, student_allscores.classID, student_allscores.className, student_allscores.subjectID, teacher_subjects.subjectName, teacherID, teacher_subjects.fullName AS teacherName FROM student_allscores JOIN teacher_subjects ON student_allscores.subjectID=teacher_subjects.subjectID AND student_allscores.classID=teacher_subjects.classID WHERE studentID = $id AND teacher_subjects.subjectID = $subjectID"); 
        return $query->result_array()[0];
    }
    
}
?>