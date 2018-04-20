<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/memo_controller/Center.php');

class Request_dataform_controller extends Center {

      public function __construct(){
        parent::__construct();
        $this->login_center();
        $this->load->model("request_model/request_dataform_model","type");
      }

      public function index(){
        $query_typetable["datatable"] = $this->type->query_datatable();
      //  print_r($query_subtable);
        $this->display("request_view/request_dataform_view",$query_typetable);
      }

      public function insert_type(){

          $type_name = $this->input->post("new_type");

          $type_id = $this->input->post("test_type");

          if($type_id) {
            $this->type->upd_type($type_id,$type_name);
          }else{
            $this->type->insert_newtype($type_name);
          }

          redirect("request_controller/request_dataform_controller");
      }

      public function del_type(){
        //echo $aaa."-".$bbb;
       $del_typeform = $this->input->get("v_btn_del");
       $this->type->soft_delete($del_typeform);
       //echo $del_subject; die;
       redirect("request_controller/request_dataform_controller");
     }

      public function update_type(){
        $update_type["update_id"] = $this->input->get("v_update_sub");

        $update_type["row_edit"] = $this->type->query_typeform($update_type["update_id"]);

        $update_type["datatable"]  = $this->type->query_datatable();

        $this->display("request_view/request_dataform_view",$update_type);
      }
}
