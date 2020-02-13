<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once dirname(__FILE__) . "\..\Login_Controller.php";

class Pos_product extends Login_Controller
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        $this->load->model('m_partner', 'ptr_rs');
        $this->load->model('m_category', 'ctg_rs');
        $this->load->model('m_unit', 'unt_rs');
        $this->load->model('m_product', 'pdct_rs');

    }

    public function index()
    {
        // echo "Access system is forbidden.";
        redirect('Dashboard');
    }

    public function mange_product()
    {
        $this->output($this->config->item('view_folder').'v_mange_product');
    }
    // show page manage_product

    public function get_category_opt()
    {
        $result = $this->ctg_rs->get_category_opt()->result();

        $opt = '<option selected disabled="disabled">เลือกหมวดหมู่สินค้า</option>';
        foreach ($result as $row) {
            
            $opt .= '<option value="'.$row->category_id.'">'.$row->category_name.'</option>';
        }
        echo json_encode($opt);
    }
    // opt category

    public function get_partner_opt()
    {
        $result = $this->ptr_rs->get_partner_opt()->result();

        $opt = '<option selected disabled="disabled">เลือกตัวแทนจำหน่าย</option>';
        foreach ($result as $row) {
            
            $opt .= '<option value="'.$row->partner_id.'">('.$row->partner_brand_name.') '.$row->partner_name_full.'</option>';
        }
        echo json_encode($opt);
    }
    // opt supplier

    public function get_unit_opt()
    {
        $result = $this->unt_rs->get_unit_opt()->result();

        $opt = '<option selected disabled="disabled">เลือกหน่วยนับ</option>';
        foreach ($result as $row) {
            
            $opt .= '<option value="'.$row->unit_id.'">'.$row->unit_name_th.'</option>';
        }
        echo json_encode($opt);
    }
    // opt supplier

    public function get_product_show()
    {
        $result = $this->pdct_rs->get_product_datatable()->result();
        
        $all_data = array();
        $i = 1;
        foreach ($result as $row) {

            if ($row->product_barcode != 0) {
                $data = array(
                    'pdct_seq' => '<center>' . $i++ . '</center>',
                    'pdct_id' => $row->product_id,
                    'pdct_sku' => '<center>'. $row->product_sku . '</center>',
                    'pdct_name' => $row->product_name_th,
                    'pdct_unit' => '<center>' . $row->unit_name_th . '</center>',
                    'pdct_price' => '<center>' . $row->product_retail_price . '</center>',
                    'pdct_barcode' => '<center><button type="button" class="'.$this->config->item('btn_true').' " '.$this->config->item('tooltip_have_barcode').'><i class="'.$this->config->item('icon_check').'"></i></button></center>',
                    'pdct_action' => '<div class="'.$this->config->item('td_action').'">
                                    <a class="'.$this->config->item('btn_more_info').'" href="'.site_url().$this->config->item('ctrl_path').'/Pos_product/product_info/'.$row->product_id.'"'.$this->config->item('tooltip_info').'><i class="'.$this->config->item('icon_more_info').'"></i></a>
                                    <button type="button" class="'.$this->config->item('btn_edit').'" onclick="edit_product('.$row->product_id.')" '.$this->config->item('tooltip_edit').'><i class="'.$this->config->item('icon_edit').'"></i></button>
                                    <button type="button" class="'.$this->config->item('btn_delete').'" onclick="delete_product('.$row->product_id.')" '.$this->config->item('tooltip_delete').'><i class="'.$this->config->item('icon_delete').'"></i></button></div>',
                );
            }else {
                $data = array(
                    'pdct_seq' => '<center>' . $i++ . '</center>',
                    'pdct_id' => $row->product_id,
                    'pdct_sku' => '<center>'. $row->product_sku . '</center>',
                    'pdct_name' => $row->product_name_th,
                    'pdct_unit' => '<center>' . $row->unit_name_th . '</center>',
                    'pdct_price' => '<center>' . $row->product_retail_price . '</center>',
                    'pdct_barcode' => '<center><button type="button" class="'.$this->config->item('btn_false').' " '.$this->config->item('tooltip_no_barcode').'><i class="'.$this->config->item('icon_no_check').'"></i></button></center>',
                    'pdct_action' => '<div class="'.$this->config->item('td_action').'">
                                    <a class="'.$this->config->item('btn_more_info').'" href="'.site_url().$this->config->item('ctrl_path').'/Pos_product/product_info/'.$row->product_id.'"'.$this->config->item('tooltip_info').'><i class="'.$this->config->item('icon_more_info').'"></i></a>
                                    <button type="button" class="'.$this->config->item('btn_edit').'" onclick="edit_product('.$row->product_id.')" '.$this->config->item('tooltip_edit').'><i class="'.$this->config->item('icon_edit').'"></i></button>
                                    <button type="button" class="'.$this->config->item('btn_delete').'" onclick="delete_product('.$row->product_id.')" '.$this->config->item('tooltip_delete').'><i class="'.$this->config->item('icon_delete').'"></i></button></div>',
                );
            }
            array_push($all_data, $data);
        }
        
        echo json_encode($all_data);
    }
    // datatable product

    public function get_product_by_id()
    {
        $product_id = $this->input->post('product_id');
        $this->pdct_rs->product_id = $product_id;
        $result = $this->pdct_rs->get_product_by_id()->row_array();
        echo json_encode($result);
    }
    // get product data by id

    public function get_category_opt_select()
    {
        $category_id = $this->input->post('ctg_id');
        $result = $this->ctg_rs->get_category_opt()->result();

        $opt = '<option disabled="disabled">เลือกหมวดหมู่สินค้า</option>';

            $selected = "";
            foreach ($result as $row ) {
                if ($row->category_id == $category_id) {
                    $selected = "selected";
                }else {
                    $selected = "";
                }
                $opt .= '<option '. $selected .' value="'.$row->category_id.'">'.$row->category_name.'</option>';
    
            }

        echo json_encode($opt);
    }
    // select category opt by id

    public function get_partner_opt_select()
    {
        $partner_id = $this->input->post('ptr_id');
        $result = $this->ptr_rs->get_partner_opt()->result();

        $opt = '<option disabled="disabled">เลือกตัวแทนจำหน่าย</option>';

            $selected = "";
            foreach ($result as $row ) {
                if ($row->partner_id == $partner_id) {
                    $selected = "selected";
                }else {
                    $selected = "";
                }
                $opt .= '<option '.$selected.' value="'.$row->partner_id.'">('.$row->partner_brand_name.') '.$row->partner_name_full.'</option>';
    
            }

        echo json_encode($opt);
    }
    // get partner opt select

    public function get_unit_opt_select()
    {
        $unit_id = $this->input->post('unt_id');
        $result = $this->unt_rs->get_unit_opt()->result();

        $opt = '<option disabled="disabled">เลือกหน่วยนับ</option>';

            $selected = "";
            foreach ($result as $row ) {
                if ($row->unit_id  == $unit_id ) {
                    $selected = "selected";
                }else {
                    $selected = "";
                }
                $opt .= '<option '. $selected .' value="'.$row->unit_id.'">'.$row->unit_name_th.'</option>';
    
            }

        echo json_encode($opt);
    }
    // get unit opt select

    public function ajax_add_product()
    {
        $product_id = $this->input->post('product_id');
        $product_name_th = $this->input->post('product_name_th');
        $product_name_en = $this->input->post('product_name_en');
        $product_desc = $this->input->post('product_desc');
        $product_sku = $this->input->post('product_sku');
        $product_barcode = $this->input->post('producct_barcode');
        $product_category = $this->input->post('product_category');
        $product_price = $this->input->post('product_price');
        $product_supplier = $this->input->post('product_supplier');
        $product_unit = $this->input->post('product_unit');
        
        if (empty($product_id)) {
            
            //ส่วน insert
            $this->pdct_rs->product_name_th = $product_name_th;
            $this->pdct_rs->product_name_en = $product_name_en;
            $this->pdct_rs->product_desc = $product_desc;
            $this->pdct_rs->product_sku = $product_sku;
            $this->pdct_rs->product_barcode = $product_barcode;
            $this->pdct_rs->product_category = $product_category;
            $this->pdct_rs->product_price = $product_price;
            $this->pdct_rs->product_supplier = $product_supplier;
            $this->pdct_rs->product_unit = $product_unit;
            $this->pdct_rs->insert_product();
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
            $this->pdct_rs->product_id = $product_id;
            $this->pdct_rs->product_name_th = $product_name_th;
            $this->pdct_rs->product_name_en = $product_name_en;
            $this->pdct_rs->product_desc = $product_desc;
            $this->pdct_rs->product_sku = $product_sku;
            $this->pdct_rs->product_barcode = $product_barcode;
            $this->pdct_rs->product_category = $product_category;
            $this->pdct_rs->product_price = $product_price;
            $this->pdct_rs->product_supplier = $product_supplier;
            $this->pdct_rs->product_unit = $product_unit;
            $this->pdct_rs->edit_product();
            
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
    // add & update product

    public function ajax_del_product()
    {
        $product_id = $this->input->post('product_id');
        $this->pdct_rs->product_id = $product_id;
        $result = $this->pdct_rs->delete_product();
        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $data["action_status"] = 2;
        }else{
            $this->db->trans_commit();
            $data["action_status"] = 1;
        }
        echo json_encode($data);
    }
    // delete product
    
    public function get_product_opt()
    {
        $searchTerm  = $this->input->post('searchTerm');
        $result = $this->pdct_rs->get_product_opt_like($searchTerm)->result_array();
        
        $data = array();
        foreach ($result as $row) {
            $data[] = array(
                "id" => $row['product_id'],
                "text" => $row['product_name_th']
            );
        }
        echo json_encode($data);
    }
    // opt product all

    public function product_info($product_id="")
    {
        $data["product_id"] = $product_id;
        $this->output($this->config->item('view_folder').'/v_product_info',$data);
    }
    // product_info

    public function get_product_opt_by_id()
    {
        // $product_id  = $this->input->post('product_id');
        // $this->pdct_rs->product_id = $product_id;
        // $result = $this->pdct_rs->get_product_opt_by_id()->result_array();
        
        // $data = array();
        // foreach ($result as $row) {
        //     $data[] = array(
        //         "id" => $row['product_id'],
        //         "text" => $row['product_name_th']
        //     );
        // }
        // echo json_encode($data);

        $product_id = $this->input->post('product_id');
        $this->pdct_rs->product_id = $product_id;
        $result = $this->pdct_rs->get_product_opt_by_id()->result();

        // $opt = '<option disabled="disabled">เลือกสินค้า</option>';
        $opt='';

            $selected = "";
            foreach ($result as $row ) {
                if ($row->product_id  == $product_id ) {
                    $selected = "selected";
                }else {
                    $selected = "";
                }
                $opt .= '<option '. $selected .' value="'.$row->product_id.'">'.$row->product_name_th.'</option>';
    
            }

        echo json_encode($opt);
    }
    // get_product_opt_by_id

}