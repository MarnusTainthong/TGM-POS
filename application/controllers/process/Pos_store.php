<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once dirname(__FILE__) . "\..\Login_Controller.php";

class Pos_store extends Login_Controller
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        $this->load->model('m_inventory', 'inv_rs');

    }

    public function index()
    {
        // echo "Access system is forbidden.";
        redirect('Dashboard');
    }

    public function mange_store()
    {
        $this->output($this->config->item('view_folder').'v_mange_store');
    }
    // show page manage_product
    
    public function product_receive()
    {
        $this->output($this->config->item('view_folder').'v_product_receive');
    }
    // show product receive page

    public function ajax_add_product_inv()
    {
        $inventory_id = $this->input->post('inventory_id');
        $inventory_product_name = $this->input->post('inventory_product_name');
        $inventory_lot = $this->input->post('inventory_lot');
        $inventory_qty = $this->input->post('inventory_qty');
        $inventory_produce = $this->input->post('inventory_produce');
        $inventory_exp = $this->input->post('inventory_exp');
        
        if (empty($inventory_id)) {
            
            //ส่วน insert
            $this->inv_rs->inventory_product_name = $inventory_product_name;
            $this->inv_rs->inventory_lot = $inventory_lot;
            $this->inv_rs->inventory_qty = $inventory_qty;
            $this->inv_rs->inventory_produce = $inventory_produce;
            $this->inv_rs->inventory_exp = $inventory_exp;
            $this->inv_rs->insert_product_inventory();
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                $data["action_status"] = 2;
                //    save not success
            } else {
                $this->db->trans_commit();
                $data["action_status"] = 1;
                //    save success
            }
        }else {
            // ส่วน edit
            $this->inv_rs->inventory_id = $inventory_id;
            $this->inv_rs->inventory_product_name = $inventory_product_name;
            $this->inv_rs->inventory_lot = $inventory_lot;
            $this->inv_rs->inventory_qty = $inventory_qty;
            $this->inv_rs->inventory_produce = $inventory_produce;
            $this->inv_rs->inventory_exp = $inventory_exp;
            $this->inv_rs->edit_product();
            
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                $data["action_status"] = 4;
                // edit not success
            } else {
                $this->db->trans_commit();
                $data["action_status"] = 3;
                //  edit success
            }
        }
        
        echo json_encode($data);
    }
    // add&update product in inventory

    public function get_product_in()
    {
        $result = $this->inv_rs->get_product_inventory()->result();
        
        $all_data = array();
        $i = 1;
        foreach ($result as $row) {
        
            $data = array(
                'inv_id' => $row->inventory_id,
                'pdct_seq' => '<center>' . $i++ . '</center>',
                'pdct_sku' => '<center>' . $row->product_sku . '</center>',
                'pdct_name' => '<center>'. $row->product_name_th .'</center>',
                'pdct_qty' => '<center>' . $row->inventory_qty . '</center>',
                'pdct_unit' => '<center>' . $row->unit_name_th . '</center>',
                'pdct_lot' => '<center>' . $row->inventory_lot . '</center>',
                'pdct_produce' => '<center>' . $row->inventory_produce . '</center>',
                'pdct_exp' => '<center>' . $row->inventory_exp . '</center>',
                'pdct_action' => '<div class="'.$this->config->item('td_action').'">
                                <a class="'.$this->config->item('btn_more_info').'" href="'.site_url().$this->config->item('ctrl_path').'/Pos_product/product_info/'.$row->inventory_id.'"'.$this->config->item('tooltip_add_qty').'><i class="'.$this->config->item('icon_add').'"></i></a>
                                <button type="button" class="'.$this->config->item('btn_edit').'" onclick="edit_product('.$row->inventory_id.')" '.$this->config->item('tooltip_edit').'><i class="'.$this->config->item('icon_edit').'"></i></button>
                                <button type="button" class="'.$this->config->item('btn_delete').'" onclick="delete_product('.$row->inventory_id.')" '.$this->config->item('tooltip_delete').'><i class="'.$this->config->item('icon_delete').'"></i></button></div>',
            );

            array_push($all_data, $data);
        }
        
        echo json_encode($all_data);
    }
}