<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_email_model extends CI_Model{
  public $hr_form;

  public $hr_personal;
  public $hr_subject;
  public $hr_approve_form;

   function __construct(){
      $this->table_hrform = "hr_form";
      $this->table_person = "hr_personal";
      $this->table_subject ="hr_subject";
      $this->table_approve = "hr_approve_form";
   }

    public function query_subject($typeform_id){
    $query_subject = $this->db->get_where('hr_typeform',array('type_id' => $typeform_id));

    //$query_subject = $this->db->get('hr_subject');
    return $query_subject;
   }

//Subject
   public function query_subject_form($form_id){
    $this->db->select('*');
    $this->db->from('hr_form');
    $this->db->where('form_id',$form_id);

    $query_subject_form = $this->db->get();
    //echo $this->db->last_query(); die;
    return $query_subject_form;
   }

   public function update_status($update_id,$status,$personal_user,$position_id,$time_stamp,$approve_comment){
     $update_approve = array(
       'app_form_status'=> $status,
       'approve_time' => $time_stamp,
       'update_by' => $this->session->username,
       'app_form_remark' => $approve_comment,

     );
         $this->db->where('form_id',$update_id);
         $this->db->where('personal_id',$personal_user);
         $this->db->where('position_id',$position_id);
         $this->db->update($this->table_approve,$update_approve);

        // echo $this->db->last_query(); die;
    }

//position
  public function query_position($form_id){
      //$query_position = $this->db->get_where('hr_approve_form',array('form_id' => $form_id));
      //return $query_position;
      $this->db->select('*');
      $this->db->from('hr_approve_form');
      $this->db->join('hr_personal', 'hr_personal.personal_id = hr_approve_form.personal_id','left');
      $this->db->where('hr_approve_form.form_id',$form_id);
      $this->db->where('hr_approve_form.position_id',1);

      $query_position = $this->db->get();
      //echo $this->db->last_query(); die;
      return $query_position;
  }

    //typeform
    /*public function query_typeform($type_form){
      $typeform = $this->db->select('*');
      $typeform = $this->db->from('hr_typeform');
      $typeform = $this->db->join('hr_form','hr_form.type_form = hr_typeform.type_id','left');
      $typeform = $this->db->where('hr_form.form_id',$type_form);

      $typeform_query = $this->db->get();
      return $typeform_query;
    } */

//personal_id //firstname //lastname
  public function query_other($personal_id){
     $this->db->select('*');
     $this->db->from('hr_personal');
     $this->db->join('hr_approve_form', 'hr_personal.personal_id = hr_approve_form.personal_id','left');
     $this->db->where('hr_approve_form.form_id',$personal_id);

    $query_other = $this->db->get();
    return $query_other;
  }


  public function query_desc($desc){
     $this->db->select('*');
     $this->db->from('hr_form');
     $this->db->join('hr_approve_form', 'hr_form.form_id = hr_approve_form.form_id','left');
     $this->db->where('hr_form.form_id',$desc);

    $query_desc = $this->db->get();
    return $query_desc;
  }

  public function email_to($subject){
   $email_to = $this->db->select('*');
   $email_to = $this->db->from('hr_email_from');
   $email_to = $this->db->join('hr_personal','hr_email_from.email_name = hr_personal.personal_name','left');
   $email_to = $this->db->where('hr_email_from.email_type','00');
   $email_to = $this->db->where('hr_email_from.form_id',$subject);

   $query_to = $this->db->get();
   return $query_to;
  }

  public function email_cc($id){
   $email_to = $this->db->select('*');
   $email_to = $this->db->from('hr_email_from');
   $email_to = $this->db->join('hr_personal','hr_email_from.email_name = hr_personal.personal_name','left');
   $email_to = $this->db->where('hr_email_from.email_type','01');
   $email_to = $this->db->where('hr_email_from.form_id',$id);

   $query_to = $this->db->get();
   return $query_to;
  }

  public function sec_pdf(){
    $section_pdf = $this->db->get_where('hr_section',array('sec_id' => '032'));
    return $section_pdf;
  }

  public function query_formid($form_id){
    $this->db->select('*');
    $this->db->from('hr_form');
    $this->db->join('hr_approve_form','hr_approve_form.form_id = hr_form.form_id','left');
    $this->db->where('hr_approve_form.form_id',$form_id);
    $this->db->where('hr_approve_form.app_form_status','1');
    $query_joinsub = $this->db->get();
    //print_r($query_joinsub->result());die;
    return $query_joinsub;
   }

  public function query_approve_posit($form_id,$position_id){
   $this->db->select('*');
   $this->db->from('hr_approve_form');
   $this->db->join('hr_position','hr_approve_form.position_id = hr_position.position_id','left');
   $this->db->where('hr_approve_form.form_id',$form_id);
   $this->db->where('hr_position.position_id',$position_id);

   $query_position = $this->db->get();
   //echo $this->db->last_query(); die;
   return $query_position;
}

   public function query_approve_name($form_id,$position_id){

     $this->db->select('*');
     $this->db->from('hr_position');
     $this->db->join('hr_approve_form','hr_approve_form.position_id = hr_position.position_id','left');
     $this->db->join('hr_personal','hr_approve_form.personal_id = hr_personal.personal_id','left');
     $this->db->where('hr_approve_form.form_id',$form_id);
     $this->db->where('hr_position.position_id',$position_id);
     $query_approve_name = $this->db->get();
     //echo $this->db->last_query();
     return $query_approve_name;
   }

   public function report_all($subject_id){
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

   public function report_hrmemo_view(){
     $this->db->select('*');
     $this->db->from('hr_form');
     $this->db->where('hr_form',$form_id);

     $test = $this->input->get();
     return $test;
   }

   public function timestamp($t_timestamp,$form_id){
     $insert_time = array(
       'form_date' => $t_timestamp,
     );
     $this->db->where('form_id', $form_id);
     $this->db->update('hr_form', $insert_time);
   }

   public function approve_id($approve_id){
     $this->db->select('*');
     $this->db->from('hr_approve_form');
     $this->db->where('app_form_id',$approve_id);
     //$this->db->where('app_from_status',2)

     $approve = $this->db->get();
     //echo $this->db->last_query(); die;
     return $approve;
   }

  public function count_approve($form_id){
     $this->db->select('*');
     $this->db->from('hr_approve_form');
     $this->db->where('form_id',$form_id);
     $this->db->where('app_form_status','2');

     $count_status = $this->db->get();

     //echo $this->db->last_query(); die;
     return $count_status;
   }

 public function count_form($form_id){
   $query = $this->db->query(
     'select count(personal_id) as count_approve
        from hr_approve_form
        where form_id ='.$form_id);
  //$this->db->count_all('hr_approve_form');
    return $query;
 }

 public function update_status_form($status,$form_id){
   $update_status = array(
     'form_status'=> $status,

   );
       $this->db->where('form_id',$form_id);
       $this->db->update($this->table_hrform,$update_status);
       //echo $this->db->last_query(); die;

  }

    public function step_email($form_id){
      $this->db->select('*');
      $this->db->from('hr_approve_form');
      $this->db->join('hr_position','hr_position.position_id = hr_approve_form.position_id','left');
      $this->db->where('hr_approve_form.form_id',$form_id);
      $this->db->where('hr_approve_form.app_form_status','1');
      $this->db->order_by('hr_approve_form.app_form_id');
      $this->db->limit('1');

      $send_mail = $this->db->get();
      //echo $this->db->last_query(); die;
      return $send_mail;
    }

  public function query_status_memo($form_id){
      $this->db->select('*');
      $this->db->from('hr_form');
      $this->db->where('form_status','1');
      $this->db->where('form_id',$form_id);

      $query_status = $this->db->get();
      return $query_status;
  }
}
