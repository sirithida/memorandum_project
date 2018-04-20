<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/tcpdf/tcpdf_autoconfig.php');

class Pdf_controller extends CI_Controller {

     public function __construct(){
       parent::__construct();

       $this->load->model("memo_model/pdf_model","pdf");

     }

      public function index(){
        $memo_pdf["form_id"] = $this->input->get('subject'); //get มาจาก URL
        //print_r($memo_pdf["form_id"]); die;

        $memo_pdf["hrsection_report"] = $this->pdf->query_hrsection($memo_pdf["form_id"]);
        //print_r($memo_pdf["hrsection_report"]->result()); die;
        //echo $this->db->last_query(); die;

        $memo_pdf["report_preview"] = $this->pdf->user_request($memo_pdf["form_id"]);

        $memo_pdf["bus"] = $this->pdf->request_transport($memo_pdf["form_id"]);

        //print_r($memo_pdf["report_preview"]->result()); die;
        //echo $this->db->last_query(); die;

        $memo_pdf["pdf_approve"] = $this->pdf->approve_pdf_status($memo_pdf["form_id"]);
        //echo $this->db->last_query(); die;
        //print_r($memo_pdf["pdf_approve"]); die;

        $this->load->view("memo_view/pdf_view",$memo_pdf);

      }
    }
