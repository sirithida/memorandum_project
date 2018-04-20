<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_depart_model extends CI_Model{
    public $table_depart;

    function __construct(){
      $this->table_depart="hr_department";
    }

    //พารามิเตอร์ 2 ตัว
    //ตัวแรก Datatype = Charecter
    //ตัวที่สอง Datatype = integer
    public function insert_depart($depart_name,$div_id){
      //($depart_name,$div_id) <--- ลำดับ
        $data_depart = array(
          "depart_name" => $depart_name,
          "div_id" => $div_id,
          "upd_depart" => '00',
        );
        $this->db->insert($this->table_depart,$data_depart);
    }

    public function update_depart($depart_id,$div_id,$depart_name){
      $data = array(
          'div_id' => $div_id,
          'depart_name'  => $depart_name,
      );
      $this->db->where('depart_id', $depart_id);
      $this->db->update($this->table_depart,$data);
    }
    //พารามิเตอร์ในฟังก์ชั่น ไม่จำเป็นต้องเป็นชื่อเดียวกับตัวที่ส่ง controller มา แต่บอกว่า พารามิเตอร์มากี่ตัวเท่านั้น มีกี่ตัวชั้นด้วย ,

    public function soft_delete($depart_id){
      $update_type = array(
          'upd_depart' => '01', //01 = Soft DELETE
      );
          $this->db->where('depart_id',$depart_id);
          $this->db->update($this->table_typeform,$update_type);
    }

    public function select_depart($c_update_depart){
      // สร้างตัวแปรมารับ = select * from where (table , ชื่อพารามิเตอร์ในฟังก์ชั่นนี้)
      $m_update_depart = $this->db->get_where($this->table_depart,array('depart_id'=> $c_update_depart ));
      // รีเทิร์นตัวแปรที่รับ Object
      return $m_update_depart;
    }

    public function del_depart($depart_id){
      try{
        $this->db->where('depart_id', $depart_id);
        $this->db->delete($this->table_depart);
      }catch(Exception $e){
        if($this->db->error()["message"]){
    			throw new Exception($this->db->error()["message"]);
    		}
      }
    }

    public function gendep_query(){
      $this->db->select('');
      $this->db->from('hr_division');
      $this->db->where('upd_divis','00');
      $this->db->order_by('div_id', 'ASC');
    
      $division = $this->db->get();
      return $division;
    }

    public function query_datatable(){
      $this->db->select('');
      $this->db->from('hr_department');
      $this->db->join('hr_division', 'hr_department.div_id=hr_division.div_id', 'left');
      $this->db->where('hr_department.upd_depart','00');
      $this->db->order_by('depart_id', 'ASC');

      $query_datatable = $this->db->get();
      return $query_datatable;
    }

}
