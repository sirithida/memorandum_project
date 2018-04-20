<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Request_dataform_model extends CI_Model {
    public $table_typeform;

        function __construct(){
          $this->table_typeform = "hr_typeform";
        }
        public function query_typeform($type_id){
          $m_query_typeform = $this->db->get_where('hr_typeform',array('type_id'=>$type_id));
          return $m_query_typeform;
        }

        public function query_datatable(){
          $this->db->order_by('type_id','ASC');
          $query_datatable = $this->db->get_where('hr_typeform',array('type_upd' => '00'));

          return $query_datatable;
        }

        public function insert_newtype($type_name){
          $insert_name = array(
            "type_name" => $type_name,
            'type_upd' => '00', //00 = Soft DELETE
          );
          $this->db->insert($this->table_typeform,$insert_name);

        }

        public function soft_delete($type_id){
          $update_type = array(
              'type_upd' => '01', //01 = Soft DELETE
          );
              $this->db->where('type_id',$type_id);
              $this->db->update($this->table_typeform,$update_type);
        }
            // DELETE FROM mytable
            // WHERE id = $id

        public function upd_type($type_id,$type_name){
            $update_type = array(
                'type_name' => $type_name,
            );
                $this->db->where('type_id',$type_id);
                $this->db->update($this->table_typeform,$update_type);
        }
}
