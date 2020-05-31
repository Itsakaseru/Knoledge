<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('motd');
        $this->load->model('user');

        // if session doesn't exist, return to login page
        if(!isset($_SESSION['logged']) || $_SESSION['logged'] != 1) redirect(base_url("login"));

        // role query
        $query = $this->user->getRole($_SESSION['id']);
        foreach($query as $row) $roleid = $row['roleID'];
        unset($query);

        // If Admin load this
        if($roleid == 1)
        {
            $this->load->model('admin');
        }
        // If Teacher load this
        else if($roleid == 2)
        {
            $this->load->model('teacher');
        }
        // If Student load this
        else if($roleid == 3)
        {
            $this->load->model('student');
        }
    }

    public function index()
    {
        // role query
        $query = $this->user->getRole($_SESSION['id']);
        foreach($query as $row) $roleid = $row['roleID'];
        unset($query);

        // If Admin load this
        if($roleid == 1)
        {
            // Import CSS, JS, Fonts
            $data['main'] = $this->load->view('include/main', NULL, TRUE);
            $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

            $info['userInfo'] = $this->user->getUserInfo($_SESSION['id']);

            $notifications = $this->admin->getNotifications();
            $nav['notifications'] = array();
            foreach($notifications as $row) {
                // get img from ppPath
                $ppPath = $this->admin->getProfImg($row['targetID']);
                $temp['notificationID'] = $row['notificationID'];
                if($ppPath == NULL || $ppPath == "") $temp['userImg'] = "placeholder.jpg";
                else $temp['userImg'] = $ppPath;
                unset($ppPath);
                if($row['currentLastName'] == NULL || $row['currentLastName'] == "") $temp['fullName'] = $row['currentFirstName'];
                else $temp['fullName'] = $row['currentFirstName'] . " " . $row['currentLastName'];
                $temp['description'] = $row['description'];

                array_push($nav['notifications'], $temp);
                unset($temp);
            }
            unset($notifications);
            $data['navbar'] = $this->load->view('include/navbar', $info, $nav, TRUE);
            unset($nav);

            $this->load->model('admin');

            $view = $this->input->get('v', TRUE);

            // Load admin module
            if(isset($view)) {
                switch($view) {
                    case "students" :
                        $module['studentList'] = $this->admin->getStudentList();
                        $data['module'] = $this->load->view('admin-module/students', $module, TRUE);
                        break;
                    case "teachers" :
                        $module['teacherList'] = $this->admin->getTeacherList();
                        $data['module'] = $this->load->view('admin-module/teachers', $module, TRUE);
                        break;
                    case "subjects" :
                        $module['subjectList'] = $this->admin->getSubjectList();
                        $module['teacherList'] = $this->admin->getTeacherList();
                        $data['module'] = $this->load->view('admin-module/subjects', $module, TRUE);
                        break;
                    case "classes" :
                        $module['classList'] = $this->admin->getClassList();
                        $module['teacherList'] = $this->admin->getTeacherList();
                        $data['module'] = $this->load->view('admin-module/classes', $module, TRUE);
                        break;
                    case "manageusers" :
                        $module['userList'] = $this->admin->getUserList();
                        $data['module'] = $this->load->view('admin-module/manageusers', $module, TRUE);
                        break;
                    default :
                        redirect(base_url() . "dashboard", 'refresh');
                }
            } else {
                $module['totalData'] = $this->admin->getTotalData();
                $module['averageScore'] = $this->admin->getAverageScore();
                $data['module'] = $this->load->view('admin-module/overview', $module, TRUE);
            }

            $this->load->view('page/dashboard-admin',$data);
        }
        // If Teacher load this
        else if($roleid == 2)
        {
            $data['qotd'] = $this->motd->getMotd();
            $data['main'] = $this->load->view('include/main', NULL, TRUE);
            $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

            $notifications = $this->teacher->getNotifications($_SESSION['id']);

            $nav['notifications'] = array();
            foreach($notifications as $row) {
                // get img from ppPath
                $ppPath = $this->teacher->getProfImg($row['targetID']);
                $temp['notificationID'] = $row['notificationID'];
                if($ppPath == NULL || $ppPath == "") $temp['userImg'] = "placeholder.jpg";
                else $temp['userImg'] = $ppPath;
                unset($ppPath);
                $temp['fullName'] = $row['fullName'];
                $temp['description'] = "Score Re-Review Request";

                array_push($nav['notifications'], $temp);
                unset($temp);
            }
            unset($notifications);
            $info['userInfo'] = $this->user->getUserInfo($_SESSION['id']);
            $data['navbar'] = $this->load->view('include/navbar', $info, $nav, TRUE);
            unset($nav);

            $data['teacherInfo'] = $this->teacher->getTeacherInfo($_SESSION['id']);

            $data['homeroomClassInfo'] = $this->teacher->isHomeroomTeacher($_SESSION['id']);
            if(isset($data['homeroomClassInfo']['className'])) {
                $data['homeroomClassAverage'] = $this->teacher->getAverageScoreClass($data['homeroomClassInfo']['className']);
            }
            $data['teachingSubjects'] = $this->teacher->getTeachingSubject($_SESSION['id']);
            $data['subjectList'] = $this->teacher->getSubjectList();

            $view = $this->input->get('v', TRUE);
            $filter = $this->input->get('f', TRUE);

            if(isset($view)) {
                switch($view) {
                    case "homeroom":
                        if(isset($filter)) {
                            $data['studentScoreList'] = $this->teacher->getStudentScorebySubjectInHomeroom($_SESSION['id'], $filter, $data['homeroomClassInfo']['className']);
                        } else {
                            $data['studentScoreList'] = $this->teacher->getStudentScoreHomeroom($_SESSION['id'], $data['homeroomClassInfo']['className']);
                        }
                    break;

                    default:
                        redirect(base_url() . "dashboard", 'refresh');
                }
            } else {
                if(isset($filter)) {
                    $data['studentScoreList'] = $this->teacher->getStudentScorebySubject($_SESSION['id'], $filter);
                } else {
                    $data['studentScoreList'] = $this->teacher->getStudentScoreSubjects($_SESSION['id']);
                }
            }

            $data['currNav'] = $view;
            $data['currFilter'] = $filter;
            $this->load->view('page/dashboard-teacher',$data);
        }
        // If Student load this
        else if($roleid == 3)
        {
            $data['main'] = $this->load->view('include/main', NULL, TRUE);
            $data['footer'] = $this->load->view('include/footer', NULL, TRUE);
            $this->load->model('student');

            $data['qotd'] = $this->motd->getMotd();

            $student['userID'] = $_SESSION['id'];
            $student['data'] = $this->student->getStudentInfo($_SESSION['id']);

            $info['userInfo'] = $this->user->getUserInfo($_SESSION['id']);
            $data['navbar'] = $this->load->view('include/navbar', $info, TRUE);

            $student['currentClass'] = $this->student->getStudentClass($_SESSION['id']);
            if($student['data']['roleID'] == 3){
                $student['currentClass'] = $this->student->getCurrentClass($_SESSION['id']);
            }

            // ONLY LOAD IF USER ID EXIST
            $data['student'] = $this->load->view('page/dashboard-student', $student, TRUE);

            $view = $this->input->get('v', TRUE);

            //Load student module
            if(isset($view)) {
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
        }
    }

    public function reqEditProfile()
    {
        // Import CSS, JS, Fonts
        $data['main'] = $this->load->view('include/main', NULL, TRUE);
        $info['userInfo'] = $this->user->getUserInfo($_SESSION['id']);
        $data['navbar'] = $this->load->view('include/navbar', $info, TRUE);
        $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

        // ONLY LOAD IF USER ID EXIST
        $id = $_SESSION['id'];
        $module['userID'] = $id;

        // role query
        $query = $this->user->getRole($_SESSION['id']);
        foreach($query as $row) $roleid = $row['roleID'];
        unset($query);

        if($roleid == 3) $module['data'] = $this->student->getStudentInfo($id);
        if($roleid == 2) $module['data'] = $this->teacher->getTeacherInfo($id);

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

                $formData = array();
                if(isset($firstName)) $formData['firstName'] = $firstName;
                if(isset($lastName)) $formData['lastName'] = $lastName;
                if(isset($email)) $formData['email'] = $email;

                $picChange = 0;
                if(isset($_FILES['imageFile']['name']) && $_FILES['imageFile']['name']!="") {
                    // picture change
                    if($this->upload->do_upload('imageFile')) {
                        $data = $this->upload->data();
                        $this->user->updateProfPic($_SESSION['id'], $data['file_name']);
                        $picChange = 1;
                    }
                    else {
                        $this->session->set_flashdata('failed', 'Something went wrong');
                        redirect(base_url() . "dashboard/reqEditProfile/" . $id);
                    }
                }

                // data comparison
                $currData = $this->user->queryUser($_SESSION['id']);
                if($currData['firstName'] == $formData['firstName']) unset($formData['firstName']);
                if($currData['lastName'] == $formData['lastName']) unset($formData['lastName']);
                if($currData['email'] == $formData['email']) unset($formData['email']);

                if(count($formData) != 0) {
                    // request update
                    $this->load->model('admin');

                    if($this->admin->addProfRequest($_SESSION['id'], $formData)) {
                        if($picChange == 1) {
                            $this->session->set_flashdata('success', 'Profile picture changed and request successfully sent.');
                            redirect(base_url() . "dashboard");
                        }
                        else {
                            $this->session->set_flashdata('success', 'Request successfully sent.');
                            redirect(base_url() . "dashboard");
                        }
                    }
                    else {
                        $this->session->set_flashdata('failed', 'Something went wrong,');
                        redirect(base_url() . "dashboard/reqEditProfile/" . $id);
                    }
                }
                else {
                    if($picChange == 1) {
                        $this->session->set_flashdata('success', 'Profile picture changed.');
                        redirect(base_url() . "dashboard");
                    }
                    else {
                        $this->session->set_flashdata('error', 'Nothing changed.');
                        redirect(base_url() . "dashboard/reqEditProfile/" . $id);
                    }
                }
            } else {
                $data['student'] = $this->load->view('student-module/reqEditProfile', $module, TRUE);
                $this->load->view('student-module/reqEditProfile',$data);
            }
        } else {
            // NOT A POST REQUEST -> Show form
            $data['student'] = $this->load->view('student-module/reqEditProfile', $module, TRUE);
            $this->load->view('student-module/reqEditProfile',$data);
            // redirect(base_url() . "dashboard");
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

    public function request($id) // student only
    {

        // Import CSS, JS, Fonts
        $data['main'] = $this->load->view('include/main', NULL, TRUE);
        $info['userInfo'] = $this->user->getUserInfo($_SESSION['id']);
        $data['navbar'] = $this->load->view('include/navbar', $info, TRUE);
        $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

        if(isset($_SESSION['id']) && $_SESSION['roleID'] == 3) {
            // ONLY LOAD IF SUBJECT ID EXIST
            $data['subjectID'] = $id;
            $data['subjectInfo'] = $this->student->getSubjectInfo($_SESSION['id'], $id);
            $student['studentClass'] = $this->student->getStudentClass($_SESSION['id']);

            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                // Load Form Validation Library and Configure Form Rules
                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('<li>', '</li>');
                $this->form_validation->set_rules('reason','Reason','required|min_length[20]|max_length[255]',
                array(
                    'required' => 'Reason must not be empty!',
                    'min_length' => 'The reason is too short!',
                    'max_length' => 'The reason is too long!'
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
                    if(isset($reason)) $formData['description'] = $reason;
                    $formData['targetID'] = $_SESSION['id'];
                    $formData['subjectID'] = $id;
                    if(isset($score)) $formData['requestType'] = $score;

                    if($this->student->reqReview($id, $formData)) {
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
        else $this->load->view('errors/html/error_permission.php', $data);
    }

    public function reqEditPassword()
    {
        // role query
        $id = $_SESSION['id'];
        $query = $this->user->getRole($id);
        foreach($query as $row) $roleid = $row['roleID'];
        unset($query);

        // Import CSS, JS, Fonts
        $data['main'] = $this->load->view('include/main', NULL, TRUE);
        $info['userInfo'] = $this->user->getUserInfo($_SESSION['id']);
        $data['navbar'] = $this->load->view('include/navbar', $info, TRUE);
        $data['footer'] = $this->load->view('include/footer', NULL, TRUE);
        $this->load->model('user');

        // ONLY LOAD IF USER ID EXIST
        $module['userID'] = $id;
        if($roleid == 3) $module['data'] = $this->student->getStudentInfo($id);
        if($roleid == 2) $module['data'] = $this->teacher->getTeacherInfo($id);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // Load Form Validation Library and Configure Form Rules
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            // Only check if password want to be changed
            if($this->input->post('password') != NULL) {
                $this->form_validation->set_rules('password','Password','required',
                array(
                    'required' => 'Password is required!'
                ));
            }

            if($this->form_validation->run() != false){
                // Form validation passed
                $password = $this->input->post('password');

                $formData = array();
                if(isset($password) && $password != NULL) {
                    // Load random generator model
                    $this->load->model('saltgenerator');

                    $salt = $this->saltgenerator->getSalt();
                    $formData['salt'] = $salt;
                    $formData['hash'] = hash('sha256', $password . $salt);
                }

                if($this->user->updatePassword($id, $formData)) {
                    $this->session->set_flashdata('success', 'Password changed Successfully!');
                    redirect(base_url() . "dashboard");
                } else {
                    $this->session->set_flashdata('failed', 'Something went wrong');
                    redirect(base_url() . "dashboard/reqEditPassword/" . $id);
                }

            } else {
                $data['student'] = $this->load->view('page/editPassword', $module, TRUE);
                $this->load->view('page/editPassword',$data);
            }
        } else {
            // NOT A POST REQUEST -> Load normal page
            $data['student'] = $this->load->view('page/editPassword', $module, TRUE);
            $this->load->view('page/editPassword',$data);
        }
    }

    public function update($userID, $classID, $subjectID) // teacher only
    {
        $data['main'] = $this->load->view('include/main', NULL, TRUE);
        $info['userInfo'] = $this->user->getUserInfo($_SESSION['id']);
        $data['navbar'] = $this->load->view('include/navbar', $info, TRUE);
        $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

        if(isset($_SESSION['roleID']) && $_SESSION['roleID'] == 2) {
            // Import CSS, JS, Fonts

            $teacherID = $_SESSION['id'];
            $data['studentInfo'] = $this->teacher->getStudentInfo($userID);
            $data['studentScore'] = $this->teacher->getStudentScore($teacherID, $userID, $classID, $subjectID);
            $data['studentID'] = $userID;
            $data['classID'] = $classID;
            $data['subjectID'] = $subjectID;

            // Load Form Validation Library and Configure Form Rules
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            // Only check if password want to be changed
            $this->form_validation->set_rules('assignment','assignment','required|greater_than_equal_to[0]|less_than_equal_to[100]',
            array(
                'required' => 'Score is required!',
                'greater_than_equal_to' => 'Nilai minimum 0',
                'less_than_equal_to' => 'Nilai maksimum 100!'
            ));
            $this->form_validation->set_rules('middleTest','middleTest','required|greater_than_equal_to[0]|less_than_equal_to[100]',
            array(
                'required' => 'Score is required!',
                'greater_than_equal_to' => 'Nilai minimum 0',
                'less_than_equal_to' => 'Nilai maksimum 100!'
            ));
            $this->form_validation->set_rules('finalTest','finalTest','required|greater_than_equal_to[0]|less_than_equal_to[100]',
            array(
                'required' => 'Score is required!',
                'greater_than_equal_to' => 'Nilai minimum 0',
                'less_than_equal_to' => 'Nilai maksimum 100!'
            ));

            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                if($this->form_validation->run() != false) {
                    $formData['assignmentScore'] = $this->input->post('assignment');
                    $formData['midtermScore'] = $this->input->post('middleTest');
                    $formData['finaltermScore'] = $this->input->post('finalTest');

                    if($this->teacher->updateStudentScore($teacherID, $userID, $classID, $subjectID, $formData)) {
                        $this->session->set_flashdata('success', 'Student score updated!');
                        redirect(base_url() . "dashboard");
                    } else {
                        $this->session->set_flashdata('failed', 'Access Denied!');
                        redirect(base_url() . "dashboard");
                    }
                } else {
                    $this->session->set_flashdata('failed', 'Harap isi form dengan benar!');
                    $this->load->view('page/updateScore',$data);
                }
            } else {
                $this->load->view('page/updateScore',$data);
            }
        }
        else {
            $this->load->view('errors/html/error_permission.php', $data);
        }
    }

    public function notification()
    {
        // Only admin and teacher can access this

        // Import CSS, JS, Fonts
        $data['main'] = $this->load->view('include/main', NULL, TRUE);
        $info['userInfo'] = $this->user->getUserInfo($_SESSION['id']);
        $data['navbar'] = $this->load->view('include/navbar', $info, TRUE);
        $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

        if(isset($_SESSION['roleID']) && ($_SESSION['roleID'] == 1 || $_SESSION['roleID'] == 2)) $this->load->view('page/notificationList',$data);
        else $this->load->view('errors/html/error_permission.php', $data);
    }

}
?>
