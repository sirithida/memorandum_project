<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/memo_controller/Center.php');

class List_approve_controller extends Center {

     public function __construct(){
       parent::__construct();
       $this->login_center();
       $this->load->model("memo_model/memorandum_model", "memo_m");
       $this->load->model("memo_model/list_approve_model","list");
      // $this->load->model('memo_model/')
     }

      public function index(){
          $query["night_id"] = $this->input->get('id');
          $query["form_id"] = $this->input->get('form_id');
          $query["position_id"] = $this->input->get('position');
          $query["approve_form"] = $this->input->get('app_form_id');
          $query["subject_link"] = $this->list->query_joinsub($query["form_id"]);

          $query["permission"] = $this->list->condition_permission();
          //echo $this->db->last_query(); die;
          $query["nightshift"] = $this->list->hr_nightshift();
          $query["union"] = $this->list->union_query(); //==2'
          $query["form_statushr"] = $this->list->query_formstatushr();
          //echo $this->db->last_query(); die;
          $this->display("memo_view/list_approve_view",$query);
      }
    }
?>
