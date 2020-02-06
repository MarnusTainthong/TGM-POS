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
    }

    public function index()
    {
        echo "Access system is forbidden.";
    }

    public function set_category()
    {
        $this->output('pages/v_setting_category');

    }
    // go to page setting_category

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
                'ctg_action' => '<button type="button" class="'.$this->config->item('btn_edit').'" onclick="edit_category('.$row->category_id.')" '.$this->config->item('tooltip_edit').'><i class="'.$this->config->item('icon_edit').'"></i></button>
                                <button type="button" class="'.$this->config->item('btn_delete').'" onclick="delete_category('.$row->category_id.')" '.$this->config->item('tooltip_delete').'><i class="'.$this->config->item('icon_delete').'"></i></button>',
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

}
