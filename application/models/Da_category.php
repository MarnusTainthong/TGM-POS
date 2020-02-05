<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_model.php");

class Da_category extends Main_model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_category()
    {
        $sql = "INSERT INTO `category` (`category_name`, `category_status`) VALUES (?, 1)";
        $this->db->query($sql,array($this->category_name));
    }
    // insert category

    public function edit_category()
    {
        $sql = "UPDATE category 
                SET category_name = ? 
                WHERE category.category_id = ?";
        $this->db->query($sql,array($this->category_name,$this->category_id));
    }
    // edit category
}