<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Center extends CI_Controller {


     public function __construct(){
      parent::__construct();
        //$this->load->model("meo_model/memorandum_model", "memo_m");

         $this->load->model("memo_model/list_approve_model","list");
         $this->load->model("memo_model/memorandum_model","memo_model");
     }

     public function display($v_mainpage, $data_page=NULL){
      $data["v_footer"] = $this->load->view("templete/v_footer", "", TRUE);
      $data["v_menubar"] = $this->load->view("templete/v_menubar", "", TRUE);
      //echo $this->db->last_query(); die;

      $link["id"] = $this->input->get('subject');
      $link["link"] = $this->list->union_query();

      $link["memo_list"] = $this->list->count_memo(); //=3
      //echo $this->db->last_query(); die;
      //echo print_r($link["memo_list"]); die;
      $link["sec_session"] = $this->memo_model->query_section();
      //echo $this->db->last_query(); die;

      $link["list_show"] = $this->list->list_approval($this->session->personal_id);

      //print_r($link["list_show"]); die;

      $data["v_header"] = $this->load->view("templete/v_header",$link, TRUE);
      $data["v_mainpage"] = $this->load->view($v_mainpage,$data_page, TRUE);
      $this->load->view("templete/v_layout",$data);
    }

    public function login_center(){
      $session = $this->session->userdata('loginuser');

        if(!$session){
          redirect('form_controller');
        }
    }

    public function change_sec(){
      //รับค่ามาจาก header จากการ เปลี่ยนแผนก และ เปลี่ยน ตำแหน่งของคน
      $sec_id = $this->input->get('sec_id');
      $sec_name = $this->input->get('sec_name');
      $position_id = $this->input->get('id_position');
      $position_name = $this->input->get('position_name');

      $this->session->sec_name = $sec_name;
      $this->session->position_name = $position_name;
      $this->session->sec_id = $sec_id;
      $this->session->position_id = $position_id;

      redirect('memo_controller/memorandum_controller',$link);
    }

    public function sendEmail($subject, $body,$array_to
                             , $array_cc = array(), $array_bcc = array()){

        $this->load->library('email');
        $config['useragent'] = 'memo_hr@gg.nitto.co.jp'; // กำหนดส่งจากอะไร เช่น ใช่ชื่อเว็บเรา
        $config['protocol'] = 'smtp';  // สามารถกำหนดเป็น mail , sendmail และ smtp
        $config['smtp_host'] = '10.152.18.243';
        $config['smtp_port'] = '2525';
          //$config['smtp_crypto'] = 'ssl'; // รูปแบบการเข้ารหัส กำหนดได้เป้น tls และ ssl
        $config['mailtype'] = 'html'; // กำหนดได้เป็น text หรือ html

        $this->email->initialize($config);

        $this->email->from($config['useragent'],'Memo_Admin'); //ส่งเมล form : MempAdmin
        $this->email->to($array_to);  //ถึง array_to

        if(count($array_cc)){         // ถ้า จำนวนนับของ array_cc มีจำนวนนับได้เท่าไร
          $this->email->cc($array_cc);  //ให้ส่งอีเมลตามจำนวน
        }

        $this->email->subject($subject);  //ชื่อเรื่อง
        $this->email->message($body);     //เนื้อหา
        //echo $subject; die;

        if(!$this->email->send()){    //ถ้า ไม่มีการถูกส่่งอีเมล
          throw new Exception($this->email->print_debugger());  //ให้ print_debugger ออกมา
          return FALSE;               // และรีเทิร์นเค่าเป็น FALSE
        }
        return TRUE;              //ถ้าไม่เข้า if ด้านบน ให้ return true
      }

}
