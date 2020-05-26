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
        $module['currentClass'] = $this->admin->getCurrentClass($id);

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

            // File check enable if user want to upload
            if(isset($_FILES['imageFile']['name']) && $_FILES['imageFile']['name']!="") {
                $this->form_validation->set_rules('imageFile', 'File', 'callback_fileCheck');
                
                // Upload Configuration
				$config['upload_path'] = './data/users-img/';
				$config['allowed_types'] = 'png|jpg|jpeg';
				$config['max_size'] = 10000;
                $config['file_name'] = md5($id);
                $config['overwrite'] = TRUE;

				$this->load->library('upload', $config);
            }

            if($this->form_validation->run() != false){
                // Form validation passed
                $firstName = $this->input->post('firstName');
                $lastName = $this->input->post('lastName');
                $email = $this->input->post('email');
                $password = $this->input->post('password');
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
                if(isset($password) && $password != NULL) {
                    // Load random generator model
                    $this->load->model('saltgenerator');

                    $salt = $this->saltgenerator->getSalt();
                    $formData['salt'] = $salt;
                    $formData['hash'] = hash('sha256', $password . $salt);
                }

                if(isset($_FILES['imageFile']['name']) && $_FILES['imageFile']['name']!="") {
                // User want to change profile picture
                    if($this->upload->do_upload('imageFile')) {
                        $data = $this->upload->data();
                        if(isset($_FILES['imageFile']['name']) && $_FILES['imageFile']['name']!="") $formData['ppPath'] = $data['file_name'];
                        // Insert to database
                        if($this->admin->updateUserData($id, $formData)) {
                            $this->session->set_flashdata('success', 'Profile Updated Successfully!');
                            redirect(base_url() . "user/" . $id);
                        } else {
                            $this->session->set_flashdata('failed', 'Something went wrong');
                            redirect(base_url() . "user/" . $id);
                        }
                    }
                    else {
                        $this->session->set_flashdata('failed', 'Something went wrong');
                        redirect(base_url() . "user/" . $id);
                    }
                // If user DON'T want to change profile picture
                } else {
                    // Insert to database
                    if($this->admin->updateUserData($id, $formData)) {
                        $this->session->set_flashdata('success', 'Profile Updated Successfully!');
                        redirect(base_url() . "user/" . $id);
                    } else {
                        $this->session->set_flashdata('failed', 'Something went wrong!');
                        redirect(base_url() . "user/" . $id);
                    }
                }
                
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

    public function fileCheck($str){
        $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG);
        $detectedType = exif_imagetype($_FILES['imageFile']['tmp_name']);
        if(in_array($detectedType, $allowedTypes)){
            // Check file size
            if(filesize($_FILES['imageFile']['tmp_name']) > 10000000) {
                $this->form_validation->set_message('fileCheck', 'Image size exceeds maximum allowable size (10MB)');
                return false;
            }else {
                return true;
            }
        }else{
            $this->form_validation->set_message('fileCheck', 'Only JPG, JPEG, PNG files are allowed!');
            return false;
        }
    }

    public function assignClass($id)
    {
        // Import CSS, JS, Fonts
        $data['main'] = $this->load->view('include/main', NULL, TRUE);
        $data['navbar'] = $this->load->view('include/navbar', NULL, TRUE);
        $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

        // ONLY LOAD IF USER ID EXIST
        $module['userID'] = $id;
        $module['data'] = $this->admin->getData($id);
        $classInfo = $this->admin->getCurrentClass($id);
        $currentClassID = $classInfo['classID'];
        $module['currentClass'] = $classInfo;
        $module['nextClass'] = $this->admin->getNextClass($id, $classInfo);

        // Load Form Validation Library and Configure Form Rules
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $this->form_validation->set_rules('classID','Class ID','required',
        array(
            'required' => 'ClassID cannot be empty!',
        ));

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            if($this->form_validation->run() != false){
                $toClass = $this->input->post('classID');
                $this->admin->assignClass($id, $toClass);
                redirect(base_url() . "user/" . $id);
            } else {
                $this->session->set_flashdata('msg', 'ClassID cannot be empty!');
                redirect(base_url() . "user/" . $id . "/assign/class");
            }

           
        } else {
            // NOT A POST REQUEST -> Load normal page
            $data['module'] = $this->load->view('admin-module/action/assignClass', $module, TRUE);
            $this->load->view('page/dashboard-admin',$data);
        }

        

        // Assign class
        // Show N/A if class is unset
        // If class not assigned // show popup, so admin know to assign it first.
        // Admin can only UPGRADE CLASS
        // If class is not assigned, then update the unassigned value in assigmnets table
        // if class is assigned, add new data in assignments table for all of the subject


        
    }

}
?>
