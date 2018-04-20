<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_section_model extends CI_Model{
    public $table_sec;

    function __construct(){
      $this->table_sec="hr_section";
    }

    public function insert_section($sec_id,$sec_name,$depart_part){
        $data_sec = array(
          "sec_id"=> $sec_id,
          "sec_name"=> $sec_name,
          "depart_id"=> $depart_part,
          );
      try{
          $this->db->insert($this->table_sec,$data_sec);
          }catch(Exception $e){
             throw new Exception($e->getMessage());
          }
        }

    public function update_sec($sec_id,$sec_name,$depart_part){
      $data_sec = array(
        'sec_name' => $sec_name,
        'upd_sec' => '00',
      );
        $this->db->where('sec_id',$sec_id);
        $this->db->update($this->table_sec,$data_sec);
    }

    public function soft_delete($sec_id){
      $update_type = array(
          'upd_sec' => '01', //01 = Soft DELETE
      );
          $this->db->where('sec_id',$sec_id);
          $this->db->update($this->table_sec,$update_type);
    }

    public function select_sec($c_update_sec){
      $update_sec = $this->db->get_where($this->table_sec,$array = array('sec_id' =>$c_update_sec));
      return $update_sec;
    }

    public function del_sec($sec_id){
      //this -> db -> where (column in table)
      $this->db->where('sec_id', $sec_id);
      $this->db->delete($this->table_sec);
    }

    public function gen_query(){
      $query = $this->db->get("hr_department");
      return $query;
    }

    public function query_datatable(){
      $this->db->select('*');
      $this->db->from('hr_section');
      $this->db->join('hr_department','hr_section.depart_id = hr_department.depart_id', 'left');
      $this->db->where('upd_sec','00');
      $this->db->order_by('sec_id', 'ASC');

      $query_datatable = $this->db->get();
      return $query_datatable;
    }
}
