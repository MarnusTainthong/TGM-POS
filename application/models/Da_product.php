<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\Main_model.php");

class Da_product extends Main_model {
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_product()
    {
        $sql = "INSERT INTO `product` (`product_name_th`, `product_name_en`, `product_details`, `product_sku`, `product_barcode`, `product_category_id`, `product_retail_price`, `product_partner_id`, `product_unit_id`, `product_status`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1)";
        $this->db->query($sql,array($this->product_name_th,$this->product_name_en,$this->product_desc,$this->product_sku,$this->product_barcode,
                                    $this->product_category,$this->product_price,$this->product_supplier,$this->product_unit));
    }
    // insert product
    
    public function edit_product()
    {
        $sql = "UPDATE `product` 
                SET `product_name_th` = ?, `product_name_en` = ?, `product_details` = ?, `product_sku` = ?, `product_barcode` = ?, `product_category_id` = ?, `product_retail_price` = ?, `product_partner_id` = ?, `product_unit_id` = ? 
                WHERE `product`.`product_id` = ?";
        $this->db->query($sql,array($this->product_name_th,$this->product_name_en,$this->product_desc,$this->product_sku,$this->product_barcode,
                                    $this->product_category,$this->product_price,$this->product_supplier,$this->product_unit,$this->product_id));
    }
    // edit product
    
    public function delete_product()
    {
        $sql = "UPDATE `product` 
                SET `product_status` = '0' 
                WHERE `product`.`product_id` = ?";
        $this->db->query($sql,array($this->product_id));
    }
    // update status to not use

}