<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Class_personal_model extends CI_Model{
    public $table_person;
    public $pic_start_time;
    public $pic_end_time
    public $pic_trans
    public $pic_start_day
    public $pic_end_day
    public $pic_job_desc
    public $form_id
    public $form_date;

    function __construct(){
      $this->$table_person="hr_form_personal_detail";
    }

    public function insert_personal(){
       $data_personal = array(
         "pic_start_time"=> $this->pic_start_time,
         "pic_end_time"=> $this->pic_end_time,
         "pic_trans"=> $this->pic_trans,
         "pic_start_day"=> $this->pic_start_day,
         "pic_end_day"=> $this->pic_end_day,
         "pic_job_desc"=> $this->pic_job_desc,
         "form_id"=> $this->form_id,
         "form_date"=> $this->form_date,
       );
         try{
         $this->db->insert($this->$table_person,$data_personal);
       }catch(Exception $e){
         throw new Exception($e->getMessage());
       }
     }

    public function update_person(){
      try{
        $this->db->set("pic_start_time", $this->pic_start_time);
        $this->db->set("pic_end_time", $this->pic_end_time);
        $this->db->set("pic_trans",$this->pic_trans);
        $this->db->set("pic_start_day",$this->pic_start_day);
        $this->db->set("pic_end_day",$this->pic_end_day);
        $this->db->set("pic_job_desc",$this->pic_job_desc);

        $this->db->where("pic_id", $this->pic_id);
        $this->db->update($this->table);
        }catch(Exception $e){
        throw new Exception($e->getMessage());
      }
    }

    public function delete_personal(){
      try{
        $this->db->delete($this->table, array('pic_id' => $this->pic_id));
      }catch(Exception $e){
        throw new Exception($e->getMessage());
      }
    }

  }
