<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
        
    }

    public function index()
    {
        redirect(base_url() . "dashboard");
    }

    public function open($notificationID)
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $roleID = $this->input->post('roleID');
            if($roleID = 1) {
                header('Content-Type: application/json');
                echo json_encode($this->user->loadNotificationAdmin($notificationID));
            } else {
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    public function openTeacher($notificationID)
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $roleID = $this->input->post('roleID');
            if($roleID = 2) {
                header('Content-Type: application/json');
                echo json_encode($this->user->loadNotificationTeacher($notificationID));
            } else {
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function remove($notificationID)
    {
        $roleID = $_SESSION['roleID'];
        if($roleID = 2) {
            $this->user->deleteNotificationTeacher($notificationID);
            redirect($_SERVER['HTTP_REFERER']);
        } else if($roleID = 1) {
            $this->user->deleteNotification($notificationID);
            redirect($_SERVER['HTTP_REFERER']);
        } 
        else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    public function accept($notificationID)
    {
        $roleID = $_SESSION['roleID'];
        $roleID = $this->input->post('roleID');
        if($roleID = 1) {
            if($this->user->updateDataFromNotification($notificationID)) {
                $this->user->deleteNotification($notificationID);
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
?>
