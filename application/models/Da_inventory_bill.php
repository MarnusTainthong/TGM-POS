<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_model.php");

class Da_inventory_bill extends Main_model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_inventory_bill()
    {
        $sql = "INSERT INTO `inventory_bill` (`invb_no`, `invb_responsible`, `invb_date`, `invb_status`) 
                VALUES (?, ?, ?, 1)";
        $this->db->query($sql,array($this->invb_no,$this->invb_resp,$this->invb_date));
    }
    // insert_inventory_bill
    
    public function edit_bill_resp()
    {
        $sql = "UPDATE `inventory_bill` 
                SET `invb_responsible` = ? 
                WHERE `inventory_bill`.`invb_id` = ?";
        $this->db->query($sql,array($this->invb_responsible,$this->invb_id));
    }
    // edit bill resp
    
    public function delete_inv_bill()
    {
        $sql = "UPDATE `inventory_bill` 
                SET `invb_status` = 0 
                WHERE `inventory_bill`.`invb_id` = ?";
        $this->db->query($sql,array($this->invb_id));
    }
    // delete_inv_bill


}