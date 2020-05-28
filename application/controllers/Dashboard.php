<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('motd');
        $this->load->model('user');

        // if session doesn't exist, return to login page
        if(!isset($_SESSION['logged']) || $_SESSION['logged'] != 1)
        {
            echo "<script>window.location.href = \"" . base_url('login') . "\"</script>";
            exit();
        }

        // role query
        $query = $this->user->getRole($_SESSION['id']);
        foreach($query as $row) $roleid = $row['roleID'];
        unset($query);

        // If Admin load this
        if($roleid == 1)
        {
            // admin
        }
        // If Teacher load this
        else if($roleid == 2)
        {
            // teacher
        }
        // If Student load this
        else if($roleid == 3)
        {
            $this->load->model('student');
        }
    }

    public function index()
    {
        // Student Debug
        // Import CSS, JS, Fonts
        $data['main'] = $this->load->view('include/main', NULL, TRUE);
        $data['navbar'] = $this->load->view('include/navbar', NULL, TRUE);
        $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

        $data['qotd'] = $this->motd->getMotd();
 
        $student['userID'] = $_SESSION['id'];
        $student['data'] = $this->student->getStudentInfo($_SESSION['id']);
        $student['currentClass'] = $this->student->getStudentClass($_SESSION['id']);
        if($student['data']['roleID'] == 3){
            $student['currentClass'] = $this->student->getCurrentClass($_SESSION['id']);
        }

        // ONLY LOAD IF USER ID EXIST
        $data['student'] = $this->load->view('page/dashboard-student', $student, TRUE);

        $view = $this->input->get('v', TRUE);

        //Load student module
        if(isset($view)){
            switch($view) {                
                case "showAll" :
                    $student['allSubject'] = $this->student->getAllSubject($_SESSION['id']);
                    $student['allScores'] = $this->student->getAllScores($_SESSION['id']);
                    $student['averageScore'] = $this->student->getAllAverage($_SESSION['id']);
                    $data['student'] = $this->load->view('student-module/showAll', $student, TRUE);
                    break;
                case "Class1" :
                    $student['class1Subject'] = $this->student->getClass1Subject($_SESSION['id']);
                    $student['class1Scores'] = $this->student->getClass1Scores($_SESSION['id']);
                    $student['averageScore'] = $this->student->getClass1Average($_SESSION['id']);
                    $data['student'] = $this->load->view('student-module/class1', $student, TRUE);
                    break;
                case "Class2" :
                    $student['class2Subject'] = $this->student->getClass2Subject($_SESSION['id']);
                    $student['class2Scores'] = $this->student->getClass2Scores($_SESSION['id']);
                    $student['averageScore'] = $this->student->getClass2Average($_SESSION['id']);
                    $data['student'] = $this->load->view('student-module/class2', $student, TRUE);
                    break;
                case "Class3" :
                    $student['class3Subject'] = $this->student->getClass3Subject($_SESSION['id']);
                    $student['class3Scores'] = $this->student->getClass3Scores($_SESSION['id']);
                    $student['averageScore'] = $this->student->getClass3Average($_SESSION['id']);
                    $data['student'] = $this->load->view('student-module/class3', $student, TRUE);
                    break;

                default :
                    redirect(base_url() . "dashboard", 'refresh');

            }
        } else {
            $student['currentSubject'] = $this->student->getCurrentSubject($_SESSION['id']);
            $student['currentScores'] = $this->student->getCurrentScores($_SESSION['id']);
            $student['averageScore'] = $this->student->getCurrentAverage($_SESSION['id']);
            $data['student'] = $this->load->view('student-module/current', $student, TRUE);
        }

        $this->load->view('page/dashboard-student',$data);

        // Teacher Debug
        // Import CSS, JS, Fonts
        // $data['main'] = $this->load->view('include/main', NULL, TRUE);
        // $data['navbar'] = $this->load->view('include/navbar', NULL, TRUE);
        // $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

        // $data['qotd'] = $this->motd->getMotd();

        // $data['studentScores'] = $this->student->getScores();
        // $data['averageScore'] = $this->student->getAverageScore();

        // $this->load->view('page/dashboard-teacher',$data);

        // Admin Debug
        // Import CSS, JS, Fonts
        // $data['main'] = $this->load->view('include/main', NULL, TRUE);
        // $data['navbar'] = $this->load->view('include/navbar', NULL, TRUE);
        // $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

        // $this->load->model('admin');

        // $view = $this->input->get('v', TRUE);

        // // Load admin module
        // if(isset($view)){
        //     switch($view) {                
        //         case "students" :
        //             $module['studentList'] = $this->admin->getStudentList();
        //             $data['module'] = $this->load->view('admin-module/students', $module, TRUE);
        //             break;
        //         case "teachers" :
        //             $module['teacherList'] = $this->admin->getTeacherList();
        //             $data['module'] = $this->load->view('admin-module/teachers', $module, TRUE);
        //             break;
        //         case "subjects" :
        //             $module['subjectList'] = $this->admin->getSubjectList();
        //             $module['teacherList'] = $this->admin->getTeacherList();
        //             $data['module'] = $this->load->view('admin-module/subjects', $module, TRUE);
        //             break;
        //         case "classes" :
        //             $module['classList'] = $this->admin->getClassList();
        //             $module['teacherList'] = $this->admin->getTeacherList();
        //             $data['module'] = $this->load->view('admin-module/classes', $module, TRUE);
        //             break;
        //         case "manageusers" :
        //             $module['userList'] = $this->admin->getUserList();
        //             $data['module'] = $this->load->view('admin-module/manageusers', $module, TRUE);
        //             break;

        //         default :
        //             redirect(base_url() . "dashboard", 'refresh');

        //     }
        // } else {
        //     $module['totalData'] = $this->admin->getTotalData();
        //     $module['averageScore'] = $this->admin->getAverageScore();
        //     $data['module'] = $this->load->view('admin-module/overview', $module, TRUE);
        // }

        // $this->load->view('page/dashboard-admin',$data);
    }

    public function reqEditProfile($id)
    {
        // Import CSS, JS, Fonts
        $data['main'] = $this->load->view('include/main', NULL, TRUE);
        $data['navbar'] = $this->load->view('include/navbar', NULL, TRUE);
        $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

        // ONLY LOAD IF USER ID EXIST
        $module['userID'] = $id;
        $module['data'] = $this->student->getStudentInfo($id);

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

                $formData = array();
                $formData['info'] = "profile";
                $formData['description'] = "Change profile for his or her userID";
                $formData['userID'] = $_SESSION['id'];
                if(isset($firstName)) $formData['firstName'] = $firstName;
                if(isset($lastName)) $formData['lastName'] = $lastName;
                if(isset($email)) $formData['email'] = $email;
                if(isset($dob)) $formData['dob'] = $dob;
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
                        //Insert to database
                        $Json_data = json_encode($formData);
                         if($this->student->reqEditProfile($id, $Json_data)) {
                             $this->session->set_flashdata('success', 'Request Successfully Sent!');
                             redirect(base_url() . "dashboard");
                         } else {
                             $this->session->set_flashdata('failed', 'Something went wrong');
                             redirect(base_url() . "dashboard/reqEditProfile/" . $id);
                         }
                    }
                    else {
                        $this->session->set_flashdata('failed', 'Something went wrong');
                        redirect(base_url() . "dashboard/reqEditProfile/" . $id);
                    }
                // If user DON'T want to change profile picture
                } else {
                     //Insert to database
                     $Json_data = json_encode($formData);
                     if($this->student->reqEditProfile($id, $Json_data)) {
                         $this->session->set_flashdata('success', 'Request Successfully Sent!');
                         redirect(base_url() . "dashboard");
                     } else {
                         $this->session->set_flashdata('failed', 'Something went wrong!');
                         redirect(base_url() . "dashboard/reqEditProfile/" . $id);
                     }
                }
                
            } else {
                $data['student'] = $this->load->view('student-module/reqEditProfile', $module, TRUE);
                $this->load->view('student-module/reqEditProfile',$data);
            }
        } else {
            // NOT A POST REQUEST -> Load normal page
            $data['student'] = $this->load->view('student-module/reqEditProfile', $module, TRUE);
            $this->load->view('student-module/reqEditProfile',$data);
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

    public function request($id)
    {
        // Import CSS, JS, Fonts
        $data['main'] = $this->load->view('include/main', NULL, TRUE);
        $data['navbar'] = $this->load->view('include/navbar', NULL, TRUE);
        $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

        // ONLY LOAD IF SUBJECT ID EXIST
        $data['subjectID'] = $id;
        $data['subjectInfo'] = $this->student->getSubjectInfo($_SESSION['id'], $id);
        $student['studentClass'] = $this->student->getStudentClass($_SESSION['id']);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // Load Form Validation Library and Configure Form Rules
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            $this->form_validation->set_rules('reason','Reason','required|min_length[20]',
            array(
                'required' => 'Reason must not be empty!',
                'max_length' => 'The reason is too short!'
            ));

            $this->form_validation->set_rules('score','Score','required',
            array(
                'required' => 'You need to select Score!',
            ));

            if($this->form_validation->run() != false){
                // Form validation passed
                $subject = $this->input->post('subject');
                $score = $this->input->post('score');
                $reason = $this->input->post('reason');

                $formData = array();
                $formData['info'] = "score";
                if(isset($reason)) $formData['description'] = $reason;
                $formData['userID'] = $_SESSION['id'];
                $formData['subjectID'] = $id;
                $formData['teacherID'] = $data['subjectInfo']['teacherID'];
                $formData['classID'] = $student['studentClass']['classID'];
                if(isset($score)) $formData['score'] = $score;

                $Json_data = json_encode($formData);
                if($this->student->reqReview($id, $Json_data)) {
                    $this->session->set_flashdata('success', 'Request Successfully Sent!');
                    redirect(base_url() . "dashboard");
                } else {
                    $this->session->set_flashdata('failed', 'Something went wrong');
                    redirect(base_url() . "dashboard/request/" . $id);
                }

            }else{
                $this->load->view('page/reqReview',$data);
            }
        }
        $this->load->view('page/reqReview',$data);
    }

    public function update()
    {
        // Import CSS, JS, Fonts
        $data['main'] = $this->load->view('include/main', NULL, TRUE);
        $data['navbar'] = $this->load->view('include/navbar', NULL, TRUE);
        $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

        $this->load->view('page/updateScore',$data);
    }

}
?>
