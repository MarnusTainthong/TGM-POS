<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once dirname(__FILE__) . "\Main_Controller.php";

class Login_Controller extends Main_Controller
{
    public function index()
    {
        echo "Access system is forbidden.";
        // $this->output('starter_view');
    }

    public function head()
    {
        $this->load->view('template/header');
    }

    public function topbar()
    {
        $this->load->view('template/header_login');
    }

    public function menu_sidebar()
    {
        $this->load->view('template/side_menu');
    }

    public function footer()
    {
        $this->load->view('template/footer');
    }

    public function javascript()
    {
        $this->load->view('template/javascript');
    }

    public function checkUser()
    {
        if ($this->session->userdata('us_id')) {
            return true;
        } else {
            return false;
        }

    }

    public function output($body = '', $data = '')
    {
        if ($this->checkUser()) 
        {
            $this->head();
            $this->javascript();
            $this->topbar();
            $this->menu_sidebar();
            $this->load->view($body, $data);
            $this->footer();

        } else {
            $this->head();
            $this->javascript();
            $this->load->view('page_login');

        }
    }
}
