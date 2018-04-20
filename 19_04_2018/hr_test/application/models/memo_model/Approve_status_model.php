<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class approve_status_model extends CI_Model{
   public $table_hrform;
   public $table_hrperson;
   public $table_email;
   public $table_approve;
   public $table_subject;

   function __construct(){
     $this->table_hrform = "hr_form";
     $this->table_hrperson = "hr_form_personal_detail";
     $this->table_email = "hr_email_form";
     $this->table_approve = "hr_approve_form";
     $this->table_subject = "hr_subject";
   }

   public function insert_from($user_subject,$user_to,$user_form,$user_cc,$user_detail){
     $data_form = array(
       'form_subject' => $user_subject,
       'email_from' => $user_form,
       'from_detail' => $user_detail,
     );
     $this->db->insert($this->table_hrform,$data_form);
     return $this->db->insert_id();
   }

   public function insert_email(){
     $data_email = array(
       'email_address' => $user_to,
       'email_address' => $user_cc,
     );
     $this->db->insert();
     return $this->db->insert_email();
   }

   public function insert_emailcc(){
     $data_email = array(
       'email_address' => $user_cc,
     );
     $this->db->insert();
     return $this->db->insert_emailcc();
   }

   public function insert_person($insert_id,$user_id,$user_start_time
   ,$user_end_time,$user_start_day,$user_end_day,$user_comment){
     $data_person = array(
       'form_id' => $insert_id,
       'personal_id' => $user_id,
       'pic_start_time' => $user_start_time,
       'pic_end_time' => $user_end_time,
       'pic_start_day' => $user_start_day,
       'pic_end_day' =>$user_end_day,
       'pic_job_desc' => $user_comment,
     );
       $this->db->insert($this->table_hrperson,$data_person);
   }

   public function approve_sec($status,$personal_id,$position_id,
                               $form_id, $create_by){
     $approve_sec = array(
       'app_form_status' => $status,
       'personal_id' => $personal_id,
       'position_id' => $position_id,
       'form_id' => $form_id,
       'create_by' => $create_by
     );
       $this->db->insert($this->table_approve,$approve_sec);

   }

   public function approve_query(){
     $this->db->select('*');
     $this->db->from('hr_personal');
     $this->db->join('hr_approve_flow', 'hr_personal.personal_id = hr_approve_flow.personal_id');
     $this->db->where('hr_approve_flow.position_id', 1);
     $this->db->where('hr_approve_flow.sec_id', $this->session->sec_id);
     $approve_query = $this->db->get();
     return $approve_query;
   }

   public function approve_hos(){
     $this->db->select('*');
     $this->db->from('hr_personal');
     $this->db->join('hr_approve_flow', 'hr_personal.personal_id = hr_approve_flow.personal_id');
     $this->db->where('hr_approve_flow.position_id', 2);
     $this->db->where('hr_approve_flow.sec_id',$this->session->sec_id );
     $approve_query = $this->db->get();
     return $approve_query;
   }

   public function approve_hod(){
     $this->db->select('*');
     $this->db->from('hr_personal');
     $this->db->join('hr_approve_flow', 'hr_personal.personal_id = hr_approve_flow.personal_id');
     $this->db->where('hr_approve_flow.position_id', 3);
     $this->db->where('hr_approve_flow.sec_id', $this->session->sec_id);
     $approve_query = $this->db->get();
     return $approve_query;
   }

   public function query_email(){
     $this->db->select('personal_name, personal_email'); //select to email

     $this->db->not_like('personal_email', $this->session->sec_id);  // WHERE `title` NOT LIKE '%match% ESCAPE '!'

     $query = $this->db->get('hr_personal');

     return $query;
   }

   public function query_subject(){
     $this->db->select('*');
     $this->db->from('hr_subject');

     $subject_name = $this->db->get();
     return $subject_name;
   }

  public function query_progress(){
      $this->db->select('*');
      $this->db->from('hr_approve_form');

      $query_progress = $this->db->get();
      return $query_progress;
  }

  
}
