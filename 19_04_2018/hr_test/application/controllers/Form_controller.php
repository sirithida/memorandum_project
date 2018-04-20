<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_controller extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		//load the login model
		$this->load->model('form_model', 'm_f');
	}

	public function index(){
	   //get the posted values
	   $username = $this->input->post("username");
	   $password = $this->input->post("password");

//*********************************************************************************************//
		 // Get มาจาก Email ต้องส่ง 3 ตัวนี้เข้ามาเพื่อให้ได้ Getlink report
		// ได้แก่ Subject,position,app_form_id
		 $get_id_email = $this->input->get('subject');
		 $get_position_email = $this->input->get('position');
		 //echo $get_id_email; die;
		 //$get_appform_id = $this->input->get('app_form_id');
//*********************************************************************************************//
	   //set validations
	   $this->form_validation->set_rules("username", "username", "trim|required");
	   $this->form_validation->set_rules("password", "password", "trim|required");

	   if ($this->form_validation->run() == FALSE){
			//validation fails
			$this->load->view('form_view'); //เปิดหน้ากรอกข้อมูลขึ้นมา
	   }else{
			//validation succeeds
			if ($this->input->post('login-submit') == "Login"){ //ถ้ามีค่า ที่โพส login เข้ามา
				$username = $this->input->post('username'); //Post username
				$password = $this->input->post('password'); //Post Paessword

				$username_for_dn = $username;
				$username = 'nmt\\'.$username;
				$server = $this->config->item('ldap_server'); // คอนฟิก Idap

				try{
					$ds = ldap_connect($server) or die("Can't connect LDAP"); // //ถ้า Ldap ไม่สามรถเชื่อมต่อได้ เก็บในตัวแปร $ds
					if($ds){
						$b = ldap_bind($ds,$username,$password);
						if($b === TRUE){
							$result = NULL;
							$array_ldap_dn = array($this->config->item('ldap_base_dn_nmth'), $this->config->item('ldap_base_dn_bkk'));
							$i = 0;
							do{
								$ldap_base_dn = $array_ldap_dn[$i];
								$search_filter = '(&(objectCategory=person)(samaccountname='.$username_for_dn.'))';
								//$search_filter = '(&(objectCategory=person))';
								$attributes = array('givenname', 'mail', 'samaccountname', 'sn', 'department');
								$result = ldap_search($ds, $ldap_base_dn, $search_filter, $attributes);
								$entries = ldap_get_entries($ds, $result);

								$i++;
							}while(FALSE === $result);

							if(FALSE !== $result){

								$entries = ldap_get_entries($ds, $result);
								$obj_user = $this->m_f->get_user($username_for_dn);
								//select * from hr_personal where personal_username;

								$obj_position = $this->m_f->position_user();
								$obj_center = $this->m_f->personal_center($username_for_dn);

								if($obj_user->num_rows() && $obj_center->num_rows()){
									//--create session
									$array_session = array(
										'username' => $entries[0]['samaccountname'][0],
										'firstname' => $entries[0]['givenname'][0],
										'lastname' => $entries[0]['sn'][0],
										'email' => $entries[0]['mail'][0],
										'full_department' => $entries[0]['department'][0],

										'personal_id' => $obj_center->row()->pic_personal_id,
										'sec_id' => $obj_center->row()->pic_sec_id,
										'sec_name' => $obj_center->row()->sec_name,
										'create_by' => $obj_user->row()->create_by,
										'position' => $obj_center->row()->position_name,
										'position_id' => $obj_center->row()->position_id,
										'position_name' => $obj_center->row()->position_name,

										'user_to' => $obj_user->row()->user_to,
										'logged_time' => time(),
										'loginuser' => TRUE
									);
									$this->session->set_userdata($array_session);
									ldap_close($ds);

							}if($get_id_email || $get_position_email){
									redirect('memo_controller/report_email_controller/index?subject='.$value->form_id.'&position='.$value->position_id.'&approve_id='.$value->app_form_id);
							}else {
								redirect("memo_controller/memorandum_controller");
							}
									//กรอก Username password ผ่านแล้ว ให้ redirect มาที่หน้า Create memo

							}else{
								$this->message("msg_error", "Can't find this user in LDAP...");
							}
						}else{
							$this->session->set_flashdata('msg', "<div class='alert alert-danger text-center'>Invalid username or/and password...</div>");
						}
					}else{
						$this->session->set_flashdata('msg', "<div class='alert alert-danger text-center'>Can't connect LDAP</div>");
					}
				}catch(Exception $e){
					$error = $e->getMessage();
					$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">'.$error.'</div>');
				}
					redirect('form_controller');
			}
		}
	}


	protected function kill_session(){
		$user_data = $this->session->all_userdata();

		foreach ($user_data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
				$this->session->unset_userdata($key);
			}
		}
		$this->session->sess_destroy();
	}

	public function logout(){
		self::kill_session();
		redirect('form_controller');
	}
}
