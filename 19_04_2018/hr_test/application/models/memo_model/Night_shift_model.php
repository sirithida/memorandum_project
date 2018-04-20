<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Night_shift_model extends CI_Model{

   function __construct(){
     $this->night = "hr_nightshift";
   }

   public function section_selector(){
     //$selector = $this->db->get_where('hr_section',array('upd_sec'=>'00'));
     $this->db->select('*');
     $this->db->from('hr_section');
     $this->db->where('upd_sec','00');
     $this->db->where('sec_id',$this->session->sec_id);

     $selector  = $this->db->get();
     return $selector;
   }

  public function form_nightshift($night_start,$night_end,$night_section,$night_operate,$night_personalid,$night_car,
  $night_user,$night_lastname,$night_approve_hos,$night_no,$date_approval,$text_area){

      $nightshift_form = array(
        'night_start' => $night_start,
        'night_end' => $night_end,
        'night_sec' => $night_section,
        'night_operate' => $night_operate,
        'night_personal' => $night_personalid,
        'night_car' => $night_car,
        'night_user' => $night_user,
        'night_lastname' => $night_lastname,
        'night_approve_sec' => $night_approve_hos,
        //'night_approve_hr' => $night_approve_hr,
        'night_no' => $night_no,
        'date_approve' => $date_approval,
        'night_comment' => $text_area,
    );

        $this->db->insert($this->night,$nightshift_form);
    }


    public function hos_approve(){
      $this->db->select('*');
      $this->db->from('hr_approve_flow');
      $this->db->join('hr_position' ,'hr_position.position_id = hr_approve_flow.position_id');
      $this->db->join('hr_personal' ,'hr_approve_flow.personal_id = hr_personal.personal_id');
      $this->db->where('hr_approve_flow.sec_id',$this->session->sec_id);
      $this->db->where('hr_approve_flow.position_id','2');
      $hos_nightshift = $this->db->get();
      return $hos_nightshift;
    }

    public function nightshift_no(){
      $this->db->select('get_nightshift_no()');
      $this->db->from('hr_night_seq');

      $nightshift_no = $this->db->get();
      return $nightshift_no;
    }

    public function personal_search(){
      $this->db->select('*');
      $this->db->from('hr_nightshift');
      $this->db->join('hr_personal','hr_nightshift.night_personal = hr_personal.personal_id');

      $email_form = $this->db->get();
      return $email_form;
    }

    public function search_id($personal_id){
      $search_tbox = $this->db->get_where('hr_personal', array('personal_id'));
      return $search_tbox;
    }

    public function group_section($emp_id){
      $this->db->select('*');
      $this->db->from('hr_pic_center');
      $this->db->join('hr_ns_group','hr_pic_center.pic_personal_id = hr_ns_group.group_emp_id','left');
      $this->db->where('hr_pic_center.pic_personal_id',$emp_id);

      $group = $this->db->get();
      return $group;
    }
}
