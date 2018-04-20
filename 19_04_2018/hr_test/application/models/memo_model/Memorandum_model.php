 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Memorandum_model extends CI_Model{
    public $table_hrform;
    public $table_hrperson;
    public $table_email;
    public $table_approve;
    public $table_subject;
    public $table_flow;
    public $table_hr_person;

    function __construct(){
      $this->table_hrform = "hr_form";
      $this->table_hrperson = "hr_form_personal_detail";
      $this->table_email = "hr_email_from";
      $this->table_approve = "hr_approve_form";
      $this->table_subject = "hr_subject";
      $this->table_flow = "hr_approve_flow";
      $this->table_hr_person = "hr_personal";
    }

    public function insert_form($memo_no,$user_subject,$stamp_date,$type_form,$attach_file,$section,$user_create){
      $data_form = array(
        'form_subject' => $user_subject, //2
        'form_date' => $stamp_date,
        //'from_detail' => $user_detail, //3
        //'type_form' => $type_form,
        'attach_file' => $attach_file, //7
        'hr_memo_no' => $memo_no, //8
        'form_section' => $section, //9
        //'start_datetime' => $start_datetime, //10
        //'end_datetime' => $end_datetime, //11
        'create_by' => $user_create,//12
        'hr_emp_stamp' => '551010',

        );
      $this->db->insert($this->table_hrform,$data_form);
      $new_id = $this->db->insert_id();
      //$this->db->last_query(); die;
      return $new_id;
    }

    public function insert_to($form_id,$user_to,$email_type,$email_name,$seq,$personal_id){
      $data_to = array(
        'form_id' => $form_id,
        'email_address' => $user_to,
        'email_type' => $email_type,
        'email_name' => $email_name,
        'seq' => $seq,
        'personal_id' => $personal_id,
      );
        $this->db->insert($this->table_email,$data_to);
    }

    public function insert_person($insert_id,$user_id,$pic_job_desc,$bus,$bus_comment,$date_start,$date_end,$start_time,$end_time){
     $data_person = array(
        'form_id' => $insert_id,
        'personal_id' => $user_id,
        'pic_job_desc' => $pic_job_desc,
        'pic_trans' => $bus,
        'pic_bus_comment' => $bus_comment,
        'emp_start_date' => $date_start,
        'emp_end_date' => $date_end,
        'start_time' => $start_time,
        'end_time' => $end_time,
      );
        $this->db->insert($this->table_hrperson,$data_person);
    }

    public function approve_sec($status,$personal_id,$position_id,$form_id,$create_by){
      $approve_sec = array(
        'app_form_status' => $status,
        'personal_id' => $personal_id,
        'position_id' => $position_id,
        'form_id' => $form_id,
        'create_by' => $create_by,

      );
        $this->db->insert($this->table_approve,$approve_sec);
        //echo $this->db->last_query(); die;
    }

    public function approve_query(){
      $this->db->select('*');
      $this->db->from('hr_pic_center');
      $this->db->join('hr_personal','hr_personal.personal_id = hr_pic_center.pic_personal_id','left');
      $this->db->where('hr_pic_center.pic_position_id', '1');
      $this->db->where('hr_pic_center.pic_sec_id', $this->session->sec_id);


      $approve_query = $this->db->get();
      //SELECT * FROM "hr_pic_center" WHERE "hr_pic_center"."pic_position_id" = 1 AND "hr_pic_center"."pic_sec_id" = '032'
      //echo $this->db->last_query(); die;
      return $approve_query;
    }

    public function approve_hos(){
      $this->db->select('*');
      $this->db->from('hr_pic_center');
      $this->db->where('hr_pic_center.pic_position_id', 2);
      $this->db->where('hr_pic_center.pic_sec_id', $this->session->sec_id);

      $approve_query = $this->db->get();
      //echo $this->db->last_query(); die;
      return $approve_query;
    }

    public function approve_hod(){
      $this->db->select('*');
      $this->db->from('hr_pic_center');
      $this->db->where('hr_pic_center.pic_position_id', 3);
      $this->db->where('hr_pic_center.pic_sec_id', $this->session->sec_id);
      $approve_query = $this->db->get();
      //echo $this->db->last_query(); die;
      return $approve_query;
    }

  /*  ส่งเทลหาพี่เป้ง
      public function query_email(){
      $this->db->select('personal_name, personal_email,personal_id'); //select to email
      $this->db->not_like('personal_email', $this->session->sec_id);  // WHERE `title` NOT LIKE '%match% ESCAPE '!'
      $this->db->where('sec_id','050');
      $this->db->where('personal_id','561808');

      $query = $this->db->get('hr_personal');
      echo $this->db->last_query(); die;
      return $query;
    } */

    public function query_emailcc(){
      $this->db->select('personal_name, personal_email,personal_id'); //select to email
      $this->db->not_like('personal_email', $this->session->sec_id);  // WHERE `title` NOT LIKE '%match% ESCAPE '!'

      $querycc = $this->db->get('hr_personal');


      return $querycc;
    }

    public function typeform(){
      $type_id = $this->db->get_where('hr_typeform',array('type_upd' => '00'));
      return $type_id;
    }

    //query select * form hr_approve_flow
    //where sec_id , personal_id
    public function query_flow(){
      $this->db->select('*');
      $this->db->from('hr_pic_center');
      $this->db->where('pic_personal_id',$this->session->personal_id);
      $this->db->where('pic_position_id',$this->session->position_id);
      $query_flow = $this->db->get();
      //SELECT * FROM "hr_approve_flow" WHERE "personal_id" = '032'
      //echo $this->db->last_query(); die;
      return $query_flow;
    }

    public function hr_personal($personal_id){
      $this->db->select('*');
      $this->db->from('hr_personal');
      $this->db->where('sec_id',$this->session->sec_id);
      $this->db->like('personal_id',$personal_id);
      $person = $this->db->get();
      //echo $this->db->last_query(); die;
      return $person;
    }

    public function meme_no(){
      $this->db->select('get_memo_no()');
      $this->db->from('hr_memo_seq');

      $memo_no = $this->db->get();
      //echo $this->db->last_query(); die;
      return $memo_no;
    }

    public function section_memo(){
      $this->db->select('*');
      $this->db->from('hr_section');
      $this->db->where('upd_sec','00');
      $this->db->where('sec_id',$this->session->sec_id);

      $sec_memo = $this->db->get();
      //echo $this->db->last_query(); die;
      return $sec_memo;
    }

    public function query_section(){
      $this->db->select('*');
      $this->db->from('hr_pic_center');
      $this->db->join('hr_section','hr_section.sec_id = hr_pic_center.pic_sec_id','left');
      $this->db->join('hr_position','hr_position.position_id = hr_pic_center.pic_position_id','left');
      $this->db->where('hr_pic_center.pic_personal_id',$this->session->personal_id);
      $this->db->order_by('hr_pic_center.pic_sec_id');
      $this->db->order_by('hr_pic_center.pic_position_id');

      $sec_session = $this->db->get();
      //echo $this->db->last_query(); die;
      return $sec_session;
    }

    public function approve_form($form_id){
      $this->db->select('*');
      $this->db->from('hr_approve_form');
      $this->db->where('app_form_status','1');
      $this->db->where('form_id',$form_id);
      $this->db->where('position_id',1);

      $approve_supervisor = $this->db->get();
      //echo $this->db->last_query(); die;
      return $approve_supervisor;
    }

    public function get_id($form_id){
      $this->db->select('*');
      $this->db->from('hr_form');
      $this->db->where('form_id',$form_id);

      $get_form_id = $this->db->get();
      return $get_form_id;
      }

      public function step_email($form_id){
        $this->db->select('*');
        $this->db->from('hr_approve_form');
        $this->db->join('hr_position','hr_position.position_id = hr_approve_form.position_id','left');
        $this->db->where('hr_approve_form.form_id',$form_id);
        $this->db->where('hr_approve_form.app_form_status','1');
        $this->db->order_by('hr_approve_form.app_form_id');
        $this->db->limit('1');

        $send_mail = $this->db->get();
        //echo $this->db->last_query(); die;
        return $send_mail;
      }
    }
