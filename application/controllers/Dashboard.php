<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Login_Controller.php");

class Dashboard extends Login_Controller {

	public function index()
	{
		$this->output('v_dashboard');
	}
	
}
