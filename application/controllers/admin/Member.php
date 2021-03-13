<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$admin = $this->session->userdata('admin');

		$this->load->helper('common_helper');
		$this->load->model('Member_model');
		$this->load->model('Branch_model');
		$this->load->model('Dynamic_dependent_model');
		$this->load->library('form_validation');
		$this->load->model('Admin_model');
		

		if(empty($admin)){
			$this->session->set_flashdata('msg','Your session has been expired');
			redirect(base_url().'admin/login/index');
		}
	}

	public function index()
	{
		$getAllBrands = $this->Member_model->getAllBrands();
		$data['getAllBrands'] = $getAllBrands;
		$this->load->view('admin/manage-member',$data);
	}


	public function create()
	{

		$config['upload_path']          = './public/uploads/member/';
		$config['allowed_types']        = 'gif|jpg|png|pdf|pdf';
		$config['encrypt_name']         =  true;

		$thumb_path          = './public/uploads/member/thumb/';

		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0777, TRUE);
		}

		if (!is_dir($thumb_path)) {
			mkdir($thumb_path, 0777, TRUE);
		}


		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
		$this->form_validation->set_rules("member_name","Member Name","trim|required");
		$this->form_validation->set_rules("member_phone","Member Phone","trim");
		// $this->form_validation->set_rules("member_name","Member Name","trim|required");
		// $this->form_validation->set_rules("member_phone","Member Phone","trim|required");
		// $this->form_validation->set_rules("member_name","Member Name","trim|required");
		// $this->form_validation->set_rules("member_phone","Member Phone","trim|required");
		// $this->form_validation->set_rules("member_name","Member Name","trim|required");
		// $this->form_validation->set_rules("member_phone","Member Phone","trim|required");
		// $this->form_validation->set_rules("member_name","Member Name","trim|required");
		// $this->form_validation->set_rules("member_phone","Member Phone","trim|required");

		if($this->form_validation->run()==true){

			if(!empty($_FILES['front_image']['name']))
			{

				if($this->upload->do_upload('front_image'))
				{
					$data = $this->upload->data();
					$form_array['front_image'] = $data['file_name'];

				}else{

					$error = $this->upload->display_errors();
					$data['errorImageUpload'] = $error."Please Upload JPG/JPEG/PDF File Only.";
					$this->session->set_flashdata('msg',$data['errorImageUpload']);
					redirect(base_url().'admin/member/create');
				}
			}

			if(!empty($_FILES['back_image']['name']))
			{

				if($this->upload->do_upload('back_image'))
				{
					$data1 = $this->upload->data();
					$form_array['back_image'] = $data1['file_name'];

				}else{

					$error = $this->upload->display_errors();
					$data['errorImageUpload'] = $error."Please Upload JPG/JPEG/PDF File Only.";
					$this->session->set_flashdata('msg',$data['errorImageUpload']);
					redirect(base_url().'admin/member/create');
				}
			}

			if(!empty($_FILES['spouse_doc1']['name']))
			{

				if($this->upload->do_upload('spouse_doc1'))
				{
					$data2 = $this->upload->data();
					$form_array['spouse_doc1'] = $data2['file_name'];

				}else{

					$error = $this->upload->display_errors();
					$data['errorImageUpload'] = $error."Please Upload JPG/JPEG/PDF File Only.";
					$this->session->set_flashdata('msg',$data['errorImageUpload']);
					redirect(base_url().'admin/member/create');
				}
			}

			if(!empty($_FILES['spouse_doc2']['name']))
			{

				if($this->upload->do_upload('spouse_doc2'))
				{
					$data3 = $this->upload->data();
					$form_array['spouse_doc2'] = $data3['file_name'];

				}else{

					$error = $this->upload->display_errors();
					$data['errorImageUpload'] = $error."Please Upload JPG/JPEG/PDF File Only.";
					$this->session->set_flashdata('msg',$data['errorImageUpload']);
					redirect(base_url().'admin/member/create');
				}
			}

			$form_array['branch_id'] = $this->input->post('branch_id');
			$form_array['group_id'] = $this->input->post('group_id');
			$form_array['member_name'] = $this->input->post('member_name');
			$form_array['member_phone'] = $this->input->post('member_phone');
			// $form_array['alt_phone'] = $this->input->post('alt_phone');
			// $form_array['member_email'] = $this->input->post('member_email');
			$form_array['marital_status'] = $this->input->post('marital_status');
			$form_array['member_dob'] = $this->input->post('member_dob');
			$form_array['gender'] = $this->input->post('gender');
			$form_array['address'] = $this->input->post('address');
			$form_array['address2'] = $this->input->post('address2');
			$form_array['landmark'] = $this->input->post('landmark');
			$form_array['town'] = $this->input->post('town');
			$form_array['city'] = $this->input->post('city');
			$form_array['state'] = $this->input->post('state');
			$form_array['pincode'] = $this->input->post('pincode');
			$form_array['kyc_type'] = $this->input->post('kyc_type');
			$form_array['doc_number'] = $this->input->post('doc_number');
			$form_array['spouse_kyc_type'] = $this->input->post('spouse_kyc_type');
			$form_array['spouse_doc_number'] = $this->input->post('spouse_doc_number');
			$form_array['spouse_name'] = $this->input->post('spouse_name');
			$form_array['spouse_dob'] = $this->input->post('spouse_dob');
			$form_array['status'] = $this->input->post('status');
			$form_array['created_date'] = date('Y-m-d H:i:s');

			$create = $this->Member_model->create($form_array);

			if($create){

				$this->session->set_flashdata('success','Member Inserted Successfully');
				redirect(base_url().'admin/member/create');

			}else{

				$this->session->set_flashdata('msg','Something Went Wrong');
				redirect(base_url().'admin/member/create');
			}

		}else{

			$allCategory = $this->Branch_model->getAllCategory();
			$data['allCategory'] = $allCategory;
			$data['State'] = $this->Dynamic_dependent_model->fetch_state();
			$this->load->view('admin/add-member',$data);
		}
	}

	public function edit($user_id)
	{	
		$var = $this->Member_model->get_single_record($user_id);

		if(empty($var))
		{
			$this->session->set_flashdata('error','Member Not Found');
			redirect(base_url().'admin/member/index');
		}

		$config['upload_path']          = './public/uploads/member/';
		$config['allowed_types']        = 'gif|jpg|png|pdf';
		$config['encrypt_name']         =  true;

		$thumb_path          = './public/uploads/member/thumb/';

		if (!is_dir($config['upload_path'])) {
			mkdir($config['upload_path'], 0777, TRUE);
		}

		if (!is_dir($thumb_path)) {
			mkdir($thumb_path, 0777, TRUE);
		}


		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
		$this->form_validation->set_rules("member_name","Member Name","trim|required");
		$this->form_validation->set_rules("member_phone","Member Phone","trim|required");
		// $this->form_validation->set_rules("member_name","Member Name","trim|required");
		// $this->form_validation->set_rules("member_name","Member Name","trim|required");

		if($this->form_validation->run()==true){

			if(!empty($_FILES['front_image']['name']))
			{

				if($this->upload->do_upload('front_image'))
				{
					if($var['front_image']!="" && file_exists('./public/uploads/member/'.$var['front_image'])){
						unlink('./public/uploads/member/'.$var['front_image']);
					}

					$data = $this->upload->data();
					$form_array['front_image'] = $data['file_name'];
				}else{

					$error = $this->upload->display_errors();
					$data['errorImageUpload'] = $error."Please Upload JPG/JPEG/PDF File Only.";
					$this->session->set_flashdata('msg',$data['errorImageUpload']);
					redirect(base_url().'admin/member/edit/'.$user_id);
				}

			}

			if(!empty($_FILES['back_image']['name']))
			{

				if($this->upload->do_upload('back_image'))
				{
					if($var['back_image']!="" && file_exists('./public/uploads/member/'.$var['back_image'])){
						unlink('./public/uploads/member/'.$var['back_image']);
					}

					$data1 = $this->upload->data();
					$form_array['back_image'] = $data1['file_name'];
				}else{

					$error = $this->upload->display_errors();
					$data['errorImageUpload'] = $error."Please Upload JPG/JPEG/PDF File Only.";
					$this->session->set_flashdata('msg',$data['errorImageUpload']);
					redirect(base_url().'admin/member/edit/'.$user_id);
				}

			}

			if(!empty($_FILES['spouse_doc1']['name']))
			{

				if($this->upload->do_upload('spouse_doc1'))
				{
					if($var['spouse_doc1']!="" && file_exists('./public/uploads/member/'.$var['spouse_doc1'])){
						unlink('./public/uploads/member/'.$var['spouse_doc1']);
					}

					$data2 = $this->upload->data();
					$form_array['spouse_doc1'] = $data2['file_name'];

				}else{

					$error = $this->upload->display_errors();
					$data['errorImageUpload'] = $error."Please Upload JPG/JPEG/PDF File Only.";
					$this->session->set_flashdata('msg',$data['errorImageUpload']);
					redirect(base_url().'admin/member/edit/'.$user_id);
				}

			}


			if(!empty($_FILES['spouse_doc2']['name']))
			{

				if($this->upload->do_upload('spouse_doc2'))
				{
					if($var['spouse_doc2']!="" && file_exists('./public/uploads/member/'.$var['spouse_doc2'])){
						unlink('./public/uploads/member/'.$var['spouse_doc2']);
					}

					$data3 = $this->upload->data();
					$form_array['spouse_doc2'] = $data3['file_name'];

				}else{

					$error = $this->upload->display_errors();
					$data3['errorImageUpload'] = $error."Please Upload JPG/JPEG/PDF File Only.";
					$this->session->set_flashdata('msg',$data3['errorImageUpload']);
					redirect(base_url().'admin/member/edit/'.$user_id);
				}

			}

			$form_array['branch_id'] = $this->input->post('branch_id');
			$form_array['group_id'] = $this->input->post('group_id');
			$form_array['member_name'] = $this->input->post('member_name');
			$form_array['member_phone'] = $this->input->post('member_phone');
			// $form_array['alt_phone'] = $this->input->post('alt_phone');
			// $form_array['member_email'] = $this->input->post('member_email');
			$form_array['marital_status'] = $this->input->post('marital_status');
			$form_array['member_dob'] = $this->input->post('member_dob');
			$form_array['gender'] = $this->input->post('gender');
			$form_array['address'] = $this->input->post('address');
			$form_array['address2'] = $this->input->post('address2');
			$form_array['landmark'] = $this->input->post('landmark');
			$form_array['town'] = $this->input->post('town');
			$form_array['city'] = $this->input->post('city');
			$form_array['state'] = $this->input->post('state');
			$form_array['pincode'] = $this->input->post('pincode');
			$form_array['kyc_type'] = $this->input->post('kyc_type');
			$form_array['doc_number'] = $this->input->post('doc_number');
			$form_array['spouse_kyc_type'] = $this->input->post('spouse_kyc_type');
			$form_array['spouse_doc_number'] = $this->input->post('spouse_doc_number');
			$form_array['spouse_name'] = $this->input->post('spouse_name');
			$form_array['spouse_dob'] = $this->input->post('spouse_dob');
			$form_array['status'] = $this->input->post('status');
			$form_array['created_date'] = date('Y-m-d H:i:s');

			$create = $this->Member_model->update_brand($user_id,$form_array);

			if($create){

				$this->session->set_flashdata('success','Member Updated Successfully');
				redirect(base_url().'admin/member/edit/'.$user_id);

			}else{

				$this->session->set_flashdata('msg','Something Went Wrong');
				redirect(base_url().'admin/member/edit/'.$user_id);
			}

		}else{

			$data['edit_member'] = $var;
			$allCategory = $this->Branch_model->getAllCategory();
			$data['allCategory'] = $allCategory;
			$data['State'] = $this->Dynamic_dependent_model->fetch_state();
			// print_r($data['State']);
			// exit();
			$this->load->view('admin/edit-member',$data);
		}

	}

	public function loanproposal($user_id)
	{	
		$var = $this->Member_model->get_single_record($user_id);

		if(empty($var))
		{
			$this->session->set_flashdata('error','Member Not Found');
			redirect(base_url().'admin/member/index');
		}

		$this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
		$this->form_validation->set_rules("loan_amount","Loan Amount","trim|required");


		if($this->form_validation->run()==true){

			$form_array['branch_id'] = $this->input->post('branch_id');
			$form_array['group_id'] = $this->input->post('group_id');
			$form_array['loan_amount'] = $this->input->post('loan_amount');
			$form_array['loan_name'] = $this->input->post('loan_name');
			$form_array['tenure'] = $this->input->post('tenure_id');
			$form_array['proposal_date'] = $this->input->post('proposal_date');
			$form_array['intrest_amount'] = $this->input->post('to_pay');
			$form_array['total_intrest'] = $this->input->post('total_intrest');
			$form_array['intrest_percent'] = $this->input->post('intrest_percent');
			$form_array['tenure'] = $this->input->post('tenure_month');
			$form_array['tenure_week'] = $this->input->post('tenure_week');
			$form_array['loan_status'] = 0;
			$form_array['user_id'] = $user_id;			
			$form_array['created_date'] = date('Y-m-d H:i:s');
			$form_array['updated_date'] = date('Y-m-d H:i:s');
			$form_array['paid_amount'] = 0;
			$form_array['due_amount'] = $this->input->post('to_pay');

			$last_id = $this->Member_model->loan_approved($form_array);

			if($last_id){


				$form_array2 = array();
				$k=1;
				$emi_amount = ceil($form_array['intrest_amount']/$form_array['tenure_week']);
				$sunday = strtotime($this->input->post('next_emi_date'));
				while($k<=$form_array['tenure_week']){

					if($k==1){
						// $sunday = strtotime("next sunday");
						// $sunday = date('W', $sunday)==date('W') ? $sunday+7*86400 : $sunday;
						$this_week_sd = $this->input->post('next_emi_date');

					}else{

						$sunday = strtotime(date("Y-m-d",$sunday)." +7 days");
						$this_week_sd = date("Y-m-d",$sunday);
					}

					$form_array2['user_id'] = $user_id;
					$form_array2['loan_id'] = $last_id;
					$form_array2['emi_count'] = $k;
					$form_array2['branch_id'] = $this->input->post('branch_id');
					$form_array2['group_id'] = $this->input->post('group_id');
					$form_array2['emi_amount'] = $emi_amount;
					$form_array2['emi_date'] = $this_week_sd;
					$form_array2['created_date'] = date("Y-m-d H:i:s");
					// $form_array2['updated_date'] = date("Y-m-d H:i:s");
					$create = $this->Member_model->loan_emi($form_array2);
					$k++;
				}

				$this->session->set_flashdata('success','Member Updated Successfully');
				redirect(base_url().'admin/member/loanproposal/'.$user_id);

			}else{

				$this->session->set_flashdata('msg','Something Went Wrong');
				redirect(base_url().'admin/member/loanproposal/'.$user_id);
			}

		}else{

			$data['edit_member'] = $var;
			$allCategory = $this->Branch_model->getAllCategory();
			$data['allCategory'] = $allCategory;
			$getLoan = $this->Member_model->getLoan($user_id);
			$data['getLoan'] = $getLoan;

			$this->load->view('admin/loanproposal',$data);
		}

	}

	public function delete($user_id,$password)
	{
		$admin = $this->Admin_model->get_single_record(1);

		if($admin['protection_password']!=md5($password))
		{
			$this->session->set_flashdata('error','Password Not Matched');
			redirect(base_url().'admin/member/index');
		}

		$var = $this->Member_model->get_single_record($user_id);

		if(empty($var))
		{
			$this->session->set_flashdata('error','Member Not Found');
			redirect(base_url().'admin/member/index');
		}

		if($var['front_image']!="" && file_exists('./public/uploads/member/'.$var['front_image'])){
			unlink('./public/uploads/member/'.$var['front_image']);
		}


		if($var['back_image']!="" && file_exists('./public/uploads/member/'.$var['back_image'])){
			unlink('./public/uploads/member/'.$var['back_image']);
		}


		if($var['spouse_doc1']!="" && file_exists('./public/uploads/member/'.$var['spouse_doc1'])){
			unlink('./public/uploads/member/'.$var['spouse_doc1']);
		}

		if($var['spouse_doc2']!="" && file_exists('./public/uploads/member/'.$var['spouse_doc2'])){
			unlink('./public/uploads/member/'.$var['spouse_doc2']);
		}

		$delete = $this->Member_model->delete_brands($user_id);
		$delete = $this->Member_model->delete_loan($user_id);
		$delete = $this->Member_model->delete_emis($user_id);

		if($delete){

			$this->session->set_flashdata('success',"Successfully Deleted");
			redirect(base_url().'admin/member/index/');

		}else
		{
			$this->session->set_flashdata('error',"Brands Not Deleted");
			redirect(base_url().'admin/member/index/');
		}

	}

	public function fetch_groups()
	{
		if($this->input->post('branch_id'))
		{
			echo $this->Dynamic_dependent_model->fetch_group($this->input->post('branch_id'),$this->input->post('selected_val'));
		}
	}

	public function fetch_count()
	{
		$group_id = $this->input->post('group_id');
		$count = $this->db->where(array('group_id' => $group_id))->count_all_results('members');
		$output = array("count"=>$count);
		echo json_encode($output);
	}

	public function pay_emi()
	{
		$emi_id = $this->input->post('emi_id');
		$user_id = $this->input->post('user_id');
		$loan_id = $this->input->post('loan_id');
		$amount = $this->input->post('amount');

		$single_loan = $this->Member_model->single_loan($loan_id);

		if($single_loan['paid_amount']>=$single_loan['intrest_amount'])
		{
			$form_array2['loan_status'] = 1;
		}

		$form_array2['due_amount'] = $single_loan['due_amount']-$amount;
		$form_array2['paid_amount'] = $single_loan['paid_amount']+$amount;

		$create1 = $this->Member_model->loan_status($loan_id,$form_array2);

		if($create1)
		{
			$single_loan = $this->Member_model->single_loan($loan_id);

			if($single_loan['paid_amount']>=$single_loan['intrest_amount'])
			{
				$form_array2['loan_status'] = 1;
				$create1 = $this->Member_model->loan_status($loan_id,$form_array2);
			}

		}

		$form_array['updated_date'] = date('Y-m-d H:i:s');
		$form_array['emi_status'] = 1;
		$create = $this->Member_model->emi_status($emi_id,$form_array);
	}

	public function emi($loan_id,$user_id)
	{
		$loan_id = $loan_id;
		$user_id = $user_id;
		$var = $this->Member_model->get_single_record($user_id);
		$data['edit_member'] = $var;

		$getAllEmi = $this->Member_model->getAllEmi($user_id,$loan_id);
		$getsingleLoan = $this->Member_model->getsingleLoan($loan_id);
		$data['getsingleLoan'] = $getsingleLoan;

		$data['emi_list'] = $getAllEmi;
		$data['loan_id'] = $loan_id;
		$this->load->view('admin/emi',$data);
	}

	public function pay_emi_bulk()
	{
		$emi_ids = @$_REQUEST['emi_ids'];

		$i=0;
		while($i<=count($emi_ids)){

			$emi_id = $emi_ids[$i];
			$getsingle_loan = $this->Member_model->get_single_loan($emi_id);

			$loan_id = $getsingle_loan['loan_id'];

			$single_loan = $this->Member_model->single_loan($loan_id);

			if($single_loan['paid_amount']>=$single_loan['intrest_amount'])
			{
				$form_array2['loan_status'] = 1;
			}

			$form_array2['due_amount'] = $single_loan['due_amount']-$getsingle_loan['emi_amount'];
			$form_array2['paid_amount'] = $single_loan['paid_amount']+$getsingle_loan['emi_amount'];

			$create1 = $this->Member_model->loan_status($loan_id,$form_array2);

			if($create1)
			{
				$single_loan = $this->Member_model->single_loan($loan_id);

				if($single_loan['paid_amount']>=$single_loan['intrest_amount'])
				{
					$form_array2['loan_status'] = 1;
					$create1 = $this->Member_model->loan_status($loan_id,$form_array2);
				}

			}

			$form_array['updated_date'] = date('Y-m-d H:i:s');
			$form_array['emi_status'] = 1;
			$create = $this->Member_model->emi_status($emi_id,$form_array);

			$i++;
		}
	}

	public function delete_loan($loan_id,$password)
	{
		$admin = $this->Admin_model->get_single_record(1);

		$var = $this->Member_model->single_loan($loan_id);

		if($admin['protection_password']!=md5($password))
		{
			$this->session->set_flashdata('error','Password Not Matched');
			redirect(base_url().'admin/member/loanproposal/'.$var['user_id']);
		}

		if(empty($var))
		{
			$this->session->set_flashdata('error','Loan Not Found');
			redirect(base_url().'admin/member/loanproposal/'.$var['user_id']);
		}

		
		$delete = $this->Member_model->delete_loan1($loan_id);
		$delete = $this->Member_model->delete_emis1($loan_id);

		if($delete){

			$this->session->set_flashdata('success',"Successfully Deleted");
			redirect(base_url().'admin/member/loanproposal/'.$var['user_id']);

		}else
		{
			$this->session->set_flashdata('error',"Brands Not Deleted");
			redirect(base_url().'admin/member/loanproposal/'.$var['user_id']);
		}
	}
}
