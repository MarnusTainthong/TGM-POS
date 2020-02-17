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

    public function get_product_opt_all()
    {
        $sql = "SELECT product_id, product_name_th
                FROM pos_tgm.product
                WHERE product_status = 1";
        $result = $this->db->query($sql);
        return $result;
    }
    // get product all to opt

    public function get_product_opt_by_id()
    {
        $sql = "SELECT `product_id`, `product_name_th` 
                FROM `product` 
                WHERE `product_id` = ?";
        $result = $this->db->query($sql,array($this->product_id));
        return $result;
    }
    // get_product_opt_by_id

    public function get_product_opt_like($searchTerm="")
    {
        $sql = "SELECT product_id, product_name_th 
                FROM pos_tgm.product 
                WHERE product_status = 1 AND product_name_th LIKE '%".$searchTerm."%'";
        $result = $this->db->query($sql);
        return $result;
    }
    // get_product_opt_like search

    public function get_product_opt_like_without_use($searchTerm="")
    {
        $sql = "SELECT `product_id`, `product_name_th` 
                FROM `product` 
                WHERE `product_status` = 1 AND `product_id` NOT IN 
                        (SELECT `inventory_product_id` FROM `inventory` WHERE `inventory_status` = 1 AND `inventory_invb_id` = ? GROUP BY `inventory_product_id`)
                AND product_name_th LIKE '%".$searchTerm."%'";
        $result = $this->db->query($sql,array($this->inventory_invb_id));
        return $result;
    }
    // opt แสดงรายการสินค้าที่ยังไม่ได้เพิ่ม หน้ารับสินค้าเข้าคลัง

}