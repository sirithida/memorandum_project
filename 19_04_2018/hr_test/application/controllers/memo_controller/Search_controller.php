<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_controller extends CI_Controller {

     public function __construct(){
       parent::__construct();
       $this->load->model("memo_model/search_model", "search");
     }

      public function display($v_mainpage, $data_page=NULL){
       $data["v_footer"] = $this->load->view("templete/v_footer", "", TRUE);
       $data["v_menubar"] = $this->load->view("templete/v_menubar", "", TRUE);
       $data["v_header"] = $this->load->view("templete/v_header", "", TRUE);

       $data["v_mainpage"] = $this->load->view($v_mainpage, $data_page, TRUE);

       $this->load->view("templete/v_layout", $data);
     }

      public function index(){

          $this->display("memo_view/search_view");
      }



    }
