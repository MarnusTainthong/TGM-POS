<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\..\Login_Controller.php");

class Pos_setting extends Login_Controller {

	public function index()
	{
        // index
    }
    
    public function set_category()
    {
        $this->output('pages/v_setting_category');
        
    }
    // go to page setting_category

    public function ajax_add_category()
    {
        # code...
    }
	
}
