<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/memo_controller/Center.php');

class Report_nshr_controller extends Center {

     public function __construct(){
       parent::__construct();
       $this->login_center();
       //$this->load->model("memo_model/night_shift_model", "ns_model");
       $this->load->model("memo_model/Report_nightshift_model", "report_night");
       $this->load->model("memo_model/Report_nshr_model", "hr_read");


     }

      public function index(){
        $report_hrread["nightshift_id"] = $this->input->get('subject');
        //รับค่าที่รับเข้ามาจากหน้า List
        $report_hrread["approve_hos"] = $this->report_night->hos_approve();

        $report_hrread["hr_read"] = $this->hr_read->hr_receive();

        $report_hrread["nightshift"] = $this->report_night->query_nightshift($report_hrread["nightshift_id"]);

        $report_hrread["status"] = array('1'=> "Waiting" ,'2' => "Recieve");


        //print_r($nightshift["nightshift"]->result()); die;

        $this->display("memo_view/report_nshr_view",$report_hrread);
      }

      public function update_approveid(){

        $tmp_nightshift["night_id"] = $this->input->post('id');

        $tmp_nightshift["status"] = $this->input->post("status_approve");
        //print_r($tmp_nightshift["status"]->result()); die;

        if($tmp_nightshift["night_id"]) {
          $this->report_night->update_night($tmp_nightshift["status"],$tmp_nightshift["night_id"]); //ถ้ามี Status เข้ามา ให้ไป Update status
        }

        $this->session->set_flashdata('flash_msg',"Thank you,success for approve nightshift form");
        $this->display("memo_view/success_nightshift_view", $tmp_nightshift);

        if ($this->session->set_flashdata) {
          $this->load->library('email');

          $config['useragent'] = 'memo_hr@gg.nitto.co.jp';
          $config['protocol'] = 'smtp';
          $config['smtp_host'] = '10.152.18.243';
          $config['smtp_port'] = '2525';
          $config['mailtype'] = 'html';

          $this->email->initialize($config);

          $sendmail_user = $this->input->post('night_user');
          $this->email->from($config['useragent'],'Nightshift_admin');
          $this->email->to('thawatchai.rawangpai@nitto.com"');
          $this->email->subject('Alert Nightshift form');
          $this->email->message("<a href='http://10.152.1.77/hr_test/index.php/memo_controller/repsort_nshr_controllter/index?subject'>link webpage</a>");

          //$this->email->send();
          redirect("memo_controller/Report_nshr_controller");
        }
        //redirect("memo_controller/report_nightshift_controller/index?subject=".$this->input->post('id'));
        //echo $this->db->last_query(); die;
      }
    }
