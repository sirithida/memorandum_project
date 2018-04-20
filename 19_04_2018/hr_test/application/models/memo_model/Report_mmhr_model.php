<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_mmhr_model extends CI_Model{

   function __construct(){

   }

   public function hr_selector(){
     $this->db->select('*');
     $this->db->from('hr_personal');
     $this->db->where('personal_id','551010');
     $this->db->or_where('personal_id','602078');

     $hr_name = $this->db->get();
     //echo $this->db->last_query(); die ;
     return $hr_name;
   }


   public function update_status_hrrecieve($form_id,$status){
     $update_recieve = array(
       'hr_emp_status' => $status,
      );
      $this->db->where('form_id',$form_id);
      $this->db->update('hr_form', $update_recieve);

      //echo $this->db->last_query();  die;
   }

   public function reportforhr($subject_id){
     $this->db->select('*');
     $this->db->from('hr_form');
     $this->db->join('hr_form_personal_detail','hr_form.form_id = hr_form_personal_detail.form_id','left');
     $this->db->join('hr_personal','hr_form_personal_detail.personal_id = hr_personal.personal_id','left');
     //$this->db->join('hr_email_from','hr_form_personal_detail.form_id = hr_email_from.form_id','left');
     $this->db->where('hr_form.form_id',$subject_id);

     $preview_pdf = $this->db->get();
     //echo $this->db->last_query(); die;
     return $preview_pdf;
   }


   public function query_form($form_id){
     $this->db->select('*');
     $this->db->from('hr_form');
     $this->db->where('form_id',$form_id);

     $query = $this->db->get();
     //echo $this->db->last_query(); die;
     return $query;
	 }

   public function query_emp_status($form_id){
     $this->db->select('*');
     $this->db->from('hr_form');
     $this->db->where('form_id',$form_id);
     $this->db->where('hr_emp_status','01');

     $get_status_hr = $this->db->get();
     //echo $this->db->last_query(); die;
     return $get_status_hr;
   }
}
