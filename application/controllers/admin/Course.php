<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$admin = $this->session->userdata('admin');

		$this->load->helper('common_helper');
		$this->load->model('Course_model');
		$this->load->model('Branch_model');
		$this->load->library('form_validation');

		if(empty($admin)){
			$this->session->set_flashdata('msg','Your session has been expired');
			redirect(base_url().'admin/login/index');
		}
	}

	public function index()
	{

		$this->form_validation->set_rules("month","month","trim");
		$this->form_validation->set_rules("year","year","trim");
		$this->form_validation->set_rules("course","course","trim");

		if($this->form_validation->run()==true){

			$month = $this->input->post('month');
			$year = $this->input->post('year');
			$course = $this->input->post('course');

			$getAllCourse = $this->Course_model->getAllCourse1($month,$year,$course);
			$data['getAllCourse']=$getAllCourse;

			$getAllCourse = $this->Course_model->getAllCourse();
			$data['getAllCourse'] = $getAllCourse;
			$this->load->view('admin/Course',$data);

		}else{

			$getAllCourse = $this->Course_model->getAllCourse12();
			$data['getAllCourse']=$getAllCourse;

			$this->load->view('admin/course',$data);
		}
	}

	public function filter()
	{
		$branch_id = $this->input->post('branch_id');
		$getAllCourse = $this->Course_model->getAllCourse($branch_id);
		echo $getAllCourse;	
	}

	public function update()
	{

		$input = filter_input_array(INPUT_POST);
		// print_r($_REQUEST);

		$form_array['REG_NO'] = $input['REG_NO'];
		$form_array['Name'] = $input['Name'];
		$form_array['COURSE'] = $input['COURSE'];
		$form_array['GRADE'] = $input['GRADE'];
		$form_array['ACTION'] = $input['ACTION'];
		$id = $input['id'];

		$create = $this->Course_model->update($id,$form_array);
	}

	public function edit()
	{
		echo "<pre>";
		//db column name = form post input
		$form_array['student_course_coursename'] = $this->input->post('reg_courses');
		$form_array['student_course_month'] = $this->input->post('reg_examinationmonth');
		$form_array['student_course_preferredtime'] = $this->input->post('reg_preftime');
		$form_array['student_course_medium_study'] = $this->input->post('reg_medium');
		$id = $this->input->post('student_course_id');

		$create = $this->Course_model->updateCourse($id,$form_array);

		print_r($_POST);

		echo $_POST['reg_name'];
		exit;

		//db column name = form post input
		$form_array1['student_profile_name'] = $this->input->post('reg_name');
		$form_array1['student_profile_dob'] = $this->input->post('reg_dob');
		$form_array1['student_profile_gender'] = $this->input->post('reg_gender');
		$form_array1['student_profile_phone'] = $this->input->post('reg_phone');
		$form_array1['student_profile_email'] = $this->input->post('reg_email');
		$form_array1['student_profile_qualification'] = $this->input->post('reg_Qualification');
		$form_array1['student_profile_occupation'] = $this->input->post('reg_occupation');
		$form_array1['student_profile_address'] = $this->input->post('reg_address');
		$form_array1['student_profile_district'] = $this->input->post('reg_district');
		$form_array1['student_profile_state'] = $this->input->post('reg_state');
		$form_array1['student_profile_pincode'] = $this->input->post('reg_pincode');
		$form_array1['student_profile_country'] = $this->input->post('reg_country');
		$form_array1['student_profile_medium_study'] = $this->input->post('reg_medium');

		// $id which id to update in tabel
		$id2 = $this->input->post('student_profile_id');
		$create = $this->Course_model->updateProfile($id2,$form_array1);

		// print_r($_REQUEST); debug
		// exit();

		if($create){

				$this->session->set_flashdata('success','Updated Successfully');
				redirect(base_url().'admin/course/index');

			}else{

				$this->session->set_flashdata('msg','Something Went Wrong');
				redirect(base_url().'admin/course/index');
			}

	}

}
