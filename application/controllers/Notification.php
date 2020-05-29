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
        header('Content-Type: application/json');
        echo json_encode($this->user->loadNotificationAdmin($notificationID));
    }
    
    public function openTeacher($notificationID)
    {
        header('Content-Type: application/json');
        echo json_encode($this->user->loadNotificationTeacher($notificationID));
    }

    public function remove($notificationID)
    {
        $this->user->deleteNotificationTeacher($notificationID);
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function accept($notificationID)
    {
        if($this->user->updateDataFromNotification($notificationID)) {
            $this->user->deleteNotification($notificationID);
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
?>
