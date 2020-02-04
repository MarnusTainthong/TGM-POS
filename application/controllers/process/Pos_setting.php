<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."\..\Login_Controller.php");

class Pos_setting extends Login_Controller {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('m_category','ctg_rs');
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
           if ($this->db->trans_status() === FALSE){
               $this->db->trans_rollback();
               $data["action_status"] = 2;
            //    save not success
            }else{
               $this->db->trans_commit();
               $data["action_status"] = 1;
            //    save success
            }
       }
       echo json_encode($data);

    }

    public function get_category_show()
    {
        $result = $this->ctg_rs->get_category_data()->result();

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $all_data = array();
        $i=1;
        foreach ($result as $row) {
            $data = array(
                'ctg_seq'       => '<center>'.$i++.'</center>',
                // 'ctg_id'        => $row->category_id,
                'ctg_name'      => $row->category_name,
                'ctg_action'   => 'action',
            );
            array_push($all_data,$data);
        }

        echo json_encode($all_data);
    }
    // datatable
	
}