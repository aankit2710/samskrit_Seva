<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  	$admin = $this->session->userdata('admin');
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
    $this->load->view('admin/import');
}

function create()
{

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


}
