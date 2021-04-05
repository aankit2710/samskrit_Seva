<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reapear extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$admin = $this->session->userdata('admin');

		$this->load->helper('common_helper');
		$this->load->model('Reapear_model');
		$this->load->model('Branch_model');
		$this->load->library('form_validation');

		if(empty($admin)){
			$this->session->set_flashdata('msg','Your session has been expired');
			redirect(base_url().'admin/login/index');
		}
	}

	public function index()
	{

		$admin = $this->session->userdata('admin');
		$data['type'] = $admin['type'];
		$this->form_validation->set_rules("month","month","trim");
		$this->form_validation->set_rules("year","year","trim");
		$this->form_validation->set_rules("course","course","trim");

		if($this->form_validation->run()==true){

			$month = $this->input->post('month');
			$year = $this->input->post('year');
			$course = $this->input->post('course');

			$getAllResult = $this->Reapear_model->getAllResult1($month,$year,$course);
			$data['getAllResult']=$getAllResult;

			$getAllCourse = $this->Reapear_model->getAllCourse();
			$data['getAllCourse'] = $getAllCourse;
			$this->load->view('admin/reapear',$data);

		}else{

			$getAllCourse = $this->Reapear_model->getAllCourse();
			$data['getAllCourse'] = $getAllCourse;

			$getAllResult = $this->Reapear_model->getAllResult12();
			$data['getAllResult']=$getAllResult;

			$this->load->view('admin/reapear',$data);
		}
	}

	public function filter()
	{
		$branch_id = $this->input->post('branch_id');
		$getAllResult = $this->Reapear_model->getAllResult($branch_id);
		echo $getAllResult;	
	}

	public function update()
	{

		$input = filter_input_array(INPUT_POST);
		// print_r($_REQUEST);

		$form_array['REG_NO'] = $input['REG_NO'];
		$form_array['Name'] = $input['Name'];
		$form_array['COURSE'] = $input['COURSE'];
		$id = $input['id'];

		$create = $this->Reapear_model->update($id,$form_array);
	}

}
