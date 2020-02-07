<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_model.php");

class Da_partner extends Main_model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_partner()
    {
        $sql = "INSERT INTO `partner` (`partner_name_full`, `partner_name_short`, `partner_brand_name`, `partner_desc`, `partner_status`) 
                VALUES (?, ?, ?, ?, 1)";
        $this->db->query($sql,array($this->partner_name_full,$this->partner_name_short,$this->partner_brand_name,$this->partner_desc));
    }
    // insert partner
    
    public function edit_partner()
    {
        $sql = "UPDATE `partner` 
                SET `partner_name_full` = ?, `partner_name_short` = ?, `partner_brand_name` = ?, `partner_desc` = ? 
                WHERE `partner`.`partner_id` = ?";
        $this->db->query($sql,array($this->partner_name_full,$this->partner_name_short,$this->partner_brand_name,$this->partner_desc,$this->partner_id));
    }
    // edit partner
    
    public function delete_partner()
    {
        $sql = "UPDATE `partner` 
                SET `partner_status` = '0' 
                WHERE `partner`.`partner_id` = ?";
        $this->db->query($sql,array($this->partner_id));
    }
    // update status to not use

}