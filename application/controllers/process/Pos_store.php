<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once dirname(__FILE__) . "\..\Login_Controller.php";

class Pos_store extends Login_Controller
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        $this->load->model('m_partner', 'ptr_rs');
        $this->load->model('m_category', 'ctg_rs');
        $this->load->model('m_unit', 'unt_rs');

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

}