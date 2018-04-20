<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/memo_controller/Center.php');

class Check_ns_controller extends Center {

      public function __construct(){
        parent::__construct();
        $this->login_center();
        $this->load->model("request_model/Check_ns_model","night");
        $this->load->model("memo_model/night_shift_model","ns");
      }

      public function index(){

        $nightshift["form_id"] = $this->input->get('id'); //ได้ค่า form_id

        $nightshift["search"] = $this->night->data_nightshift($nightshift["form_id"]); //

        $nightshift["status_night"] = $this->night->data_nightshift(); //

        $nightshift["report"] = $this->night->ns_report($nightshift["form_id"]); //
        //print_r($nightshift["report"]->result()); die;

        $nightshift["hos_app"] = $this->ns->hos_approve(); //

        $nightshift["status"] = $this->night->status(); //

        //echo $this->db->last_query(); die;

        $this->display("request_view/Check_ns_view",$nightshift);
      }


  }
