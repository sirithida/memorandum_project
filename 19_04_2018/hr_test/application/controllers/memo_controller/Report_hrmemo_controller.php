<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/memo_controller/Center.php');

class Report_hrmemo_controller extends Center {

     public function __construct(){
       parent::__construct();
       $this->login_center();

       $this->load->model("memo_model/report_mmhr_model","mmhr");
       $this->load->model("memo_model/report_email_model","report");

     }

      public function index(){
        //get from link
        $hr['id'] = $this->input->get('subject');
        $hr['position_id'] = $this->input->get('position');
        $hr['approve_id'] = $this->input->get('approve_id');

        //$hr['status_app'] = $this->input->post('status_approve');
        $hr["status"] = array('00'=> "Waiting" ,'01' => "Receive");

        $hr['form_id'] = $this->mmhr->query_form($hr['id']);

        $hr["report"] = $this->report->report_all($hr['id']);

        $hr["status"] = array('00'=> "Waiting" ,'01' => "Receive");
        $this->display("memo_view/report_mmhr_view",$hr);
      }

      public function post_update(){
        $form_id = $this->input->get('subject');
        $update_staus = $this->input->post('status_approve');
        $employee_id = $this->input->post('approve_id');
      }
    }
