<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$admin = $this->session->userdata('admin');

		$this->load->helper('common_helper');
		$this->load->model('Staff_model');
		$this->load->library('form_validation');

		if(empty($admin)){
			$this->session->set_flashdata('msg','Your session has been expired');
			redirect(base_url().'admin/login/index');
		}
	}

	public function index()
	{
		
		$getAllrecords = $this->Staff_model->getAllrecords("admin");
		$data['getAllrecords'] = $getAllrecords;
		$this->load->view('admin/manage-staff',$data);
	}


	public function create()
	{

		$config['upload_path']          = './public/uploads/profile/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['encrypt_name']         =  true;

		$thumb_path          = './public/uploads/profile/thumb/';

		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0777, TRUE);
		}

		if (!is_dir($thumb_path)) {
			mkdir($thumb_path, 0777, TRUE);
		}


		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
		$this->form_validation->set_rules("status","Status","trim|required");

		if($this->form_validation->run()==true){

			if(!empty($_FILES['image']['name']))
			{

				if($this->upload->do_upload('image'))
				{
					$data = $this->upload->data();
					resizeImage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb/'.$data['file_name'],300,270); 
					$form_array['profile_image'] = $data['file_name'];

				}else{

					$error = $this->upload->display_errors();
					$data['errorImageUpload'] = $error;
					$this->session->set_flashdata('msg',$data['errorImageUpload']);
					redirect(base_url().'admin/staff/create');
				}

			}

				$form_array['name'] = $this->input->post('name');
				$form_array['username'] = $this->input->post('username');
				$form_array['email'] = $this->input->post('email');
				$form_array['phone_number'] = $this->input->post('phone');
				$form_array['type'] = "staff";
				$form_array['password'] = md5($this->input->post('password'));
				$form_array['status'] = $this->input->post('status');
				$form_array['created_date'] = date('Y-m-d H:i:s');
				$form_array['updated_date'] = date('Y-m-d H:i:s');

				$create = $this->Staff_model->create("admin",$form_array);

				if($create){

					$this->session->set_flashdata('success','Staff Inserted Successfully');
					redirect(base_url().'admin/staff/create');

				}else{

					$this->session->set_flashdata('msg','Something Went Wrong');
					redirect(base_url().'admin/staff/create');
				}

		}else{

			$this->load->view('admin/add-staff');
		}
	}

	public function edit($id)
	{	
		$var = $this->Staff_model->get_single_record($id);

		if(empty($var))
		{
			$this->session->set_flashdata('error','Banner Not Found');
			redirect(base_url().'admin/staff/index');
		}

		$config['upload_path']          = './public/uploads/profile/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['encrypt_name']         =  true;


		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
		$this->form_validation->set_rules("status","Status","trim|required");

		if($this->form_validation->run()==true){

			if(!empty($_FILES['image']['name']))
			{

				if($this->upload->do_upload('image'))
				{

					if($var['profile_image']!="" && file_exists('./public/uploads/profile/'.$var['profile_image'])){
						unlink('./public/uploads/profile/'.$var['profile_image']);
					}

					if($var['profile_image']!="" && file_exists('./public/uploads/profile/thumb/'.$var['profile_image'])){
						unlink('./public/uploads/profile/thumb/'.$var['profile_image']);
					}


					$data = $this->upload->data();
					resizeImage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb/'.$data['file_name'],300,270); 

					$form_array['profile_image'] = $data['file_name'];


				}else{

					$error = $this->upload->display_errors();
					$data['errorImageUpload'] = $error;
					$this->session->set_flashdata('msg',$data['errorImageUpload']);
					redirect(base_url().'admin/staff/edit/'.$id);
				}

			}

				if(!empty($this->input->post('password')))
				{
						$form_array['password'] = $this->input->post('password');
				}

				$form_array['type'] = $this->input->post('type');
				$form_array['username'] = $this->input->post('username');
				$form_array['phone_number'] = $this->input->post('phone');
				$form_array['name'] = $this->input->post('name');
				$form_array['email'] = $this->input->post('email');
				$form_array['status'] = $this->input->post('status');
				$form_array['Updated_date'] = date('Y-m-d H:i:s');

				$create = $this->Staff_model->update($id,$form_array);

				if($create){

					$this->session->set_flashdata('success','User Updated Successfully');
					redirect(base_url().'admin/staff/edit/'.$id);

				}else{

					$this->session->set_flashdata('msg','Something Went Wrong');
					redirect(base_url().'admin/staff/edit/'.$id);
				}


		}else{

			$data['category'] = $var;

			$this->load->view('admin/edit-staff',$data);
		}

	}

	public function delete($id)
	{
		$var = $this->Staff_model->get_single_record($id);

		if(empty($var))
		{
			$this->session->set_flashdata('error','User Not Found');
			redirect(base_url().'admin/staff/index');
		}

		if($var['profile_image']!="" && file_exists('./public/uploads/profile/'.$var['profile_image'])){
			unlink('./public/uploads/profile/'.$var['profile_image']);
		}

		if($var['profile_image']!="" && file_exists('./public/uploads/profile/thumb/'.$var['profile_image'])){
			unlink('./public/uploads/profile/thumb/'.$var['profile_image']);
		}

		$delete = $this->Staff_model->delete($id);

		if($delete){

			$this->session->set_flashdata('success',"Successfully Deleted");
			redirect(base_url().'admin/staff/index/');

		}else
		{
			$this->session->set_flashdata('error',"User Not Deleted");
			redirect(base_url().'admin/staff/index/');
		}

	}
}
