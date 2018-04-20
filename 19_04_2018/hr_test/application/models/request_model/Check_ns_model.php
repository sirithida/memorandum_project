<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check_ns_model extends CI_Model{
    public $approve_form;

    function __construct(){
      $this->approve_form ="hr_approve_form";
    }

    public function data_nightshift(){
      $this->db->select('*');
      $this->db->from('hr_nightshift');
      $this->db->join('hr_approve_flow','hr_nightshift.night_approve_sec = hr_approve_flow.personal_id','left');
      $this->db->join('hr_position','hr_position.position_id = hr_approve_flow.position_id','left');
      $this->db->join('hr_personal','hr_personal.personal_id = hr_approve_flow.personal_id','left');
      $this->db->join('hr_section','hr_section.sec_id = hr_nightshift.night_sec','left');
      $this->db->order_by('hr_nightshift.night_no,hr_position.position_id');

      //$this->db->where('night_no',"NS-00014");

      $search_data = $this->db->get();

      //echo $this->db->last_query(); die;
      return $search_data;
    }

    public function status(){
      $this->db->select('*');
      $this->db->from('hr_nightshift');
      $this->db->join('hr_personal','hr_nightshift.night_approve_sec = hr_personal.personal_id','left');

      $status = $this->db->get();
      //echo $this->db->last_query(); die;
      return $status;
    }

    public function ns_report(){
      $this->db->distinct();
      $this->db->select('night_no,night_start,night_end,night_sec','hr_section.sec_name');
      $this->db->from('hr_nightshift');
      $this->db->join('hr_section','hr_section.sec_id = hr_nightshift.night_sec');

      $night_report =  $this->db->get();
      //gooecho $this->db->last_query(); die;
      return $night_report;
    }

    public function insert_status($status){
      $status = array(
        'form_status' => $status,
      );
      $this->db->insert('hr_form', $status);
    }
}
