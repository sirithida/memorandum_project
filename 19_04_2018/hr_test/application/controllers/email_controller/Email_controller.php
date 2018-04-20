<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_controller extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model("email_model/email_model","email");
  }

  public function display($v_mainpage, $data_page=NULL){
    $data_sec = array(
      "v_footer"=> $this->load->view("templete/v_footer", "", TRUE),
      "v_menubar"=> $this->load->view("templete/v_menubar", "", TRUE),
      "v_header"=> $this->load->view("templete/v_header", "", TRUE),
      "v_mainpage" => $this->load->view($v_mainpage, $data_page, TRUE),
    );
    $this->load->view("templete/v_layout", $data_sec);
  }

  public function index(){

  $this->display("email_view/email_view");
  }
}
