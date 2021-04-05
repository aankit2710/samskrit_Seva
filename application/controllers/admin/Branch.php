<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$admin = $this->session->userdata('admin');

		$this->load->helper('common_helper');
		$this->load->model('Branch_model');
		$this->load->library('form_validation');
		$this->load->model('Admin_model');

		if(empty($admin)){
			$this->session->set_flashdata('msg','Your session has been expired');
			redirect(base_url().'admin/login/index');
		}
	}

	public function index()
	{
		
		$admin = $this->session->userdata('admin');
		$data['type'] = $admin['type'];
		$allCategory = $this->Branch_model->getAllCategory();
		$data['allCategory'] = $allCategory;
		$this->load->view('admin/manage-branch',$data);
	}


	public function create()
	{

		$config['upload_path']          = './public/uploads/branch/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['encrypt_name']         =  true;


		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
		$this->form_validation->set_rules("branch_name","Category Name","trim|required");

		if($this->form_validation->run()==true){

			if(!empty($_FILES['image']['name']))
			{

				if($this->upload->do_upload('image'))
				{
					$data = $this->upload->data();
					resizeImage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb/'.$data['file_name'],300,270); 

					$form_array['image'] = $data['file_name'];
					$form_array['branch_name'] = $this->input->post('branch_name');
					$form_array['status'] = $this->input->post('status');
					$form_array['created_date'] = date('Y-m-d');

					$create = $this->Branch_model->create($form_array);

					if($create){

						$this->session->set_flashdata('success','Center Inserted Successfully');
						redirect(base_url().'admin/branch/create');

					}else{

						$this->session->set_flashdata('msg','Something Went Wrong');
						redirect(base_url().'admin/branch/create');
					}

				}else{

					$error = $this->upload->display_errors();
					$data['errorImageUpload'] = $error;
					$this->session->set_flashdata('msg',$data['errorImageUpload']);
					redirect(base_url().'admin/branch/create');
				}

			}else{

				$form_array['branch_name'] = $this->input->post('branch_name');
				$form_array['status'] = $this->input->post('status');
				$form_array['created_date'] = date('Y-m-d');

				$create = $this->Branch_model->create($form_array);

				if($create){

					$this->session->set_flashdata('success','Center Inserted Successfully');
					redirect(base_url().'admin/branch/create');

				}else{

					$this->session->set_flashdata('msg','Something Went Wrong');
					redirect(base_url().'admin/branch/create');
				}
			}

		}else{
			$this->load->view('admin/add-branch');
		}
	}

	public function edit($category_id)
	{	
		$var = $this->Branch_model->get_single_record($category_id);

		if(empty($var))
		{
			$this->session->set_flashdata('error','Center Not Found');
			redirect(base_url().'admin/branch/index');
		}

		$config['upload_path']          = './public/uploads/branch/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['encrypt_name']         =  true;


		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
		$this->form_validation->set_rules("branch_name","Category Name","trim|required");

		if($this->form_validation->run()==true){

			if(!empty($_FILES['image']['name']))
			{

				if($this->upload->do_upload('image'))
				{

					if($var['image']!="" && file_exists('./public/uploads/branch/'.$var['image'])){
						unlink('./public/uploads/branch/'.$var['image']);
					}

					if($var['image']!="" && file_exists('./public/uploads/branch/thumb/'.$var['image'])){
						unlink('./public/uploads/branch/thumb/'.$var['image']);
					}


					$data = $this->upload->data();
					resizeImage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb/'.$data['file_name'],300,270); 

					$form_array['image'] = $data['file_name'];
					$form_array['branch_name'] = $this->input->post('branch_name');
					$form_array['status'] = $this->input->post('status');
					$form_array['created_date'] = date('Y-m-d');

					$create = $this->Branch_model->update_category($category_id,$form_array);

					if($create){

						$this->session->set_flashdata('success','Center Updated Successfully');
						redirect(base_url().'admin/branch/edit/'.$category_id);

					}else{

						$this->session->set_flashdata('msg','Something Went Wrong');
						redirect(base_url().'admin/branch/edit/'.$category_id);
					}

				}else{

					$error = $this->upload->display_errors();
					$data['errorImageUpload'] = $error;
					$this->session->set_flashdata('msg',$data['errorImageUpload']);
					redirect(base_url().'admin/branch/edit/'.$category_id);
				}

			}else{

				$form_array['branch_name'] = $this->input->post('branch_name');
				$form_array['status'] = $this->input->post('status');
				$form_array['created_date'] = date('Y-m-d');

				$create = $this->Branch_model->update_category($category_id,$form_array);

				if($create){

					$this->session->set_flashdata('success','Center Updated Successfully');
					redirect(base_url().'admin/branch/edit/'.$category_id);

				}else{

					$this->session->set_flashdata('msg','Something Went Wrong');
					redirect(base_url().'admin/branch/edit/'.$category_id);
				}
			}

		}else{

			$data['category'] = $var;

			$this->load->view('admin/edit-branch',$data);
		}

	}

	public function delete($category_id,$password)
	{
		$admin = $this->Admin_model->get_single_record(1);

		if($admin['protection_password']!=md5($password))
		{
			$this->session->set_flashdata('error','Password Not Matched');
			redirect(base_url().'admin/branch/index');
		}

		$var = $this->Branch_model->get_single_record($category_id);

		if(empty($var))
		{
			$this->session->set_flashdata('error','Center Not Found');
			redirect(base_url().'admin/branch/index');
		}

		if($var['image']!="" && file_exists('./public/uploads/branch/'.$var['image'])){
			unlink('./public/uploads/branch/'.$var['image']);
		}

		if($var['image']!="" && file_exists('./public/uploads/branch/thumb/'.$var['image'])){
			unlink('./public/uploads/branch/thumb/'.$var['image']);
		}

		$delete = $this->Branch_model->delete_category($category_id);

		if($delete){

			$this->session->set_flashdata('success',"Successfully Deleted");
			redirect(base_url().'admin/branch/index/');

		}else
		{
			$this->session->set_flashdata('error',"Category Not Deleted");
			redirect(base_url().'admin/branch/index/');
		}

	}
}
