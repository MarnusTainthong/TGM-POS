<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once dirname(__FILE__) . "\Login_Controller.php";

class Authen extends Login_Controller
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        // $this->load->model('User', 'user');
    }

    public function index()
    {
        if ($this->checkUser()) {
            if ($this->session->userdata('us_permission') == 1) 
            {
                redirect('Dashboard');
			}
		}else {
			$this->not_login();
		}
    }

    public function check_login()
    {
        // รับ input จาก form
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        if ($username == 'admin' && $password == 'admin') {
            $this->session->set_userdata('us_name','Marnus Tainthong');
            $this->session->set_userdata('us_id',55);
            $this->session->set_userdata('us_permission',1);
            $this->session->set_userdata('logged_in',TRUE);
        }
        redirect('Dashboard', 'refresh');  
        
    }

    public function not_login()
    {
        $this->output('page_login');
    }
    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Authen', 'refresh');  
    }
}
