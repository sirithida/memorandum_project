<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Class_email_model extends CI_Model{
    public $table_email;

    function __construct(){
      $this->$table_email="hr_email";
    }

    public function insert_email(){
      $data_email = array(
        "email_type"=> $this->email_type,
        "email_form"=> $this->email_form,
      );
        try{
			      $this->db->insert($this->$table_email,$data_email);
		        }catch(Exception $e){
			         throw new Exception($e->getMessage());
            }
     }

    public function update_email(){
        try{
          $this->db->set("email_type ", $this->email_type);
          $this->db->set("email_form", $this->email_form);

          $this->db->where("email_id", $this->email_id);
          $this->db->update($this->$table_email);
            }catch(Exception $e){
      			throw new Exception($e->getMessage());
      		}
      	}
    }

    public function delete_form(){
  		try{
  			$this->db->delete($this->$table_email, array('email_id' => $this->email_id));
  		}catch(Exception $e){
  			throw new Exception($e->getMessage());
  		}
  	}


  }
