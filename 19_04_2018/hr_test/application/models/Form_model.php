<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_model extends CI_Model
{
	private $table;
	function __construct(){
		// Call the Model constructor
		parent::__construct();
		$this->table = 'hr_personal';
	}

	function get_user($username){
		$this->db->where('personal_username', $username);
		return $this->db->get($this->table);
	}

	function position_user(){
		$this->db->select('*');
		$this->db->from('hr_position');
		$this->db->join('hr_approve_form','hr_approve_form.position_id = hr_position.position_id');
		$this->db->order_by('hr_position.position_id');
		$position_user = $this->db->get();

		//echo $this->db->last_query(); die;
		return $position_user;
	}

	public function personal_center($personal_username){
		$this->db->select('*');
		$this->db->from('hr_personal');
		$this->db->join('hr_pic_center','hr_pic_center.pic_personal_id = hr_personal.personal_id','left');
		$this->db->join('hr_section','hr_section.sec_id = hr_pic_center.pic_sec_id','left');
		$this->db->join('hr_position','hr_position.position_id = hr_pic_center.pic_position_id','left');
		$this->db->where('personal_username',$personal_username);


		$pic_center = $this->db->get('');

		//echo $this->db->last_query(); die;
		return $pic_center;
	}
}
