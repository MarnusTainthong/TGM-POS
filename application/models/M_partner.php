<?php
require_once('Da_partner.php');

class M_partner extends Da_partner {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_partner_data()
    {
        $sql = "SELECT `partner_id`, `partner_name_full`, `partner_name_short`, `partner_brand_name` 
                FROM pos_tgm.partner 
                WHERE partner_status = 1";
        $result = $this->db->query($sql);
        return $result;
    }
    // get to show datatable

    public function get_partner_by_id()
    {
        $sql = "SELECT `partner_id`, `partner_name_full`, `partner_name_short`, `partner_brand_name`, `partner_desc` 
                FROM pos_tgm.partner 
                WHERE `partner_id` = ?";
        $result = $this->db->query($sql,array($this->partner_id));
        return $result;
    }
    // get partner by id

    public function get_partner_opt()
    {
        $sql = "SELECT `partner_id`, `partner_name_full`, `partner_name_short`, `partner_brand_name` 
                FROM pos_tgm.partner 
                WHERE partner_status = 1";
        $result = $this->db->query($sql);
        return $result;
    }
    // get partner show option

}