<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once dirname(__FILE__) . "\..\Login_Controller.php";

class Pos_sales extends Login_Controller
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

    public function sales_page()
    {
        $this->output($this->config->item('view_folder').'v_sale_product');
    }
    // show page manage_product

}