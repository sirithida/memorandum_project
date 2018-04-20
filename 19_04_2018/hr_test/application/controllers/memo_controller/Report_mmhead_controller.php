<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/memo_controller/Center.php');

class Report_mmhead_controller extends Center {

     public function __construct(){
       parent::__construct();
       $this->login_center();
       //$this->load->model("memo_model/night_shift_model", "ns_model");
       //$this->load->model("memo_model/Report_nightshift_model", "report_night");
       //$this->load->model("memo_model/Report_nshr_model", "hr_read");
       $this->load->model("memo_model/report_email_model", "report_email");
       $this->load->model("memo_model/report_mmhead_model","head");



     }

      public function index(){
        //get from link
        $hr['id'] = $this->input->get('subject');
        $hr['position_id'] = $this->input->get('position');
        $hr['approve_id'] = $this->input->get('approve_id');

        //$hr['status_app'] = $this->input->post('status_approve');
        $hr["status"] = array('00'=> "Waiting" ,'01' => "approve" ,'02' => "reject");
        //call model
        $hr["report_hr"] = $this->head->reportforhr($hr['id']);
        $hr["form"] = $this->head->query_form($hr['id']);
        //print_r($this->mmhr->query_form($hr['id'])); die;
        $hr["hr_select"] = $this->head->hr_selector();

        $this->display("memo_view/report_mmhead_view",$hr);
      }

      public function post_update(){
        $get_formid = $this->input->post('form_id');
        $status_approve = $this->input->post('status_approve');

        $query_form = $this->head->query_form($get_formid);
        $get_queryform = $this->head->query_emp_status($get_formid);

        $hr_update = $this->head->update_status_head($get_formid,$status_approve);
        $this->session->set_flashdata('flash_msg',"Success for approve memorandum");
        $this->display("memo_view/success_view");
        
      }
    }
