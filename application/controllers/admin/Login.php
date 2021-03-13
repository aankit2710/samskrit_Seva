<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->library('form_validation');
		$this->load->view('admin/login');
	}

	public function authenticate()
	{
		$this->load->library('form_validation');
		$this->load->model('Admin_model');
		$this->form_validation->set_rules("username","Username","trim|required");
		$this->form_validation->set_rules("password","Password","trim|required");

		if($this->form_validation->run()==true){

			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$admin = $this->Admin_model->getByUsername($username);

			if($admin){

				if($admin['password']==md5($password)){
					$adminArray['admin_id'] = $admin['id'];
					$adminArray['username'] = $admin['username'];
					$this->session->set_userdata('admin',$adminArray);
					redirect(base_url().'admin/home/index');

				}else{
					
					$this->session->set_flashdata('msg','incorrect user detail');
					redirect(base_url().'admin/login/index');
				}

			}else{
				$this->session->set_flashdata('msg','incorrect user detail');
				redirect(base_url().'admin/login/index');
			}

		}else{

			$this->load->view('admin/login');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('admin');
		$this->session->set_flashdata('msg','Successfully Logout');
		redirect(base_url().'admin/login/index');
	}
}
