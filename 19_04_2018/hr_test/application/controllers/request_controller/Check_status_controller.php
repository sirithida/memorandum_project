<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'controllers/memo_controller/Center.php');

class Check_status_controller extends Center {

      public function __construct(){
        parent::__construct();
        $this->login_center();
        $this->load->model("request_model/check_status_model","check_status");
        $this->load->model("memo_model/report_email_model","report_email");
        $this->load->model("memo_model/pdf_model","pdf_model");
      }

      public function index(){
        $status['form_id'] = $this->input->get('subject');
        //$status['memo_no'] = $this->input->get('hr_memo_no');

        $status["preview_pdf"] = $this->pdf_model->preview($status['form_id']);

        //echo print_r($status['preview_pdf']->result()); die;

        $status["query_memo"] = $this->check_status->query_data($status['form_id']);
        //echo $this->db->last_query(); die;

        //print_r($status['query_memo']->result()); die;

        $this->display("request_view/check_status_view",$status);
      }

        public function load_pdf(){
          $this->load->library('Pdf');

            $status['form_id'] = $this->input->get('subject');
            $pdf_preview = $this->pdf_model->preview($status['form_id']);

          // create new PDF document
          $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
          // ---------------------------------------------------------

          // set font
          $pdf->SetFont('dejavusans', '', 10);

          // add a page
          $pdf->AddPage();
          $subtable = '<table border="1" cellspacing="1" cellpadding="1" align="right"></table>';

          $html = "";
          foreach($pdf_preview->result() as $key => $value):
            $html .=
            '<table class="table table-bordered" style="width:90%" align="center">
              <thead>
                <tbody>
                      <h> พนักงานคนที่++'.($key+1).'</h>
                <tr>
                  <td>MEMO NO : '.$value->hr_memo_no .'</td>
                  <td></td>
                </tr>

                <tr>
                  <td>START OF DAY : '.$value->pic_start_datetime.' </td>
                  <td>END OF DAY : '.$value->pic_start_datetime.'</td>
                </tr>

                <tr>
                  <td>SUBJECT : '.$value->form_subject.'</td>
                  <td>SECTION : '.$value->form_section.'</td>
                </tr>

                <tr>
                  <td>FORM : '.$value->email_name.'</td>
                  <td>TO : '.$value->email_address.'</td>
                </tr>

                <tr>
                  <td>EMPLOYEE ID : '.$value->personal_id.'</td>
                  <td></td>
                </tr>

                <tr>
                  <td>NAME : '.$value->personal_name.'</td>
                  <td>SURNAME : '.$value->personal_lastname.'</td>
                </tr>

                <tr>
                  <td>DESCRIPTION : '.$value->from_detail.'</td>
                  <th></th>
                </tr>
                </tbody>
              </thead>

            </table>';
          endforeach;

          $pdf->writeHTML($html, true, false, true, false, '');

          // reset pointer to the last page
          $pdf->lastPage();


          //Close and output PDF document
          $pdf->Output('example_006.pdf', 'I');

          //============================================================+
          // END OF FILE
          //============================================================+
          }

}
