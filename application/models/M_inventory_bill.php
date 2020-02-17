<?php
require_once('Da_inventory_bill.php');

class M_inventory_bill extends Da_inventory_bill {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_last_bill_no()
    {
        $sql = "SELECT `invb_id`, `invb_no`
                FROM `inventory_bill` 
                WHERE invb_status = 1 ORDER BY invb_id DESC LIMIT 1";
        $result = $this->db->query($sql);
        return $result;
    }
    // get_last_bill_no

    public function get_invb_data()
    {
        $sql = "SELECT `invb_id`, `invb_no`, `invb_responsible`, `invb_date`  
                FROM `inventory_bill` 
                WHERE invb_status = 1";
        $result = $this->db->query($sql);
        return $result;
    }
    // get to show datatable

    public function get_invb_by_id()
    {
        $sql = "SELECT `invb_id`,`invb_responsible` 
                FROM `inventory_bill` 
                WHERE `invb_id` = ?";
        $result = $this->db->query($sql,array($this->invb_id));
        return $result;
    }
    // get invb by id to edit resp

}