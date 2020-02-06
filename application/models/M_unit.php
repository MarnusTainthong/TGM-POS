<?php
require_once('Da_unit.php');

class M_unit extends Da_unit {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_unit_data()
    {
        $sql = "SELECT `unit_id`, `unit_name_th`, `unit_name_en`
                FROM pos_tgm.unit 
                WHERE `unit_status` = 1";
        $result = $this->db->query($sql);
        return $result;
    }
    // get to show datatable

    public function get_unit_by_id()
    {
        $sql = "SELECT `unit_id`, `unit_name_th`, `unit_name_en` 
                FROM pos_tgm.unit 
                WHERE `unit_id` = ?";
        $result = $this->db->query($sql,array($this->unit_id));
        return $result;
    }

}