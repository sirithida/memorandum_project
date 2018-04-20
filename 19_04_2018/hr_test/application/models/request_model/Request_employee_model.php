<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_employee_model extends CI_Model{
    public $table_sec;

    function __construct(){
      $this->table_sec ="hr_section";
      $this->table_hrperson ="hr_personal";
      $this->table_pic_center ="hr_pic_center";
      $this->table_emp_section ="hr_emp_section";

    }

  /////////////////////////////////////////////////////////////////////////////////
    //insert person
    public function insert_employee($personal_id,$personal_name,$personal_lastname,$personal_email){
        $data_personal = array(
          "personal_id"=> $personal_id,
          "personal_name"=> $personal_name,
          "personal_lastname"=> $personal_lastname,
          "personal_email"=> $personal_email,
        );
          $this->db->insert($this->table_hrperson,$data_personal);
        }

    public function insert_emp_center($pic_emp_id,$pic_emp_username,$pic_emp_lastname,$pic_section_id,$pic_poisition_id){
        $data_pic_center = array(
          "pic_personal_id"=> $pic_emp_id,
          "pic_personal_name"=> $pic_emp_username,
          "pic_personal_lastname"=> $pic_emp_lastname,
          "pic_sec_id"=> $pic_section_id,
          "pic_position_id"=> $pic_poisition_id,
        );
          $this->db->insert($this->table_pic_center,$data_pic_center);
        }
  //////////////////////////////////////////////////////////////////////////////

    //Update
    public function update_emp($personal_name,$personal_lastname){
      $data_personal_update = array(
        "personal_name" => $personal_name,
        "personal_lastname" => $personal_lastname,
      );
        $this->db->where('personal_id',$personal_id);
        $this->db->update($this->table_hrperson,$data_personal_update);
    }

  /////////////////////////////////////////////////////////////////////////////

  // function delete
  public function del_employee($sec_id){
    //this -> db -> where (column in table)
    $this->db->where('hr_pic_center', $pic_center);
    $this->db->delete($this->hr_pic_center);
  }

  public function soft_delete($pic_id){
    $update_type = array(
        'pic_upd' => '01', //01 = Soft DELETE
    );
        $this->db->where('pic_id',$pic_id);
        $this->db->update($this->table_pic_center,$update_type);
        //echo $this->db->last_query(); die;
  }

///////////////////////////////////////////////////////////////////////////////

  //selector

  public function upd_update_emp($pic_id){
    //$update_employee = $this->db->get_where($this->table_pic_center,$array = array('pic_id' =>$update));
    $this->db->select('*');
    $this->db->from('hr_pic_center');
    $this->db->join('hr_personal','hr_personal.personal_id = hr_pic_center.pic_personal_id', 'left');
    $this->db->join('hr_position','hr_pic_center.pic_position_id = hr_position.position_id','left');
    $this->db->join('hr_section','hr_pic_center.pic_sec_id = hr_section.sec_id', 'left');
    //$this->db->where('hr_pic_center.pic_id',$pic_id);
    $this->db->where('hr_pic_center.pic_personal_id',"$pic_id");

    $update_employee = $this->db->get();

    //echo $this->db->last_query(); die;

    return $update_employee;
  }

  public function position_selector(){
    $this->db->select('*');
    $this->db->from('hr_position');
    $this->db->order_by('position_id');

    $position = $this->db->get('');
    return $position;
  }

  public function section_selector(){

    $this->db->select('*');
    $this->db->from('hr_section,hr_position');
    $this->db->order_by('sec_id,position_id');

    $section = $this->db->get('');
    return $section;
  }

///////////////////////////////////////////////////////////////////////////////
  //query employee all
  public function query_employee(){
    $this->db->select('*');
    $this->db->from('hr_pic_center');
    $this->db->join('hr_section','hr_section.sec_id = hr_pic_center.pic_sec_id');
    $this->db->join('hr_position','hr_position.position_id = hr_pic_center.pic_position_id');
    $this->db->where('hr_pic_center.pic_upd','00');

    $employee = $this->db->get();
    return $employee;
    }



  public function update_edit($personal_id,$personal_name,$personal_lastname,$personal_email,$id){
    $update_personal = array(
      "personal_id"=> $personal_id,
      "personal_name"=> $personal_name,
      "personal_lastname"=> $personal_lastname,
      "personal_email"=> $personal_email,
    );
      $this->db->where('personal_id', $id);
      $this->db->update('hr_personal', $update_personal);
    }

  public function del_center($id){
    $this->db->where('pic_personal_id', $id);
    $this->db->delete('hr_pic_center');
    }
  }

/* public function insert_edit(){

    $del_person = $this->db->update('hr_personal', array('personal_id' => '602078'));
    $del_center = $this->db->delete('hr_pic_center', array('pic_personal_id' => $id ,'pic_personal_name' => $name
    ,'pic_personal_lastname' => $lastname ,'pic_sec_id' => $sec ,'pic_position_id'=> $posit ));

    if ($del_person != null) {
      $this->db->insert('hr_personal',array('personal_id' => $personal_id, 'personal_name' => $personal_name
      ,'personal_lastname' => $personal_lastname,'personal_email' => $personal_email));

      $insert = $this->db->insert('hr_pic_center',array('pic_personal_id' => $center_id ,'pic_personal_name' => $center_name
      ,'pic_personal_lastname' => $center_lastname ,'pic_sec_id' => $center_sec ,'pic_position_id'=> $center_posit ));
      return $insert;
    }
    $this->db->delete('hr_pic_center',array('pic_personal_id' => $id_center ,'pic_personal_name' => $name_center ,'pic_personal_lastname' => $lastname_center
  ,'pic_sec_id' => $sec_center, 'pic_position_id' => $position_center));
  } */
