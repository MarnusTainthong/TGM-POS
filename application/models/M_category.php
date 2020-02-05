<?php
require_once('Da_category.php');

class M_category extends Da_category {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_category_data()
    {
        $sql = "SELECT category_id, category_name FROM pos_tgm.category WHERE category_status = 1";
        $result = $this->db->query($sql);
        return $result;
    }
    //get to show datatable

    public function get_category_by_id()
    {
        $sql = "SELECT category_id, category_name FROM pos_tgm.category WHERE category_id = ?";
        $result = $this->db->query($sql,array($this->category_id));
        return $result;
    }
    // get category by id

}