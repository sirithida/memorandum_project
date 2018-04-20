<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check_status_model extends CI_Model{
    public $approve_form;

    function __construct(){
      $this->approve_form ="hr_approve_form";

    }

    public function query_data($meme_no){
      $this->db->select('*');
      $this->db->from('hr_form');
      $this->db->join('hr_approve_form','hr_form.form_id = hr_approve_form.form_id');
      $this->db->join('hr_position','hr_approve_form.position_id = hr_position.position_id','left');
      $this->db->join('hr_personal','hr_approve_form.personal_id = hr_personal.personal_id','left');
      //$this->db->where('hr_form.form_id','471');
      $this->db->order_by('hr_memo_no,hr_approve_form.position_id');
      $query_memo = $this->db->get();
      //echo $this->db->last_query(); die;
      return $query_memo;
    }

    public function query_memo(){
      $this->db->distinct('*');
      $this->db->select('hr_memo_no,start_datetime,end_datetime,form_section,create_by');
      $this->db->from('hr_form');

      $memo_data = $this->db->get();
      return $memo_data;
    }

}
