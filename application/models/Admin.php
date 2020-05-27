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
        if($this->db->update('users', $data)) return true; else false;
    }

    public function addUserData($id, $data)
    {
        if($this->db->insert('users', $data)) return true; else false;
    }

    public function deleteUserData($id, $role)
    {
        if($role == "3") {
            $this->db->where('studentID', $id);
            $this->db->delete('assignments');
        }
        if($role == "2") {
            // Check for teacher status as coordinator and instructor
            $this->db->select('*');
            $this->db->from('subjects');
            $this->db->where('coordinatorID', $id);
            $subject = $this->db->get();

            $this->db->select('*');
            $this->db->from('classes');
            $this->db->where('instructorID', $id);
            $classes = $this->db->get();

            $this->db->select('*');
            $this->db->from('teachers');
            $this->db->where('teacherID', $id);
            $teacher = $this->db->get();

            if($subject->num_rows() == 0 && $classes->num_rows() == 0 && $teacher->num_rows() == 0) {
                $this->db->where('userID', $id);
                $this->db->delete('users');
                return true;
            } else { return false; }
        } else {
            $this->db->where('userID', $id);
            $this->db->delete('users');
            return true;
        }
    }

    public function getCurrentClass($id)
    {
        $this->db->select('classID, className');
        $this->db->from('student_class');
        $this->db->where('studentID', $id);
        $query = $this->db->get();

        return $query->result_array()[0];
    }

    public function getHomeroomClass($id)
    {
        $this->db->select('classID, className');
        $this->db->from('classes');
        $this->db->where('instructorID', $id);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getNextClass($id, $currentClass)
    {
        $classID = $currentClass['classID'];
        $classNumber = substr($currentClass['className'], 0, 1);
        $this->db->select('classID, className');
        $this->db->from('classes');
        $this->db->where('LEFT(className, 1) !=', $classNumber);
        $this->db->where('classID >', $classID);
        $query = $this->db->get();

        return $query->result_array();
    }
    
    public function assignClass($id, $currentClass, $toClass)
    {
        // Assign class
        // Show N/A if class is unset
        // If class not assigned // show popup, so admin know to assign it first.
        // Admin can only UPGRADE CLASS
        // If class is not assigned, then update the unassigned value in assigmnets table
        // if class is assigned, add new data in assignments table for all of the subject

        $this->db->select('subjectID');
        $this->db->from('subjects');
        $query = $this->db->get();

        $subjects = $query->result_array();

        if($currentClass == "0") {
            foreach($subjects as $subject) {
                $data = array(
                    'studentID' => $id,
                    'classID' => $toClass,
                    'subjectID' => $subject['subjectID'],
                    'assignmentScore' => 0,
                    'midtermScore' => 0,
                    'finaltermScore' => 0
                );
                $this->db->where('studentID', $id);
                $this->db->where('classID', 0);
                $this->db->where('subjectID', $subject['subjectID']);
                $this->db->update('assignments', $data);
            }
        } else {
            foreach($subjects as $subject) {
                $data = array(
                    'studentID' => $id,
                    'classID' => $toClass,
                    'subjectID' => $subject['subjectID'],
                    'assignmentScore' => 0,
                    'midtermScore' => 0,
                    'finaltermScore' => 0
                );
                $this->db->insert('assignments', $data);
            }
        }
    }

    public function getSubjectAvailable($id, $class)
    {
        $this->db->select('student_allscores.classID, subjects.subjectName');
        $this->db->from('subjects');
        $this->db->join('student_allscores', 'student_allscores.subjectID = subjects.subjectID');
        $this->db->where('student_allscores.studentID = ', $id);
        $this->db->where('student_allscores.classID = ', $class);
        $this->db->where('student_allscores.subjectID != ', 'subjects.subjectID');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getSubjectChosen($id, $class)
    {
        $this->db->select('student_allscores.classID, subjects.subjectName');
        $this->db->from('subjects');
        $this->db->join('student_allscores', 'student_allscores.subjectID = subjects.subjectID');
        $this->db->where('student_allscores.studentID = ', $id);
        $this->db->where('student_allscores.classID = ', $class);
        $this->db->where('student_allscores.subjectID = ', 'subjects.subjectID');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getClassInfo($classID)
    {
        $this->db->select('classes.className, subjects.subjectID, subjects.subjectName, user_info.fullName');
        $this->db->from('teachers');
        $this->db->join('subjects', 'teachers.subjectID = subjects.subjectID');
        $this->db->join('user_info', 'teachers.teacherID = user_info.userID');
        $this->db->join('classes', 'teachers.classID = classes.classID');
        $this->db->where('teachers.classID', $classID);
        $query = $this->db->get();

        return $query->result_array();
    }
}
?>