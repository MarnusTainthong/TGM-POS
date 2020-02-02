<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\..\Login_Controller.php");

class Pos_setting extends Login_Controller {

	public function index()
	{
		$this->output('pos/v_setting_catefory');
	}
	
}
