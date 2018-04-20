<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_nshr_model extends CI_Model{

   function __construct(){
      $this->table_nightshift = "hr_nightshift";
   }

   public function query_nightshift($id){
      $query_nightshift = $this->db->get_where('hr_nightshift', array('night_id' => $id));

      return $query_nightshift;
   }

    public function update_night($update_nightshift,$form_id){

     $approve_status = array(
        'approve_nightshift' => $update_nightshift,
      );
      $this->db->where('night_id', $form_id);
      $this->db->update($this->table_nightshift,$approve_status);

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

    public function hr_receive(){
    $this->db->select('*');
    $this->db->from('hr_personal');
    $this->db->where('sec_id','050');
    $this->db->where('personal_id','551010');

    $hr_report = $this->db->get();
    return $hr_report;
    }
}
