<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_division_model extends CI_Model{
    public $table_divis;

    function __construct(){
        $this->table_divis="hr_division";
      }

    public function insert_divis($div_name){
        $data_divis = array(
        "div_name"=> $div_name,
        'upd_divis' => '00', //00 = Soft DELETE
      );
        $this->db->insert($this->table_divis,$data_divis);
    }

    public function soft_delete($div_id){
      $update_type = array(
          'upd_divis' => '01', //01 = Soft DELETE
      );
          $this->db->where('div_id',$div_id);
          $this->db->update($this->table_divis,$update_type);
    }

    public function update_divis($div_id,$div_name){
        $data_divis = array(
          'div_name'  => $div_name,
        );
        $this->db->where('div_id', $div_id);
        $this->db->update($this->table_divis,$data_divis);
    }

    public function select_divis($c_update_divis){
      $m_update_divis =  $this->db->get_where($this->table_divis,$array = array('div_id' =>$c_update_divis));
        return $m_update_divis;
    }
  //พารามิเตอร์ในฟังก์ชั่น ไม่จำเป็นต้องเป็นชื่อเดียวกับตัวที่ส่ง controller มา แต่บอกว่า พารามิเตอร์มากี่ตัวเท่านั้น มีกี่ตัวชั้นด้วย ,

    public function del_divis($div_id){
      $this->db->where('div_id',$div_id);
      $this->db->delete($this->table_divis);
    }

    public function query_datatable(){
      $this->db->order_by('div_id','ASC');
      $query_datatable = $this->db->get_where('hr_division',array('upd_divis' => '00'));

      return $query_datatable;
    }


}
?>
