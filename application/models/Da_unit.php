<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_model.php");

class Da_unit extends Main_model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_unit()
    {
        $sql = "INSERT INTO `unit` (`unit_name_th`, `unit_name_en`, `unit_status`) VALUES (?, ?, 1)";
        $this->db->query($sql,array($this->unit_name_th,$this->unit_name_en));
    }
    // insert unit
    
    public function edit_unit()
    {
        $sql = "UPDATE `unit` 
                SET `unit_name_th` = ?, `unit_name_en` = ? 
                WHERE `unit`.`unit_id` = ?";
        $this->db->query($sql,array($this->unit_name_th,$this->unit_name_en,$this->unit_id));
    }
    // edit unit
    
    public function delete_unit()
    {
        $sql = "UPDATE `unit` 
                SET `unit_status` = 0 
                WHERE `unit`.`unit_id` = ?";
        $this->db->query($sql,array($this->unit_id));
    }
    // update status to not use

}