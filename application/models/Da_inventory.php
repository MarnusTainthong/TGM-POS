<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_model.php");

class Da_inventory extends Main_model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_product_inventory()
    {
        $sql = "INSERT INTO `inventory` (`inventory_product_id`, `inventory_invb_id`, `inventory_lot`, `inventory_qty`, `inventory_produce`, `inventory_exp`, `inventory_status`) 
                VALUES (?, ?, ?, ?, ?, ?, 1)";
        $this->db->query($sql,array($this->inventory_product_id,$this->inventory_invb_id,$this->inventory_lot,$this->inventory_qty,$this->inventory_produce,$this->inventory_exp));
    }
    // add product to inventory

    public function edit_product_inventory()
    {
        $sql = "UPDATE `inventory` 
                SET `inventory_lot` = ?, `inventory_qty` = ?, `inventory_produce` = ?, `inventory_exp` = ?
                WHERE `inventory`.`inventory_id` = ?";
        $this->db->query($sql,array($this->inventory_lot,$this->inventory_qty,$this->inventory_produce,$this->inventory_exp,$this->inventory_id));
    }
    // edit_product_inventory

}