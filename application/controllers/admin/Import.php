<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  	$admin = $this->session->userdata('admin');
    $data['type'] = $admin['type'];
  $this->load->library('csvimport');
  $this->load->library('form_validation');
  $this->load->helper('common_helper');
  $this->load->model('Member_model');
  
  if(empty($admin)){
			$this->session->set_flashdata('msg','Your session has been expired');
			redirect(base_url().'admin/login/index');
		}
		
}

function index()
{
    $admin = $this->session->userdata('admin');
		$data['type'] = $admin['type'];
    $this->load->view('admin/import', $data);
}

function course()
{
    $admin = $this->session->userdata('admin');
		$data['type'] = $admin['type'];
    $this->load->view('admin/import-course', $data);
}

function create()
{

  $admin = $this->session->userdata('admin');
    $data['type'] = $admin['type'];
    $select_type = $this->input->post('select_type');
  $file_data = $this->csvimport->get_array($_FILES["import_csv"]["tmp_name"]);

  function format_date($date)
  {
    $date=date_create($date);
    return date_format($date,"Y-m-d");
  }

if( $select_type == 'result' ){
  foreach($file_data as $row)
  {
    
    $form_array['REG_NO'] = $row["REG_NO"];
    $form_array['NAME']  = $row["NAME"];
    $form_array['COURSE'] = $row["COURSE"];
    $form_array['GRADE']= $row["GRADE"];
    $form_array['ACTION']= $row["ACTION"];
    $form_array['year']   = $row["result  year"];
    $form_array['month']   = $row["month"];
    

    $last_id = $this->Member_model->result($form_array,$select_type);

    if($last_id)
    {
      
    }

  }
}
  else{
    foreach($file_data as $row)
  {
    
    $form_array['REG_NO'] = $row["REG_NO"];
    $form_array['NAME']  = $row["NAME"];
    $form_array['COURSE'] = $row["COURSE"];

    $last_id = $this->Member_model->result($form_array,$select_type);

    if($last_id)
    {
      
    }

  }
  }

  $this->session->set_flashdata('success','Imported Successfully');
  redirect(base_url().'admin/import/');

}

function createCourse()
{

  $admin = $this->session->userdata('admin');
    $data['type'] = $admin['type'];
    $select_type = $this->input->post('select_type');
  $file_data = $this->csvimport->get_array($_FILES["import_csv"]["tmp_name"]);

  function format_date_2($date)
  {
    $date=date_create($date);
    return date_format($date,"Y-m-d");
  }

  foreach($file_data as $row)
  {
    
    $form_array['student_course_id'] = $row["student_course_id"];
    $form_array['student_course_student_id']  = $row["student_course_student_id"];
    $form_array['student_course_coursename'] = $row["student_course_coursename"];
    $form_array['student_course_month']= $row["student_course_month"];
    $form_array['student_course_preferredtime']= $row["student_course_preferredtime"];
    $form_array['student_course_registedon']   = $row["student_course_registedon"];
    $form_array['student_course_paymentstatus']   = $row["student_course_paymentstatus"];
    $form_array['student_course_status']   = $row["student_course_status"];
    $form_array['student_course_registeredby']   = $row["student_course_registeredby"];
    $form_array['student_course_paymentmode']   = $row["student_course_paymentmode"];
    $form_array['student_course_courseid']   = $row["student_course_courseid"];
    $form_array['student_course_amount']   = $row["student_course_amount"];
    $form_array['student_course_net_amount']   = $row["student_course_net_amount"];
    $form_array['student_course_medium_study']   = $row["student_course_medium_study"];
    $form_array['student_course_ss_txnid']   = $row["student_course_ss_txnid"];
    $form_array['student_course_payment_date']   = $row["student_course_payment_date"];
    $form_array['student_course_iswelcome_email_sent']   = $row["student_course_iswelcome_email_sent"];
    $form_array['student_course_lastupdatedon']   = $row["student_course_lastupdatedon"];
    $form_array['student_course_lastupdatedby']   = $row["student_course_lastupdatedby"];
    

    $last_id = $this->Member_model->import_course($form_array,$select_type);

    if($last_id)
    {
      
    }

  }

  $this->session->set_flashdata('success','Imported Successfully');
  redirect(base_url().'admin/import/course/');

}


}
