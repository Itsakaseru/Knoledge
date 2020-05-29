<?php
defined('BASEPATH') OR exit('No direct script access allowed !');

class User extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getUser($email)
    {
        $this->db->trans_begin();
        // create view later
        $query = $this->db->query("SELECT userID, email, hash, salt, roleID FROM users WHERE email='$email'");
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }
        else return $query->result_array();
    }

    public function getRole($id)
    {
        $this->db->trans_begin();
        // create view later
        $query = $this->db->query("SELECT roleID FROM users WHERE userID='$id'");
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }
        else return $query->result_array();
    }

    public function updatePassword($id, $data)
    {
        $this->db->where('userID', $id);
        if($this->db->update('users', $data)) return true; else false;
    }

    public function loadNotificationAdmin($id)
    {
        $this->db->select('request_editprofile.*, users.ppPath AS currImg, reqeditprofile.ppPath');
        $this->db->join('users', 'request_editprofile.targetID = users.userID');
        $this->db->join('reqeditprofile', 'reqeditprofile.notificationID = request_editprofile.notificationID');
        $this->db->where('request_editprofile.notificationID', $id);
        $this->db->from('request_editprofile');
        $query = $this->db->get();

        return $query->result_array()[0];
    }

    public function loadNotificationTeacher($id)
    {
        $this->db->select('request_review.*, student_class.classID, users.ppPath');
        $this->db->join('student_class', 'student_class.studentID = request_review.targetID');
        $this->db->join('users', 'users.userID = request_review.targetID');
        $this->db->where('notificationID', $id);
        $this->db->from('request_review');
        $query = $this->db->get();

        return $query->result_array()[0];
    }

    public function updateDataFromNotification($id)
    {
        $this->db->select('request_editprofile.*, users.ppPath AS currImg, reqeditprofile.ppPath');
        $this->db->from('request_editprofile');
        $this->db->where('notificationID', $id);
        $query = $this->db->get();
        $result = $query->result_array()[0];

        $userID = $result['targetID'];
        if(!empty($result['firstName'])) $data['firstName'] = $result['firstName'];
        if(!empty($result['lastName'])) $data['lastName'] = $result['lastName'];
        if(!empty($result['email'])) $data['email'] = $result['email'];
        
        $this->db->where('userID', $userID);

        $currImg = base_url() . 'data/users-img/' . $result['currImg'];
        $newImg = base_url() . 'data/users-img/' . $result['ppPath'];

        // rename($newImg, $currImg);


        if($this->db->update('users', $data)) return true; else return false;
    }

    public function deleteNotification($id)
    {
        $this->db->where('notificationID', $id);
        $this->db->delete('reqeditprofile');
    }

    public function deleteNotificationTeacher($id)
    {
        $this->db->where('notificationID', $id);
        $this->db->delete('reqreview');
    }

}
?>
