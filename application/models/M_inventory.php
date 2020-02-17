<?php
require_once('Da_inventory.php');

class M_inventory extends Da_inventory {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_product_inventory()
    {
        $sql = "SELECT `inventory_id`, `inventory_product_id`, `inventory_lot`, `inventory_qty`, `inventory_produce`, `inventory_exp`, product.product_name_th, product.product_sku, unit.unit_name_th
                FROM `inventory`
                LEFT JOIN pos_tgm.product ON inventory.inventory_product_id = product.product_id
                LEFT JOIN pos_tgm.unit ON product.product_unit_id = unit.unit_id
                WHERE inventory.inventory_status = 1";
        $result = $this->db->query($sql);
        return $result;
    }
    // get product to show database

    public function get_inventory_by_id()
    {
        $sql = "SELECT `inventory_id`, `inventory_product_id`, `inventory_lot`, `inventory_qty`, `inventory_produce`, `inventory_exp`
                FROM `inventory` 
                WHERE inventory.inventory_id = ?";
        $result = $this->db->query($sql,array($this->inventory_id));
        return $result;
    }
    // get_inventory_by_id
}