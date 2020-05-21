<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
    }

    public function index()
    {
        $data['main'] = $this->load->view('include/main', NULL, TRUE);
        $data['footer'] = $this->load->view('include/footer', NULL, TRUE);

        $this->load->view('page/home', $data);
    }

    public function login()
    {
        // Import CSS, JS, Fonts
        $data['main'] = $this->load->view('include/main', NULL, TRUE);

        $this->load->view('page/login', $data);
	}

    public function action()
    {
        $query = $this->user->getUser($this->input->post('email'));
        $found = 0; // if user found, set to 1

        foreach($query as $row)
        {
            if(isset($row['userID']) == FALSE) break;
            $user['userID'] = $row['userID'];
            $user['email'] = $row['email'];
            $user['hash'] = $row['hash'];
            $user['salt'] = $row['salt'];
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
                $this->session->set_userdata('logged', 1);
                echo "<script>window.location.href = \"" . base_url('dashboard') . "\"</script>";
            }
            else
            {
                // echo "Wrong password";
            }
        }
        else
        {
            // echo "User not found!";
        }
    }

}
?>
