<?php
require_once('Da_inventory.php');

class M_inventory extends Da_inventory {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_product_inventory_by_invb()
    {
        // $sql = "SELECT `inventory_id`, `inventory_product_id`, `inventory_lot`, `inventory_qty`, `inventory_produce`, `inventory_exp`, product.product_name_th, product.product_sku, unit.unit_name_th
        //         FROM `inventory`
        //         LEFT JOIN pos_tgm.product ON inventory.inventory_product_id = product.product_id
        //         LEFT JOIN pos_tgm.unit ON product.product_unit_id = unit.unit_id
        //         WHERE inventory.inventory_status = 1";
        // $result = $this->db->query($sql);
        $sql = "SELECT `inventory_id`,`inventory_invb_id`, `inventory_product_id`, `inventory_lot`, `inventory_qty`, `inventory_produce`, `inventory_exp`, product.product_name_th, product.product_sku, unit.unit_name_th
                FROM `inventory`
                LEFT JOIN pos_tgm.product ON inventory.inventory_product_id = product.product_id
                LEFT JOIN pos_tgm.unit ON product.product_unit_id = unit.unit_id
                WHERE inventory.inventory_status = 1 AND `inventory_invb_id` = ?";
        $result = $this->db->query($sql,array($this->inventory_invb_id));
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

    public function get_sum_product_qty()
    {
        $sql = "SELECT `product_id`,product.product_sku, `product_name_th`, `product_unit_id`,SUM(inventory.inventory_qty) AS 'sum_qty', unit.unit_name_th, unit.unit_name_en
                FROM `product`
                LEFT JOIN inventory ON product.product_id = inventory.inventory_product_id
                LEFT JOIN unit ON product.product_unit_id = unit.unit_id
                WHERE product.product_status = 1 AND inventory.inventory_status = 1 OR inventory.inventory_status IS NULL
                GROUP BY product.product_id";
        $result = $this->db->query($sql);
        return $result;
    }
    // get_sum_product_qty
}