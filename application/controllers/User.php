<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin');
    }

    public function index()
    {
        redirect(base_url() . "dashboard", 'refresh');
    }

    public function info($id)
    {
        // Import CSS, JS, Fonts
        $data['main'] = $this->load->view('include/main', NULL, TRUE);
        $data['navbar'] = $this->load->view('include/navbar', NULL, TRUE);
        $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

        $module['userID'] = $id;
        $module['data'] = $this->admin->getData($id);

        // ONLY LOAD IF USER ID EXIST
        $data['module'] = $this->load->view('admin-module/action/userInfo', $module, TRUE);

        $this->load->model('admin');

        $this->load->view('page/dashboard-admin',$data);
    }

}
?>
