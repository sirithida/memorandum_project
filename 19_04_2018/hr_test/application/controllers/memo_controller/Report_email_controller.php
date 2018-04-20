<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/memo_controller/Center.php');

class Report_email_controller extends Center {

     public function __construct(){
       parent::__construct();
       $this->login_center();
       $this->load->model("memo_model/report_email_model", "report_email");
     }

      public function index(){
          $query["id"]= $this->input->get('subject'); //get มาจาก URL
          $query["get_email"] = $this->input->get();
          //$query["email_form_id"]= $this->input->get('insert_id'); //get มาจาก URL
          $query["position_id"]= $this->input->get('position'); //get มาจาก URL
          //print_r($query["position_id"]); die;
          $query["app_id"]= $this->input->get('approve_id'); //get มาจาก URL
          $query["status"] = $this->input->post("status_approve");

          $query["subject_link"] = $this->report_email->query_formid($query["id"]);
          $query["subject"] = $this->report_email->query_subject_form($query["id"]);
          $query["mail_to"] = $this->report_email->email_to($query["id"]);
          $query["mail_cc"] = $this->report_email->email_cc($query["id"]);
          $query["personal_id"] = $this->report_email->query_other($query["id"]);
          $query["desc"] = $this->report_email->query_desc($query["id"]);
          $query["approve_name"] = $this->report_email->query_approve_name($query["id"],$query["position_id"]);
          $query["query_position"] = $this->report_email->query_approve_posit($query["id"],$query["position_id"]);
          $query["report"] = $this->report_email->report_all($query["id"]);
          //echo $this->db->last_query(); die;
          $query["status_approve"] = $this->report_email->approve_id($query["app_id"]);
          $query["form"] = $this->report_email->update_status_form($query["status"],$query["id"]);

          $query["status"] = array('1'=> "Waiting" ,'2' => "Approve", '3' => "Reject" );
          //  print_r($query["text_area"]->result()); die;
          $this->display("memo_view/report_email_view",$query);
      }

      public function update_status(){

        $status["form"] = $this->input->post("form_id");
        $status["personal"] = $this->input->post("approve_id");
        $status["status"] = $this->input->post("status_approve"); //
        $status["position"] = $this->input->post("position_id");
        $status["comment_approve"] = $this->input->post("comment");
        $status["time"] = $this->input->post('timestamp');
        //$this->input->get('')
        //$status["approve_id"] = $this->input->post('approve_id');
        $this->report_email->timestamp($status["time"],$status["form"]);
        //echo $status["approve"]; die;
        $subject = "";
        $body = "";
        $array_to = "sirithida_kanchan@gg.nitto.co.jp";

        //echo ($status["count_form"]->row()->count_approve); die;
        if ($status["form"]) { //
          $update_status = $this->report_email->update_status($status["form"],$status["status"],$status["personal"],$status["position"],$status["time"],$status["comment_approve"]);

          //print_r($update_status->result()); die;
          $this->session->set_flashdata('flash_msg',"Success for approve memorandum");

            $status["step_email"] = $this->report_email->step_email($status["form"]); //คนต่อไปที่จะส่งอีเมล ตามลำดับ
              //echo $this->db->last_query(); die;

              if($status["step_email"] != NULL){ // ถ้า Status[email] มีค่าเท่ากับ status limit 1 โดย order by ตามแถวก่อน
                foreach ($status["step_email"]->result() as $key => $value) {
                    $subject_form = $status["step_email"]->row()->position_name;
                    $position_sendmail = $status["step_email"]->row()->position_id;

                    $subject = "Report : ".$subject_form;
                    $body = "<a href='http://10.152.1.77/hr_test/index.php/memo_controller/report_email_controller/index?subject=".$status["form"]."&position=".$position_sendmail."'>link webpage memorandum no:.".$status["form"]."position=".$position_sendmail."</a>";
                  //echo $position_sendmail; die;
                    $this->sendEmail($subject,$body,$array_to, $array_cc = array(), $array_bcc = array()); //== ส่งเมลหา Hos
                  }

                }if($status["step_email"]){
                    $status["approve"] = $this->report_email->count_approve($status["form"]);

                    // มีค่า approve_status = 2 ให้เก็บค่า 1 == approve
                    $status["count_form"] = $this->report_email->count_form($status["form"]);
                    //echo $this->db->last_query(); die;
                    if($status["approve"]->num_rows() == $status["count_form"]->row()->count_approve){ // ถ้า จำนวนของคนที่ approve == จำนวนของฟอร์ม เท่ากัน
                        $this->report_email->update_status_form(1,$status["form"]); // ให้ไปอัพเดท

                        $status["status_form"] = $this->report_email->query_status_memo($status["form"]);
                        //echo $this->db->last_query(); die;

                        if ($status["status_form"]->row()->form_status == 1) {
                          //echo $status["status_form"]->row()->form_status; die;
                                $subject = "Report for HR";
                                $body = "<a href='http://10.152.1.77/hr_test/index.php/memo_controller/report_mmhr_controller/index?subject=".$status["form"]."'>HR link memorandum no:".$status["form"]."</a>";

                                $this->sendEmail($subject,$body,$array_to, $array_cc = array(), $array_bcc = array()); //== ส่งเมลไปหา HR
                        }
                    }else{
                        $this->report_email->update_status_form(0,$status["form"]); // noapprove
                     }
                $this->display("memo_view/success_view");
          }
        }
      }
    }

    /*  public function load_pdf(){
        $this->load->library('Pdf');
        $subject_id = $this->input->get('subject');
        $preview_report= $this->pdf_model->preview($subject_id);

        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('dejavusans', '', 10);

        // add a page
        $pdf->AddPage();
        $subtable = '<table border="1" cellspacing="1" cellpadding="1" align="right"></table>';

        $html = '</br>
        <center><h2>MEMORANDUM FORM </h2></center>
        <table border="1" cellspacing="2" cellpadding="3" style="width:80%" >

        <tr>
          <td>MEMO NO : '.$preview_report->row()->hr_memo_no.'</td>
          <td></td>

        </tr>

        <tr>
          <td>START OF DAY : '.$preview_report->row()->pic_start_datetime .' </td>
          <td>END OF DAY : '.$preview_report->row()->pic_start_datetime.'</td>
        </tr>

        <tr>
          <td>SUBJECT : '.$preview_report->row()->form_subject.'</td>
          <td>SECTION : '.$preview_report->row()->form_section .'</td>
        </tr>

        <tr>
          <td>FORM : '.$preview_report->row()->email_name.'</td>
          <td>TO : '.$preview_report->row()->email_address.'</td>
        </tr>

        <tr>
          <td>EMPLOYEE ID : '.$preview_report->row()->personal_id.'</td>
          <td></td>
        </tr>

        <tr>
          <td>NAME : '.$preview_report->row()->personal_name.'</td>
          <td>SURNAME : '.$preview_report->row()->personal_lastname.'</td>
        </tr>

        <tr>
          <td>DESCRIPTION : '.$preview_report->row()->from_detail.'</td>
          <th></th>
        </tr>

        </table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        // reset pointer to the last page
        $pdf->lastPage();


        //Close and output PDF document
        $pdf->Output('example_006.pdf', 'I');

        //============================================================+
        // END OF FILE
        //============================================================+
          }

          */
