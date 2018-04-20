<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/memo_controller/Center.php');

class Request_depart_controller extends Center {

      public function __construct(){
        parent::__construct();
        $this->login_center();
        $this->load->model("request_model/request_depart_model","dep");
      }

      public function index(){
        $query["gen_dep"] = $this->dep->gendep_query();

        $query["data_table"]  = $this->dep->query_datatable();

        $this->display("request_view/request_depart_view",$query);
      }

      public function insert_dep(){

        $depart_name = $this->input->post("depart_name");
        $div_id = $this->input->post("division_part");
        $depart_id = $this->input->post("depart_id");
         //<--อากิวเม้น
        //($depart_name,$div_id); <--------- ลำดับของพารามิเตอร์
        //เช่น รับ 2 ตัว controller function ก็ต้องส่งพารามิเจอร์ 2 ที่

        if($depart_id){
          $this->dep->update_depart($depart_id,$div_id,$depart_name);
        }else{
          $this->dep->insert_depart($depart_name,$div_id);
        }
        redirect("request_controller/request_depart_controller");
      }

      public function del_depart(){
       $c_del_depart = $this->input->get("v_depart_id");

       try{
         $this->dep->del_depart($c_del_depart);
       }catch(Exception $e){
         echo $e->getMessage();
       }


       redirect("request_controller/request_depart_controller");
     }

      public function update_depart(){
        // ได้มาจาก ปุ่ม EDIT ที่ page view
        $query["udp_depart_id"] = $this->input->get("v_update_depart");
        // รับตัวแปรไปหน้า Model ฟังก์ชั่น select_depart (พารามิเตอร์ 1 ตัว)
        $query["row_edit"] = $this->dep->select_depart($query["udp_depart_id"]);

        $query["gen_dep"] = $this->dep->gendep_query();

        $query["data_table"]  = $this->dep->query_datatable();

        $this->display("request_view/request_depart_view",$query);
      }

}
