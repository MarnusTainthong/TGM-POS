<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once dirname(__FILE__) . "\..\Login_Controller.php";

class Pos_setting extends Login_Controller
{

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('m_category', 'ctg_rs');
        $this->load->model('m_unit', 'unt_rs');
        $this->load->model('m_partner', 'ptr_rs');
    }

    public function index()
    {
        echo "Access system is forbidden.";
    }

    public function set_category()
    {
        $this->output($this->config->item('view_folder').'v_setting_category');
        
    }
    // ตั้งค่าประเภทสินค้า view
    
    public function ajax_add_category()
    {
        $category_name = $this->input->post('category_name');
        $category_id = $this->input->post('category_id');
        
        if (empty($category_id)) {
            
            //ส่วน insert
            $this->ctg_rs->category_name = $category_name;
            $this->ctg_rs->insert_category();
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
            $this->ctg_rs->category_name = $category_name;
            $this->ctg_rs->category_id = $category_id;
            $this->ctg_rs->edit_category();
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
    // add category
    
    public function get_category_show()
    {
        $result = $this->ctg_rs->get_category_data()->result();
        
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;
        
        $all_data = array();
        $i = 1;
        foreach ($result as $row) {
            $data = array(
                'ctg_seq' => '<center>' . $i++ . '</center>',
                'ctg_id' => $row->category_id,
                'ctg_name' => $row->category_name,
                'ctg_action' => '<div class="'.$this->config->item('td_action').'"><button type="button" class="'.$this->config->item('btn_edit').'" onclick="edit_category('.$row->category_id.')" '.$this->config->item('tooltip_edit').'><i class="'.$this->config->item('icon_edit').'"></i></button>
                                <button type="button" class="'.$this->config->item('btn_delete').'" onclick="delete_category('.$row->category_id.')" '.$this->config->item('tooltip_delete').'><i class="'.$this->config->item('icon_delete').'"></i></button></div>',
            );
            array_push($all_data, $data);
        }
        
        echo json_encode($all_data);
    }
    // datatable category
    
    public function get_category_by_id()
    {
        $category_id = $this->input->post('category_id');
        $this->ctg_rs->category_id = $category_id;
        $result = $this->ctg_rs->get_category_by_id()->row_array();
        
        echo json_encode($result);
    }
    // get category by id
    
    public function ajax_del_category()
    {
        $category_id = $this->input->post('category_id');
        $this->ctg_rs->category_id = $category_id;
        $result = $this->ctg_rs->delete_category();
        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $data["action_status"] = 2;
        }else{
            $this->db->trans_commit();
            $data["action_status"] = 1;
        }
        echo json_encode($data);
    }
    // delete category
    
    public function set_unit()
    {
        $this->output($this->config->item('view_folder').'v_setting_unit');
    }
    // ตั้งค่าหน่วยนับ view
    
    public function get_unit_show()
    {
        $result = $this->unt_rs->get_unit_data()->result();
        
        $all_data = array();
        $i = 1;
        foreach ($result as $row) {
            $data = array(
                'unt_seq' => '<center>' . $i++ . '</center>',
                'unt_id' => $row->unit_id,
                'unt_name_th' => $row->unit_name_th,
                'unt_name_en' => $row->unit_name_en,
                'unt_action' => '<div class="'.$this->config->item('td_action').'"><button type="button" class="'.$this->config->item('btn_edit').'" onclick="edit_unit('.$row->unit_id.')" '.$this->config->item('tooltip_edit').'><i class="'.$this->config->item('icon_edit').'"></i></button>
                                <button type="button" class="'.$this->config->item('btn_delete').'" onclick="delete_unit('.$row->unit_id.')" '.$this->config->item('tooltip_delete').'><i class="'.$this->config->item('icon_delete').'"></i></button></div>',
            );
            array_push($all_data, $data);
        }
        
        echo json_encode($all_data);
    }
    // datatable unit
    
    public function ajax_add_unit()
    {
        $unit_id = $this->input->post('unit_id');
        $unit_name_th = $this->input->post('unit_name_th');
        $unit_name_en = $this->input->post('unit_name_en');
        
        if (empty($unit_id)) {
            
            //ส่วน insert
            $this->unt_rs->unit_name_th = $unit_name_th;
            $this->unt_rs->unit_name_en = $unit_name_en;
            $this->unt_rs->insert_unit();
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
            $this->unt_rs->unit_name_th = $unit_name_th;
            $this->unt_rs->unit_name_en = $unit_name_en;
            $this->unt_rs->unit_id = $unit_id;
            $this->unt_rs->edit_unit();
            
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
    // add unit
    
    public function get_unit_by_id()
    {
        $unit_id = $this->input->post('unit_id');
        $this->unt_rs->unit_id = $unit_id;
        $result = $this->unt_rs->get_unit_by_id()->row_array();
        
        echo json_encode($result);
    }
    // get unit by id
    
    public function ajax_del_unit()
    {
        $unit_id = $this->input->post('unit_id');
        $this->unt_rs->unit_id = $unit_id;
        $result = $this->unt_rs->delete_unit();
        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $data["action_status"] = 2;
        }else{
            $this->db->trans_commit();
            $data["action_status"] = 1;
        }
        echo json_encode($data);
    }
    // delete unit
    
    public function set_partner()
    {
        $this->output($this->config->item('view_folder').'v_setting_partner');
    }
    // show page set partner

    public function get_partner_show()
    {
        $result = $this->ptr_rs->get_partner_data()->result();
        
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;
        
        $all_data = array();
        $i = 1;
        foreach ($result as $row) {
            $data = array(
                'ptr_seq' => '<center>' . $i++ . '</center>',
                'ptr_id' => $row->partner_id,
                'ptr_Fname' => $row->partner_name_full,
                'ptr_brand_name' => $row->partner_brand_name,
                'ptr_action' => '<div class="'.$this->config->item('td_action').'">
                                <a class="'.$this->config->item('btn_more_info').'" href="'.site_url().$this->config->item('ctrl_path').'/Pos_setting/partner_info/'.$row->partner_id.'"'.$this->config->item('tooltip_info').'><i class="'.$this->config->item('icon_more_info').'"></i></a>
                                <button type="button" class="'.$this->config->item('btn_edit').'" onclick="edit_partner('.$row->partner_id.')" '.$this->config->item('tooltip_edit').'><i class="'.$this->config->item('icon_edit').'"></i></button>
                                <button type="button" class="'.$this->config->item('btn_delete').'" onclick="delete_partner('.$row->partner_id.')" '.$this->config->item('tooltip_delete').'><i class="'.$this->config->item('icon_delete').'"></i></button></div>',
            );
            array_push($all_data, $data);
        }
        
        echo json_encode($all_data);
    }
    // datatable partner

    public function ajax_add_partner()
    {
        $partner_id = $this->input->post('partner_id');
        $partner_Fname = $this->input->post('partner_Fname');
        $partner_Sname = $this->input->post('partner_Sname');
        $partner_brand = $this->input->post('partner_brand');
        $partner_desc = $this->input->post('partner_desc');
        
        if (empty($partner_id)) {
            
            //ส่วน insert
            $this->ptr_rs->partner_name_full = $partner_Fname;
            $this->ptr_rs->partner_name_short = $partner_Sname;
            $this->ptr_rs->partner_brand_name = $partner_brand;
            $this->ptr_rs->partner_desc = $partner_desc;
            $this->ptr_rs->insert_partner();
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
            $this->ptr_rs->partner_id  = $partner_id;
            $this->ptr_rs->partner_name_full = $partner_Fname;
            $this->ptr_rs->partner_name_short = $partner_Sname;
            $this->ptr_rs->partner_brand_name = $partner_brand;
            $this->ptr_rs->partner_desc = $partner_desc;
            $this->ptr_rs->edit_partner();
            
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
    // datatable

    public function ajax_del_partner()
    {
        $partner_id = $this->input->post('partner_id');
        $this->ptr_rs->partner_id = $partner_id;
        $result = $this->ptr_rs->delete_partner();
        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $data["action_status"] = 2;
        }else{
            $this->db->trans_commit();
            $data["action_status"] = 1;
        }
        echo json_encode($data);
    }
    // delete partner

    public function get_partner_by_id()
    {
        $partner_id = $this->input->post('partner_id');
        $this->ptr_rs->partner_id = $partner_id;
        $result = $this->ptr_rs->get_partner_by_id()->row_array();
        
        echo json_encode($result);
    }
    // get pasrnet by id

    public function partner_info($partner_id='')
    {
        $data["partner_id"] = $partner_id;
        $this->output($this->config->item('view_folder').'/v_partner_info',$data);
    }
    // pass partber_id data to partner_info page

    

}
