<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once dirname(__FILE__) . "\..\Login_Controller.php";

class Pos_store extends Login_Controller
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();


    }

    public function index()
    {
        // echo "Access system is forbidden.";
        redirect('Dashboard');
    }

    public function mange_store()
    {
        $this->output($this->config->item('view_folder').'v_mange_store');
    }
    // show page manage_product
    
    public function product_receive()
    {
        $this->output($this->config->item('view_folder').'v_product_receive');
    }


}