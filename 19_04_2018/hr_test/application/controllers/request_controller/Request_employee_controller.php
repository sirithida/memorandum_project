<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/memo_controller/Center.php');

class Request_employee_controller extends Center {

     public function __construct(){
       parent::__construct();
       $this->login_center();
       $this->load->model("request_model/request_employee_model","emp");
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

       $query["position_select"] = $this->emp->position_selector();

       $query["section_select"] = $this->emp->section_selector();

       $query["employee"] = $this->emp->query_employee();
       //print_r(   $query["employee"]->result());die;
       $hello = "123";
       //secho "value = $hello" ; die;

       $this->display("request_view/request_employee_view",$query);
     }

     public function insert_emp(){
       /*	Input all value from html form (v_users)	*/
      
       $emp_id = $this->input->post("emp_id");
       $emp_name = $this->input->post("emp_name");
       $emp_lastname = $this->input->post("emp_lastname");

       $emp_sec_id = $this->input->post("emp_sec");
       $emp_position_id = $this->input->post("emp_position");

       $emp_email = $this->input->post("emp_email");
       $hidden_tb =  $this->input->post("update_emp_id");
       //echo $hidden_tb;

       if ($hidden_tb) {
         $this->emp->update_edit($emp_id,$emp_name,$emp_lastname,$emp_email,$hidden_tb); //ถูก
         //echo $this->db->last_query();
         //print_r($update_master); die;
         //echo $update_master; die;
          $this->emp->del_center($hidden_tb);
          //echo $this->db->last_query(); die;
          foreach ($emp_sec_id as $key => $value) {
             $sec_insert = $emp_sec_id[$key]." ".$emp_position_id[$key];
             $section_insert = explode("-",$sec_insert);
             $this->emp->insert_emp_center($emp_id,$emp_name,$emp_lastname,$section_insert[0],$section_insert[1]);
           }
           echo $this->db->last_query();
       }else {
         $this->emp->insert_employee($emp_id,$emp_name,$emp_lastname,$emp_email);

         foreach ($emp_sec_id as $key => $value) {
            $sec = $emp_sec_id[$key]." ".$emp_position_id[$key];
            $section_position = explode("-",$sec);
            //print_r (explode("     ",$section_position[0]));   die;
            $this->emp->insert_emp_center($emp_id,$emp_name,$emp_lastname,$section_position[0],$section_position[1]);
            //print_r (explode("     ",$emp_sec_id[$key]));   die;
         }
     }
       redirect("request_controller/request_employee_controller");
   }

     public function del_employee(){
      $soft_del = $this->input->get("emp_id");
      $this->emp->soft_delete($soft_del);

      redirect("request_controller/request_employee_controller");
     }


     public function update_employee(){

       $update_emp["update_emp_id"] = $this->input->get('update');

       $update_emp["row_edit"] = $this->emp->upd_update_emp($update_emp["update_emp_id"]);
       //print_r($update_emp["row_edit"]);

       $update_emp["position_select"] = $this->emp->position_selector();

       $update_emp["section_select"] = $this->emp->section_selector();

       $update_emp["employee"] = $this->emp->query_employee();

       $this->display("request_view/request_employee_view",$update_emp);
   }

}
?>
