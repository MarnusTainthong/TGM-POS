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

    public function get_product_by_id()
    {
        $sql = "SELECT `product_id`, `product_name_th`, `product_name_en`, `product_details`, `product_sku`, `product_barcode`, `product_category_id`, `product_retail_price`, `product_partner_id`, `product_unit_id` 
                FROM `product` 
                WHERE product_id = ?";
        $result = $this->db->query($sql,array($this->product_id));
        return $result;
    }
    // get product data to set when edit

}