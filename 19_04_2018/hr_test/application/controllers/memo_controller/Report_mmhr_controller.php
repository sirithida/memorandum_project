<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/memo_controller/Center.php');

class Report_mmhr_controller extends Center {

     public function __construct(){
       parent::__construct();
       $this->login_center();
       //$this->load->model("memo_model/night_shift_model", "ns_model");
       //$this->load->model("memo_model/Report_nightshift_model", "report_night");
       //$this->load->model("memo_model/Report_nshr_model", "hr_read");
       $this->load->model("memo_model/report_email_model", "report_email");
       $this->load->model("memo_model/report_mmhr_model","mmhr");


     }

      public function index(){
        //get from link
        $hr['id'] = $this->input->get('subject');
        $hr['position_id'] = $this->input->get('position');
        $hr['approve_id'] = $this->input->get('approve_id');

        //$hr['status_app'] = $this->input->post('status_approve');
        $hr["status"] = array('00'=> "Waiting" ,'01' => "Receive");
        //call model
        $hr["report_hr"] = $this->mmhr->reportforhr($hr['id']);
        $hr["form"] = $this->mmhr->query_form($hr['id']);
        //print_r($this->mmhr->query_form($hr['id'])); die;
        $hr["hr_select"] = $this->mmhr->hr_selector();

        $this->display("memo_view/report_mmhr_view",$hr);
      }

      public function post_update(){
        $get_formid = $this->input->post('form_id');
        //echo $get_formid; die;
        //$employee_id = $this->input->post('emp_id');
        //$hr["hr_report"] = $this->mmhr->reportforhr($get_formid);
        $status_approve = $this->input->post('status_approve');
        $query_form = $this->mmhr->query_form($get_formid);

        $hr_update = $this->mmhr->update_status_hrrecieve($get_formid,$status_approve);
        $get_queryform = $this->mmhr->query_emp_status($get_formid);
        $this->session->set_flashdata('flash_msg',"Success for approve memorandum");
        //print_r($get_queryform->result()); die;

        //echo $this->db->last_query(); die;
        //print_r($hr_update->result()); die;

        if ($get_queryform) {
          $subject = "Manager of HR";
          $body = "<a href='http://10.152.1.77/hr_test/index.php/memo_controller/report_mmhead_controller/index?subject=".$get_formid."'>link webpage memorandum no:.".$get_formid." </a>";
          $array_to = "sirithida_kanchan@gg.nitto.co.jp";
        //echo $position_sendmail; die;
          $this->sendEmail($subject,$body,$array_to, $array_cc = array(), $array_bcc = array()); //== ส่งเมลหา Hos
        }
        //echo $this->db->last_query(); die;
        $this->display("memo_view/success_view");
        //echo $form_id; die;
      }
    }
