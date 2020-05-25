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
        redirect(base_url() . "dashboard");
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

        $this->load->view('page/dashboard-admin',$data);
    }

    public function editUser($id)
    {
        // Import CSS, JS, Fonts
        $data['main'] = $this->load->view('include/main', NULL, TRUE);
        $data['navbar'] = $this->load->view('include/navbar', NULL, TRUE);
        $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

        // ONLY LOAD IF USER ID EXIST
        $module['userID'] = $id;
        $module['data'] = $this->admin->getData($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // Load Form Validation Library and Configure Form Rules
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            $this->form_validation->set_rules('firstName','First Name','required|max_length[255]',
            array(
                'required' => 'First Name must not be empty!',
                'max_length' => 'First Name too long!'
            ));
            $this->form_validation->set_rules('lastName','Last Name','max_length[255]',
            array(
                'max_length' => 'Last Name too long!'
            ));
            // Only check email if email is changed
            if($this->input->post('email') != $module['data']['email']) {
                $this->form_validation->set_rules('email','Email','required|max_length[255]|valid_email|is_unique[users.email]',
                array(
                    'required' => 'Email must not be empty!',
                    'valid_email' => 'Invalid email address!',
                    'is_unique' => 'Email address already in use!',
                    'max_length' => 'Email address too long!'
                ));
            }
            // Only check if password want to be changed
            if($this->input->post('password') != NULL) {
                $this->form_validation->set_rules('password','Password','required',
                array(
                    'required' => 'Password is required!',
                ));
            }

            if($this->form_validation->run() != false){
                // Form validation passed
                $firstName = $this->input->post('firstName');
                $lastName = $this->input->post('lastName');
                $email = $this->input->post('email');
                $dob = $this->input->post('dob');
                $gender = $this->input->post('gender');
                $role = $this->input->post('role');

                $formData = array();
                if(isset($firstName)) $formData['firstName'] = $firstName;
                if(isset($lastName)) $formData['lastName'] = $lastName;
                if(isset($email)) $formData['email'] = $email;
                if(isset($dob)) $formData['dob'] = $dob;
                if(isset($gender)) $formData['genderID'] = $gender;
                if(isset($role)) $formData['roleID'] = $role;

                $this->admin->updateUserData($id, $formData);
                $this->session->set_flashdata('msg', 'Update Success');
                redirect(base_url() . "dashboard/" . "user/" . $id);
                
            } else {
                $data['module'] = $this->load->view('admin-module/action/editUser', $module, TRUE);
                $this->load->view('page/dashboard-admin',$data);
            }
        } else {
            // NOT A POST REQUEST -> Load normal page
            $data['module'] = $this->load->view('admin-module/action/editUser', $module, TRUE);
            $this->load->view('page/dashboard-admin',$data);
        }
    }

}
?>
