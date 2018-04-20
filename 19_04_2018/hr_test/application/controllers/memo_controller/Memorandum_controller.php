<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/memo_controller/Center.php');

class Memorandum_controller extends Center {

     public function __construct(){
       parent::__construct();
       $this->login_center();
       $this->load->model("memo_model/memorandum_model", "memo_m");
     }
       /* Setting Config Upload file */

      public function index(){
          $this->session->email;
          $this->session->sec_id; //เรียก session มาจากหน้า Form_controller

          $email_to["subject_id"]= $this->input->get('subject');
          //$email_to["get_from_id"] = $this->memo_m->get_id($email_to["subject_id"]);
          //$email_to["email"]= $this->memo_m->query_email();
          $email_to["email_cc"] = $this->memo_m->query_emailcc();
          $email_to["supervisor"] = $this->memo_m->approve_query();

          $email_to["hos"] = $this->memo_m->approve_hos();
          //echo $this->db->last_query(); die;
          $email_to["hod"] = $this->memo_m->approve_hod();
          $email_to["sec_memo"] = $this->memo_m->section_memo();
          //$email_to["typeform"] = $this->memo_m->typeform();
          $email_to["flow"] = $this->memo_m->query_flow();
          //echo $this->db->last_query(); die;
          $email_to["memo_no"] = $this->memo_m->meme_no();


        //  $this->load->view('upload_form', array('error' => ' ' ));
          $this->display("memo_view/memorandum_view",$email_to);
      }

      public function insert_form(){
          //ข้อมูลในการส่งอีเมล รับค่ามาจากหน้า view
          $memo_no = $this->input->post("memo_no"); //ชื่อเอกสาร
      		$user_subject = $this->input->post("user_subject"); //ชื่อเรื่อง
          $user_to = $this->input->post("to_hr"); //ชื่อเมล ส่งถึงใคร
          $user_create = $this->input->post("create_by"); //ใครเป็นคนสร้าง
          $user_cc = $this->input->post("user_cc"); //เอกสารลับถึงใคร
          $user_detail = $this->input->post("user_detail"); //รายละเอียด

          //ข้อมูลของคน รับค่ามาจากหน้า view
          $user_id = $this->input->post("user_id"); // รหัสพนักงาน
          $user_name = $this->input->post("user_name"); //ชื่อพนักงาน
          $user_surname = $this->input->post("user_surname"); //นามสกุลพนักงาน
          $sec_memo = $this->input->post("section_memo"); // แผนก
          $bus = $this->input->post("bus");
          //print_r($bus); die;

          //รายละเอียดเพิ่มเติม รับค่ามาจากหน้า view
          $user_comment = $this->input->post("comment"); //ข้อคิดเห็น
          $type_form = $this->input->post("type_form"); //หมวด
          $user_from = $this->input->post("user_from"); //จากใคร

          //วันที่กรอกข้อมูล รับค่ามาจากหน้า view
          $person_start_date = $this->input->post("date_start");
          $person_end_date = $this->input->post("date_end");
          //print_r($person_start_date); die;

          //เวลา
          $start_time = $this->input->post("time_start");
          $start_end = $this->input->post("time_end");
          $time_currentformat = $this->input->post('timestamp');
              //echo $time_currentformat; die;

          //ตั้งค่าการอัพโหลดไฟล์
          $config['upload_path'] = './directory_file/';
          $config['allowed_types'] = '*';
          $config['max_size'] = 0;

          $attach_file =   $this->input->post("upload_file");
          $this->load->library('upload', $config);

          if ( ! $this->upload->do_upload('upload_file')){
                  $error = array('error' => $this->upload->display_errors());
          }
          else{
                  $attach_file = $this->upload->data();
                  //print_r($data); die;
                  echo $attach_file['file_name'];
          }
          //------------------------------------------------------------------------------------------------------------//
          // Insert ข้อมูลที่ถูกโพสมา ไปเก็บในฟังก์ชั่นต่างๆ

            $insert_id = $this->memo_m->insert_form($memo_no,$user_subject,$time_currentformat,$type_form,$attach_file,$sec_memo,$this->session->username);

            $approve_wait = $this->memo_m->approve_form($insert_id);
            $bus_comment = $this->input->post('bus_comment');

            //echo $user_id[0]." ".$user_name[0]." ".$user_surname[0]." ".$user_comment[0]; die;\
            foreach ($user_id as $key => $value) {
            //$memo_personal = $user_id[$key]." ".$user_name[$key]." ".$user_surname[$key]." ".$user_comment[$key]." ".$bus[$key];
            //echo $key; die;
              $this->memo_m->insert_person($insert_id,$user_id[$key],$user_comment[$key],$bus[$key],$bus_comment[$key],$person_start_date[$key],$person_end_date[$key],$start_time[$key],$start_end[$key]);
            }
                  //false

              $supervisor = $this->input->post("super_approve"); //disable
              if ($supervisor) {
                $array_super= explode("|",$supervisor);
                $approve_sup = $this->memo_m->approve_sec(1,$array_super[1],$array_super[0],$insert_id,$this->session->username);
              }

              $hos = $this->input->post("hos_approve");
              if ($hos) {
                $array_hos= explode("|",$hos);
                $approve_hos = $this->memo_m->approve_sec(1,$array_hos[1],$array_hos[0],$insert_id,$this->session->username);
              }

              $hod = $this->input->post("hod_approve");
              if ($hod) {
                $array_hod= explode("|",$hod); // 3/602078/1 = position,personal,email
                $approve_hod = $this->memo_m->approve_sec(1,$array_hod[1],$array_hod[0],$insert_id,$this->session->username);
              }

              $position_form = $this->memo_m->step_email($insert_id);
              //print_r($position_form->result()); die;






            $array_cc = array();
            if (count($user_cc)) {
              //print_r($user_cc); die;
              foreach ($user_cc as $key => $value) {
                $email_cc = explode("|",$value);
                $email[0];
                $array_cc[] = $email_cc[1];
                $this->memo_m->insert_to($insert_id,$email_cc[1],'01',$email_cc[0],$key+1,$email_cc[2]);
                //print_r()."<br/>";
                //echo $email[0]."__".$email[1]."<br/>";
              }
            }
              //$query_flow = $this->memo_m->query_flow();
              //print_r($approve_wait->result); die;
              //ใช้ความสามารถของ Class Center function Sendemail
              $subject = "Memo : ".$position_form->row()->position_name;
              $body = "<a href='http://10.152.1.77/hr_test/index.php/memo_controller/report_email_controller/index?subject=".$insert_id."&position=1'>Create Memorandum link no:.".$insert_id.'&position='.$position_form->row()->position_id."</a>";
              $array_to = "sirithida_kanchan@gg.nitto.co.jp";

              $this->sendEmail($subject,$body,$array_to, $array_cc = array(), $array_bcc = array()); //== ส่งเมลไปหา HR

          		redirect("memo_controller/memorandum_controller");
      }


    /*  public function emailTmps(){
        $array_to[] = 'sirithida.kanchan@nitto.com';
        $subject = "";
        $message = "<a href='http://10.152.1.77/hr_test/index.php/memo_controller/report_email_controller/index?subject=1'> link webpage memorandum no: ".$insert_id."</a>";

		     $this->sendEmail($subject,$message,$array_to);
      } */

      public function hr_person(){
          $getterm = $this->input->get("term");
          $person_view = $this->memo_m->hr_personal($getterm); // person_view = obj
          $person= array(); // เก็บตัวแปร person = array
          foreach($person_view->result() as $num_rows => $row) { //นำมาวนลูปในรูปของอาเรย์
            $person[] = array( // person = array
                'id' => $row->personal_id, // กำหนดให้ id = $row->personal_id
                'value' => $row->personal_id, //กำหนดให้ value = $row->personal_name
                'username' => $row->personal_name,
                'surname' =>$row->personal_lastname,
            );
          }
          //print_r($person); die;
          echo json_encode($person);
        }

}
