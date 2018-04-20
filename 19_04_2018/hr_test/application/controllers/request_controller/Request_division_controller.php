<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/memo_controller/Center.php');

class Request_division_controller extends Center {
  public $table_divis;

     public function __construct(){
       parent::__construct();
       $this->login_center();
       $this->load->model("request_model/request_division_model","divis");

     }

     public function index(){
       $query["data_table"]  = $this->divis->query_datatable();

       $this->display("request_view/request_division_view",$query);
     }

     public function insert_divis(){
       $div_id = $this->input->post("div_id");
       $div_name = $this->input->post("div_name");

       if ($div_id) {
         $this->divis->update_divis($div_id,$div_name);
       }else {
         $this->divis->insert_divis($div_name);
       }
       redirect("request_controller/request_division_controller");
     }

     public function del_divis(){
        $c_del_divis = $this->input->get("v_divis_id");
        $this->divis->soft_delete($c_del_divis);

        redirect("request_controller/request_division_controller");
     }

     public function update_divis(){
        // ได้มาจาก ปุ่ม EDIT ที่ page view
        $query["udp_divis_id"] = $this->input->get("v_update_divis");
        // รับตัวแปรไปหน้า Model ฟังก์ชั่น select_depart (พารามิเตอร์ 1 ตัว)
        $query["row_edit"] = $this->divis->select_divis($query["udp_divis_id"]);

        $query["data_table"]  = $this->divis->query_datatable();

        $this->display("request_view/request_division_view",$query);
     }

}
?>
