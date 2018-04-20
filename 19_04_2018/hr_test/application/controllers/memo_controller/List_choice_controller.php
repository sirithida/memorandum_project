<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/memo_controller/Center.php');

class List_choice_controller extends Center {

     public function __construct(){
       parent::__construct();
       $this->login_center();
       $this->load->model("memo_model/memorandum_model", "memo_m");
       $this->load->model("memo_model/list_approve_model","list");
     }

      public function index(){
          $query["night_id"] = $this->input->get('id');

          $query["subject_link"] = $this->list->query_joinsub();

          $query["nightshift"] = $this->list->hr_nightshift();

          //print_r($query["nightshift"]->result()); die;
          //echo $this->db->last_query(); die;

        //  $this->display("templete/v_layout",$query);

          $this->display("memo_view/list_choice_view",$query);
      }

    }
?>
