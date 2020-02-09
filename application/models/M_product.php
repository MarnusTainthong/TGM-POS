<?php
require_once('Da_product.php');

class M_product extends Da_product {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_product_datatable()
    {
        $sql = "SELECT product_id, product_name_th, product_name_en, product_sku, product_barcode, product_retail_price, unit.unit_name_th, unit.unit_name_en 
                FROM pos_tgm.product
                LEFT JOIN pos_tgm.unit ON product.product_unit_id = unit.unit_id 
                WHERE product.product_status = 1";
        $result = $this->db->query($sql);
        return $result;
    }
    // get to show datatable

    public function get_unit_by_id()
    {
        // $sql = "SELECT `unit_id`, `unit_name_th`, `unit_name_en` 
        //         FROM pos_tgm.unit 
        //         WHERE `unit_id` = ?";
        // $result = $this->db->query($sql,array($this->unit_id));
        // return $result;
    }
    // get unit by id

    public function get_unit_opt()
    {
        // $sql = "SELECT `unit_id`, `unit_name_th` 
        //         FROM pos_tgm.unit 
        //         WHERE `unit_status` = 1";
        // $result = $this->db->query($sql);
        // return $result;
    }
    // get unit show option

}