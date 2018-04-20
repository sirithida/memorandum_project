<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_controller extends CI_Controller {


     public function __construct()
     {
          parent::__construct();
          $this->load->library('form_validation');
          //load the login model
          $this->load->model('form_model');
     }

		 public function index()
	      {
	           //get the posted values
	           $username = $this->input->post("username");
	           $password = $this->input->post("password");

	           //set validations
	           $this->form_validation->set_rules("username", "username", "trim|required");
	           $this->form_validation->set_rules("password", "password", "trim|required");

	           if ($this->form_validation->run() == FALSE)
	           {
	                //validation fails
	                $this->load->view('form_view');
	           }
	           else
	           {
	                //validation succeeds

	                if ($this->input->post('login-submit') == "Login")
	                {
	                     //check if username and password is correct
	                     /*$user_result = $this->form_model->get_user($username, $password);
	                     if ($user_result > 0) //active user record is present
	                     {
	                          //set the session variables
	                          $sessiondata = array(
	                               'username' => $username,
	                               'loginuser' => TRUE
	                          );
	                          $this->session->set_userdata($sessiondata);*/
	                          redirect("memorandum_controller");
	                     /*}
	                     else
	                     {
	                          $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username and password!</div>');
	                          redirect('form_controller');
	                     }
                      */
	                }else
	                {
	                     redirect('login/index');
	                }
	           }
	      }
	 }
	 ?>
