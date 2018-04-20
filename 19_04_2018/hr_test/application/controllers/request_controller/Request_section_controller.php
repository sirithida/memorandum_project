<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/memo_controller/Center.php');

class Request_section_controller extends Center {

     public function __construct(){
       parent::__construct();
       $this->login_center();
       $this->load->model("request_model/request_section_model","sec");
     }

     public function display2($v_mainpage, $data_page=NULL){
       $data["v_footer"] = $this->load->view("templete/v_footer", "", TRUE);
       $data["v_menubar"] = $this->load->view("templete/v_menubar", "", TRUE);
       $data["v_header"] = $this->load->view("templete/v_header", "", TRUE);

       $data["v_mainpage"] = $this->load->view($v_mainpage, $data_page, TRUE);

       $this->load->view("templete/v_layout", $data);
     }

     //query data generate to request_view by $query nickname "gen_sec"
     public function index(){
       //echo form_open_multipart("request_controller/request_section_controller/insert_sec", array("id"=>"form_input" ,"class"=>"form-horizontal form-label-left")); die;

       $query["gen_sec"] = $this->sec->gen_query();

       $query["data_table"]  = $this->sec->query_datatable();

       $this->display("request_view/request_section_view",$query);
     }

     public function insert_sec(){
       /*	Input all value from html form (v_users)	*/
       $depart_part = $this->input->post("depart_part");
       $sec_id = $this->input->post("sec_id");
       $sec_name = $this->input->post("sec_name");
       $hidden_tb =  $this->input->post("hidden_tb");

       if ($hidden_tb) {
         $this->sec->update_sec($sec_id,$sec_name,$depart_part);
       }else {
         $this->sec->insert_section($sec_id,$sec_name,$depart_part);
       }
      redirect("request_controller/request_section_controller");
     }

     public function del_sec(){
      $c_del_sec = $this->input->get("v_sec_id");
      $this->sec->soft_delete($c_del_sec);

      redirect("request_controller/request_section_controller");
     }

    public function update_sec(){

    $query["update_sec"] = $this->input->get("v_update_sec");
    $query["row_edit"] = $this->sec->select_sec($query["update_sec"]);
    //echo $this->db->last_query(); die;
    $query["data_table"] = $this->sec->query_datatable();
    $query["gen_sec"] = $this->sec->gen_query();
    $this->display("request_view/request_section_view",$query);

  }
}
?>
