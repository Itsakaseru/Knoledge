<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('user');
        $this->load->model('quote');
    }

    public function index()
    {
        if(!isset($_SESSION['id'])) {
            $data['main'] = $this->load->view('include/main', NULL, TRUE);
            $data['footer'] = $this->load->view('include/footer', NULL, TRUE);
            $data['quote'] = $this->quote->getQuote();

            $this->load->view('page/home', $data);
        }
        else redirect(base_url() . "dashboard");
    }

    public function login()
    {
        // Import CSS, JS, Fonts
        $data['main'] = $this->load->view('include/main', NULL, TRUE);

        $this->load->view('page/login', $data);
	}

    public function action()
    {
        if($this->input->server('REQUEST_METHOD') == "POST") {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            $this->form_validation->set_rules('email', 'Email', 'required|max_length[255]|valid_email',
            array(
                'required' => "Email must not empty.",
                'valid_email' => "Invalid email address.",
                'max_length' => "Email address too long."
            ));
            $this->form_validation->set_rules('password', 'Password', 'required',
            array(
                'required' => "Password must not empty."
            ));

            if($this->form_validation->run() != false) {
                $query = $this->user->getUser($this->input->post('email'));
                $found = 0; // if user found, set to 1

                foreach($query as $row)
                {
                    if(isset($row['userID']) == FALSE) break;
                    $user['userID'] = $row['userID'];
                    $user['email'] = $row['email'];
                    $user['hash'] = $row['hash'];
                    $user['salt'] = $row['salt'];
                    $user['roleID'] = $row['roleID'];
                    $found = 1;
                }
                unset($query);

                // add validation later
                if($found == 1)
                {
                    // echo $user['userID'] . ", " . $user['email'] . ", " . $user['hash'] . ", " . $user['salt'];
                    if(hash("sha256", $this->input->post('password') . $user['salt']) == $user['hash'])
                    {
                        // echo "Password correct. Save to session and href to Dashboard.";
                        // Currently uses userID in sessions, probably use token later
                        $data_session = array(
                            'userID' => $user['hash'],
                            'hash' => 1
                        );

                        $this->session->set_userdata('id', $user['userID']);
                        $this->session->set_userdata('roleID', $user['roleID']);
                        $this->session->set_userdata('logged', 1);
                        echo "<script>window.location.href = \"" . base_url('dashboard') . "\" </script>";
                    }
                    else
                    {
                         // echo "Wrong password";
                         $data['main'] = $this->load->view('include/main', NULL, TRUE);
                         $data['pw_false'] = TRUE;

                         $this->load->view('page/login', $data);
                    }
                }
                else
                {
                    // echo "Wrong username";
                    $data['main'] = $this->load->view('include/main', NULL, TRUE);
                    $data['pw_false'] = TRUE;

                    $this->load->view('page/login', $data);
                }
            }
            else {
                // validation error
                $data['main'] = $this->load->view('include/main', NULL, TRUE);

                $this->load->view('page/login', $data);
            }
        }
        else {
            // echo "Not POST";
            $data['main'] = $this->load->view('include/main', NULL, TRUE);

            $this->load->view('page/login', $data);
        }
    }

    public function logout()
    {
        if(isset($_SESSION['id'])) unset($_SESSION['id']);
        if(isset($_SESSION['logged'])) unset($_SESSION['logged']);
        if(isset($_SESSION['roleID'])) unset($_SESSION['roleID']);
        redirect(base_url());
    }

}
?>
