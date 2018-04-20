<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_approve_model extends CI_Model{
  public $table_form;
  public $table_approve_form;

   function __construct(){
     $this->table_form = "hr_form";
     $this->table_approve_form = "hr_approve_form";
   }

   public function query_joinsub($form_id){
     $this->db->select('*');
     $this->db->from('hr_form');
     $this->db->join('hr_approve_form', 'hr_approve_form.form_id = hr_form.form_id','left');
     $this->db->where('hr_approve_form.personal_id', $this->session->personal_id);
     $this->db->where('hr_approve_form.app_form_status','1');

     $query_joinsub = $this->db->get();
     //echo $this->db->last_query(); die;
     return $query_joinsub;
    }

  //query_joinsub
  // จะทำการคิวรี่ในกรณีปกติเท่านั้น คือ check จาก hr_approve_form table ด้วยการไป where 2 ตัวคือ personal_id , app_from_status
  // โดย personal_id = จะได้แก่ $this->session->personal_id และ app_form_status = จะต้องเท่ากับ 1 เท่านั้น
 // ---------------------------------------------------------------------------------------------------------------//

    public function count_memo(){
      $memo_list = "";

      $memo_list = $this->db->query("SELECT count(hr_approve_form.app_form_status) as count_status
        FROM hr_form
        LEFT JOIN hr_approve_form ON hr_approve_form.form_id = hr_form.form_id
        WHERE hr_approve_form.personal_id ='".$this->session->personal_id."'".
        "AND hr_approve_form.app_form_status='1'");

      //echo $this->db->last_query(); die;
      return $memo_list;
    }

    //function count_memo
    // จะไปคิวรี่จำนวนนับของ hr_approve_form ใน coloumn : app_form_status
    //-----------------------------------------------------------------------------------------//

    public function query_formstatushr(){
      $this->db->select('*');
      $this->db->from('hr_form');
      //$this->db->join('hr_approve_form','hr_form.form_id = hr_approve_form.form_id','left');
      $this->db->where('hr_form.form_status','1');
      $this->db->where('hr_form.hr_emp_status','00');
      //$this->db->where('hr_emp_stamp','551010');
      $this->db->order_by('hr_form.form_id');

     $form_statushr = $this->db->get();
     //echo $this->db->last_query(); die;
     return $form_statushr;
    }

    //function  query_formstatushr
    // ทำการคิวรี่ มาจาก hr_form และจอยมาจาก hr_approve_form ใน cloumn forrm_id
    //โดย app_ fomr_satus = 1 เท่านั้น * waiting

    public function condition_permission(){
      $this->db->select('*');
      $this->db->from('hr_approve_form');
      $this->db->join('hr_position','hr_approve_form.position_id = hr_position.position_id','left');
      $this->db->order_by('hr_approve_form.position_id');

      $permission = $this->db->get();
      return $permission;
    }

    public function union_query(){
      $status = "1";
      $approve_sec = "";
      $union_query = "";

      $union_query =  $this->db->query(
        "select sum(count_list) as sum_approve
        from (select count(hr_form.form_id) as count_list
        from hr_form
        left join hr_approve_form on hr_approve_form.form_id = hr_form.form_id
        where hr_approve_form.personal_id = '".$this->session->personal_id."'"
        ."and hr_approve_form.app_form_status ='1' UNION
        select count(hr_nightshift.night_id) as count_list
        from hr_nightshift
        where hr_nightshift.night_approve_sec ='".$this->session->personal_id."')"."as table_sum");

       //echo   $this->db->last_query(); die;

        return $union_query;
    }

    public function hr_nightshift(){
      $this->db->select('*');
      $this->db->from('hr_nightshift');
      $this->db->where('hr_nightshift.night_approve_sec', $this->session->personal_id);

      $hr_nightshift = $this->db->get();
      //echo $this->db->last_query(); die;
      return $hr_nightshift;
    }

    public function list_approval($personal_id){
      $this->db->select('*');
      $this->db->from('hr_approve_form');
      $this->db->where('personal_id',$personal_id);

      $list_show = $this->db->get();
      return $list_show;
    }
   }
