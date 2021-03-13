<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$admin = $this->session->userdata('admin');

		if(empty($admin)){
			$this->session->set_flashdata('msg','Your session has been expired');
			redirect(base_url().'admin/login/index');
		}
		$this->load->model('Admin_model');
		$this->load->library('form_validation');
		$this->load->model('Staff_model');
		$this->load->helper('common_helper');
	}

	public function index()
	{
		// $admin = $this->session->userdata('admin');
		// $members = $this->db->count_all_results('members');
		// $branch = $this->db->count_all_results('branch');
		// $group = $this->db->count_all_results('group');
		// $total_loan = $this->db->count_all_results('loan_approved');
		// $active_total_loan = $this->db->where(array('loan_status' => 0 ))->count_all_results('loan_approved');
		// $this->db->select_sum('loan_amount');
		// $this->db->from('loan_approved');
		// $query = $this->db->get();
		// $query->row()->loan_amount;

		// $this->db->select_sum('total_intrest');
		// $this->db->from('loan_approved');
		// $query1 = $this->db->get();
		// $query1->row()->total_intrest;

		// $this->db->select_sum('emi_amount');
		// $this->db->from('loan_emi');
		// $this->db->where('(emi_status = 1) ');
		// $query2 = $this->db->get();
		// $query2->row()->emi_amount;

		// $this->db->select_sum('emi_amount');
		// $this->db->from('loan_emi');
		// $this->db->where('(emi_status = 0) ');
		// $query3 = $this->db->get();
		// $query3->row()->emi_amount;

		// $this->db->select_sum('amount');
		// $this->db->from('expenses');
		// $query4 = $this->db->get();
		// $query4->row()->amount;

		// $this->db->select_sum('amount');
		// $this->db->from('other_income');
		// $query5 = $this->db->get();
		// $query5->row()->amount;

		// $output = array("members"=>$members,"branch"=>$branch,"group"=>$group,"total_loan_amount"=>$query->row()->loan_amount,"total_intrest"=>$query1->row()->total_intrest,"emi_amount"=>$query2->row()->emi_amount,"pending_amount"=>$query3->row()->emi_amount,"total_loan"=>$total_loan,"active_total_loan"=>$active_total_loan,"total_expense"=>$query4->row()->amount,"other_income"=>$query5->row()->amount);
		// $data['output'] = $output;
		$this->load->view('admin/index');
	}


	public function profile()
	{
		$var = $this->Admin_model->get_single_record(1);

		if(empty($var))
		{
			$this->session->set_flashdata('error','Center Not Found');
			redirect(base_url().'admin/home/profile');
		}

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
		$this->form_validation->set_rules("name","Name","trim|required");

		if($this->form_validation->run()==true){

			if(!empty($_FILES['image']['name']))
			{

				if($this->upload->do_upload('image'))
				{

					if($var['image']!="" && file_exists('./public/uploads/profile/'.$var['image'])){
						unlink('./public/uploads/profile/'.$var['image']);
					}

					if($var['image']!="" && file_exists('./public/uploads/profile/thumb/'.$var['image'])){
						unlink('./public/uploads/profile/thumb/'.$var['image']);
					}


					$data = $this->upload->data();
					resizeImage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb/'.$data['file_name'],300,270); 
					$form_array['profile_image'] = $data['file_name'];

				}else{

					$error = $this->upload->display_errors();
					$data['errorImageUpload'] = $error;
					$this->session->set_flashdata('msg',$data['errorImageUpload']);
					redirect(base_url().'admin/home/profile/1');
				}

			}	

			if(!empty($this->input->post('protection_password')))
			{
				$form_array['protection_password'] = md5($this->input->post('protection_password'));
			}

			if(!empty($this->input->post('password')))
			{
				if($this->input->post('password')==$this->input->post('cpassword'))
				{
					$form_array['password'] = md5($this->input->post('password'));
				}else{
					$this->session->set_flashdata('msg',"Confirm Password not Match");
					redirect(base_url().'admin/home/profile/1');
				}
			}

			$form_array['name'] = $this->input->post('name');
			$form_array['username'] = $this->input->post('username');
			$form_array['email'] = $this->input->post('email');
			$form_array['phone_number'] = $this->input->post('phone');
			$form_array['status'] = $this->input->post('status');
			$form_array['updated_date'] = date('Y-m-d H:i:s');

			$create = $this->Staff_model->update(1,$form_array);

			if($create){

				$this->session->set_flashdata('success','Profile Updated Successfully');
				redirect(base_url().'admin/home/profile/1');

			}else{

				$this->session->set_flashdata('msg','Something Went Wrong');
				redirect(base_url().'admin/home/profile/1');
			}

		}else{

			$data['profile'] = $var;

			$this->load->view('admin/profile',$data);
		}
	}

}
