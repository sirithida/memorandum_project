<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/memo_controller/Center.php');

class Night_shift_controller extends Center {

      public function __construct(){
        parent::__construct();
        $this->login_center();
        $this->load->model("memo_model/night_shift_model","night");
      }

      public function index(){

        //$nightshift["subject_id"] = $this->input->get('id');

        $nightshift["sec_select"] = $this->night->section_selector();
        //print_r($nightshift["sec_select"]->row()); die;
        $nightshift["hos_apr"] = $this->night->hos_approve();
        //print_r ($nightshift["hos_apr"]->result()); die;
        $nightshift["night_no"] = $this->night->nightshift_no();
        //print_r ($nightshift["night_no"]->result()); die;
        $nightshift["email_from"] = $this->night->personal_search();

        $this->display("memo_view/night_shift_view",$nightshift);
      }

      public function insert_nightform(){

        $start_day = $this->input->post('start');
        $night_end = $this->input->post('end');
        $section = $this->input->post('night_sec');
        $operation = $this->input->post('night_operate');
        $personal_id = $this->input->post('night_personal');
        $username = $this->input->post('night_user');
        $lastname = $this->input->post('night_lastname');
        $bus = $this->input->post('bus');
        $date_approve = $this->input->post('date_approve');
        //$approve_sec = $this->input->post('apr_hos');
        //$aprrove_hr = "K.Kittitnun";
        $night_no = $this->input->post('ns_no');
        $text_area = $this->input->post('night_textarea');
        $approve_hos = $this->input->post('apr_hos');

        //$this->night->form_nightshift($start_day,$night_end,$section,$operation,$bus,$night_no,$date_approve,$text_area);

        //echo $personal_id[0]." ".$username[0]." ".$lastname[0]; die;
        foreach ($personal_id as $key => $value) {
          $nightshift_loop = $personal_id[$key]." ".$username[$key]." ".$lastname[$key]."</br>";

          $this->night->form_nightshift($start_day,$night_end,$section,$operation,$personal_id[$key],$bus,$username[$key],$lastname[$key],
          $approve_hos,$night_no,$date_approve,$text_area);
        }

        redirect("memo_controller/Night_shift_controller/sendmail_nightshift");
      }

      //sendemail
      public function sendmail_nightshift(){

        $this->load->library('email');

        $config['useragent'] = 'memo_hr@gg.nitto.co.jp';
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = '10.152.18.243';
        $config['smtp_port'] = '2525';
        $config['mailtype'] = 'html';

        $this->email->initialize($config);

        $sendmail_user = $this->input->post('night_user');
        $this->email->from($config['useragent'],'Nightshift_admin');
        $this->email->to('sirithida.kanchan@nitto.com');
        $this->email->subject('Nightshift form');
        $this->email->message("<a href='http://10.152.1.77/hr_test/index.php/memo_controller/report_nightshift_controller/index?subject=1'>link webpage</a>");

        $this->email->send();
        redirect("memo_controller/night_shift_controller");

      }
    }
