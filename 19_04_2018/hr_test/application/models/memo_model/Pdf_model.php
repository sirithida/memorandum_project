<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf_model extends CI_Model{

   function __construct(){
      $this->table_division = "hr_form";
      $this->table_depart = "hr_personal";
      $this->table_secid ="hr_subject";
   }

   public function user_request($form_id){
     $this->db->select('*');
     $this->db->from('hr_form');
     $this->db->join('hr_approve_form','hr_approve_form.form_id = hr_form.form_id','left');
     $this->db->join('hr_personal','hr_personal.personal_id = hr_approve_form.personal_id','left');
     //$this->db->join('hr_email_from','hr_form_personal_detail.form_id = hr_email_from.form_id','left');
     $this->db->where('hr_form.form_id',$form_id);

     $preview_pdf = $this->db->get();
     //echo $this->db->last_query(); die;
     return $preview_pdf;
   }

   public function approve_pdf_status($form_id){

     $this->db->select('*');
     $this->db->from('hr_approve_form');
     $this->db->join('hr_personal','hr_approve_form.personal_id = hr_personal.personal_id','left');
     $this->db->join('hr_position','hr_approve_form.position_id = hr_position.position_id','left');
     $this->db->where('hr_approve_form.form_id',$form_id);
     $this->db->order_by('app_form_id');

     $approve_status_pdf = $this->db->get();

     //echo $this->db->last_query(); die;
     return $approve_status_pdf;
   }


   public function attach_file($form_id){
     $this->db->select('*');
     $this->db->from('hr_form');
     $this->db->where('form_id',$form_id);

     $attach_file = $this->db->get();
     return $attach_file;
   }

   public function query_hrsection(){
     $this->db->select('*');
     $this->db->from('hr_division');
     $this->db->join('hr_department','hr_division.div_id = hr_department.div_id','left');
     $this->db->join('hr_section','hr_department.depart_id = hr_section.depart_id');
     $this->db->where('hr_section.sec_id','050');

     $hr_sectionreort = $this->db->get();
     return $hr_sectionreort;
   }

   public function request_transport($form_id){
     $this->db->select('*');
     $this->db->from('hr_form_personal_detail');
     $this->db->join('hr_personal','hr_personal.personal_id = hr_form_personal_detail.personal_id','left');
     $this->db->where('hr_form_personal_detail.form_id',$form_id);

     $request_bus = $this->db->get();
     return $request_bus;

   }
}
