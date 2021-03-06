<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class approve_status_controller extends CI_Controller {

     public function __construct(){
       parent::__construct();
       $this->load->model("memo_model/approve_status_model", "approve");
     }

      public function display($v_mainpage, $data_page=NULL){
       $data["v_footer"] = $this->load->view("templete/v_footer", "", TRUE);
       $data["v_menubar"] = $this->load->view("templete/v_menubar", "", TRUE);
       $data["v_header"] = $this->load->view("templete/v_header", "", TRUE);

       $data["v_mainpage"] = $this->load->view($v_mainpage, $data_page, TRUE);

       $this->load->view("templete/v_layout", $data);
     }

      public function index(){
        $query['progress'] = $this->approve->query_progress();
        
        $this->display("memo_view/approve_status_view",$query);
      }

    }
