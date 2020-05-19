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
        $query = $this->db->query("SELECT userID, email, hash, salt FROM users WHERE email='$email'");
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }
        else return $query->result_array();
    }

}
?>
