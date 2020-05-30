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
        $query = $this->db->query("SELECT userID, firstName, email, hash, salt, roleID FROM users WHERE email='$email'");
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
        $this->db->select('*');
        $this->db->where('notificationID', $id);
        $this->db->from('request_editprofile');
        $query = $this->db->get();

        return $query->result_array()[0];
    }

    public function updateDataFromNotification($id)
    {
        $this->db->select('*');
        $this->db->from('request_editprofile');
        $this->db->where('notificationID', $id);
        $query = $this->db->get();
        $result = $query->result_array()[0];

        $userID = $result['targetID'];
        if(!empty($result['firstName'])) $data['firstName'] = $result['firstName'];
        if(!empty($result['lastName'])) $data['lastName'] = $result['lastName'];
        if(!empty($result['email'])) $data['email'] = $result['email'];
        
        $this->db->where('userID', $userID);
        if($this->db->update('users', $data)) return true; else return false;
    }

    public function deleteNotification($id)
    {
        $this->db->where('notificationID', $id);
        $this->db->delete('reqeditprofile');
    }

    public function getUserInfo($id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('userID', $id);

        $query = $this->db->get();
        return $query->result_array()[0];
    }

}
?>
