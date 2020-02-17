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
        $this->load->model('m_inventory_bill', 'invb_rs');

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
    
    public function product_receive_bill()
    {
        $this->output($this->config->item('view_folder').'v_product_receive_bill');
    }
    // show product receive page

    public function ajax_add_product_qty()
    {
        $inventory_id = $this->input->post('inventory_id');
        $inventory_product_id = $this->input->post('inventory_product_name');
        $invb_id = $this->input->post('invb_id');
        $inventory_lot = $this->input->post('inventory_lot');
        $inventory_qty = $this->input->post('inventory_qty');
        $inventory_produce = $this->input->post('inventory_produce');
        $inventory_exp = $this->input->post('inventory_exp');
        
        if (empty($inventory_id)) {
            
            //ส่วน insert
            $this->inv_rs->inventory_product_id = $inventory_product_id;
            $this->inv_rs->inventory_invb_id = $invb_id;
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
            $this->inv_rs->inventory_lot = $inventory_lot;
            $this->inv_rs->inventory_qty = $inventory_qty;
            $this->inv_rs->inventory_produce = $inventory_produce;
            $this->inv_rs->inventory_exp = $inventory_exp;
            $this->inv_rs->edit_product_inventory();
            
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

    public function ajax_del_product_qty()
    {
        $inventory_id = $this->input->post('inventory_id');
        $this->inv_rs->inventory_id = $inventory_id;
        $result = $this->inv_rs->delete_product_inventory();
        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $data["action_status"] = 2;
        }else{
            $this->db->trans_commit();
            $data["action_status"] = 1;
        }
        echo json_encode($data);
    }
    // ajax_del_product_qty
    
    public function get_product_in()
    {
        $invb_id = $this->input->post('invb_id');
        // echo($invb_id);
        // die;
        $this->inv_rs->inventory_invb_id = $invb_id;
        $result = $this->inv_rs->get_product_inventory_by_invb()->result();
        
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
                'pdct_produce' => '<center>' . dateFormatTH2($row->inventory_produce) . '</center>',
                'pdct_exp' => '<center>' . dateFormatTH2($row->inventory_exp) . '</center>',
                'pdct_action' => '<div class="'.$this->config->item('td_action').'">
                                <button type="button" class="'.$this->config->item('btn_more_info').'" onclick="add_product_qty('.$row->inventory_id.')" '.$this->config->item('tooltip_add_qty').'><i class="'.$this->config->item('icon_add').'"></i></button>
                                <button type="button" class="'.$this->config->item('btn_edit').'" onclick="edit_product_qty('.$row->inventory_id.')" '.$this->config->item('tooltip_edit').'><i class="'.$this->config->item('icon_edit').'"></i></button>
                                <button type="button" class="'.$this->config->item('btn_delete').'" onclick="delete_product_qty('.$row->inventory_id.')" '.$this->config->item('tooltip_delete').'><i class="'.$this->config->item('icon_delete').'"></i></button></div>',
            );
            array_push($all_data, $data);
        }
       echo json_encode($all_data);
    }
    // get_product_in
                    
    public function get_inv_by_id()
    {
        $inventory_id = $this->input->post('inventory_id');
        $this->inv_rs->inventory_id = $inventory_id;
        $result = $this->inv_rs->get_inventory_by_id()->row_array();
        echo json_encode($result);
    }
    // get_inv_by_id
    
    public function ajax_add_inv_bill()
    {
        $invb_resp = $this->input->post('checker_name');
        $invb_id = $this->input->post('invb_id');

        $last_bill_no = $this->invb_rs->get_last_bill_no()->row_array();
        $convert_invb_no = "INVB".str_pad(strval(intval(substr($last_bill_no['invb_no'],4))+1),5,"0",STR_PAD_LEFT);

        $this->invb_rs->invb_no = $convert_invb_no;
        $this->invb_rs->invb_resp = $invb_resp;
        $this->invb_rs->invb_date = date("Y-m-d");

        if (empty($invb_id)) {
            //ส่วน insert
            $this->invb_rs->invb_no = $convert_invb_no;
            $this->invb_rs->invb_resp = $invb_resp;
            $this->invb_rs->invb_date = date("Y-m-d");
            $this->invb_rs->insert_inventory_bill();
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
            $this->invb_rs->invb_responsible = $invb_resp;
            $this->invb_rs->invb_id = $invb_id;
            $this->invb_rs->edit_bill_resp();
            
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
    // ajax_add_inv_bill

    public function ajax_del_invb()
    {
        $invb_id = $this->input->post('invb_id');
        $this->invb_rs->invb_id = $invb_id;
        $result = $this->invb_rs->delete_inv_bill();
        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $data["action_status"] = 2;
        }else{
            $this->db->trans_commit();
            $data["action_status"] = 1;
        }
        echo json_encode($data);
    }
    // ajax_del_invb

    public function get_invb_show()
    {
        $result = $this->invb_rs->get_invb_data()->result();
        
        $all_data = array();
        $i = 1;
        foreach ($result as $row) {
            
            $data = array(
                'invb_seq'     => '<center>' . $i++ . '</center>',
                'invb_bill_no' => '<center>' . $row->invb_no . '</center>',
                'invb_resp'    => $row->invb_responsible,
                'invb_date'    => '<center>' . dateFormatTH2($row->invb_date) . '</center>',
                'invb_action'  => '<div class="'.$this->config->item('td_action').'">
                                    <a class="'.$this->config->item('btn_more_info').'" href="'.site_url().$this->config->item('ctrl_path').'/Pos_store/product_receive/'.$row->invb_id.'"'.$this->config->item('tooltip_add_data').'><i class="'.$this->config->item('icon_add').'"></i></a>
                                    <button type="button" class="'.$this->config->item('btn_edit').'" onclick="edit_resp('.$row->invb_id.')" '.$this->config->item('tooltip_edit').'><i class="'.$this->config->item('icon_edit').'"></i></button>
                                    <button type="button" class="'.$this->config->item('btn_delete').'" onclick="delete_invb('.$row->invb_id.')" '.$this->config->item('tooltip_delete').'><i class="'.$this->config->item('icon_delete').'"></i></button></div>',
            );
            array_push($all_data, $data);
        }
       echo json_encode($all_data);
    }
    // get_invb_show

    public function get_invb_by_id()
    {
        $invb_id = $this->input->post('invb_id');
        $this->invb_rs->invb_id = $invb_id;
        $result = $this->invb_rs->get_invb_by_id()->row_array();
        echo json_encode($result);
    }
    // get_invb_by_id

    public function product_receive($invb_id)
    {
        $data["invb_id"] = $invb_id;
        $this->output($this->config->item('view_folder').'v_product_receive',$data);
    }
    // product_receive

}