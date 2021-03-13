<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model {

	public function create($form_array)
	{
		$insert = $this->db->insert('members',$form_array);
		return $insert;
		
	}

	public function getAllBrands()
	{
		$return_product = $this->db->select('m.*,b.branch_name,g.group_name')
		->from('members m')
		->join('branch b','b.branch_id = m.branch_id',"left")
		->join('group g','g.group_id = m.group_id',"left")
		->group_by('m.member_id')
		->order_by("m.member_id", "desc")
		->get()->result_array();
		return $return_product;
	}

	public function getAllEmi($user_id,$loan_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->where('loan_id', $loan_id);
		$return_emi = $this->db->get('loan_emi')->result_array();
		return $return_emi;
	}

	public function getLoan($user_id)
	{
		$this->db->where('user_id', $user_id);
		$return_loan = $this->db->get('loan_approved')->result_array();
		return $return_loan;
	}

	public function getsingleLoan($loan_id)
	{
		$this->db->where('loan_id', $loan_id);
		$return_singleloan = $this->db->get('loan_approved')->row_array();
		return $return_singleloan;
	}

	public function get_single_loan($emi_id)
	{
		$this->db->where('emi_id', $emi_id);
		$return_singleloan_id = $this->db->get('loan_emi')->row_array();
		return $return_singleloan_id;
	}

	public function result($form_array, $select_type)
	{
		if ( $select_type === 'result')
		{
			$table_name = "praksopanam_jan_2021_results";
		}
		else if ( $select_type === 'failed')
		{
			$table_name = "praksopanam_jan_2021_results";
		}
		else if ( $select_type === 'reappear')
		{
			$table_name = "praksopanam_jan_2021_results";
		}
		$insert = $this->db->insert($table_name,$form_array);
		return $this->db->insert_id();
	}

	public function loan_emi($form_array)
	{
		$insert = $this->db->insert('loan_emi',$form_array);
		return $this->db->insert_id();
	}


	function get_single_record($member_id)
	{
		$this->db->where('member_id',$member_id);
		$query = $this->db->get_where('members')->row_array();

		return $query;
	}

	function single_loan($loan_id){
		$this->db->where('loan_id',$loan_id);
		$query = $this->db->get_where('loan_approved')->row_array();
		return $query;
	}

	function update_brand($member_id,$form_array)
	{
		$this->db->where('member_id',$member_id);
		$update = $this->db->update('members',$form_array);
		return $update;
	}

	public function delete_brands($member_id)
	{
		$this->db->where('member_id',$member_id);
		$delete = $this->db->delete('members');
		return $delete;
	}

	public function delete_loan($user_id)
	{
		$this->db->where('user_id',$user_id);
		$delete = $this->db->delete('loan_approved');
		return $delete;
	}

	public function delete_emis($user_id)
	{
		$this->db->where('user_id',$user_id);
		$delete = $this->db->delete('loan_emi');
		return $delete;
	}

	public function delete_loan1($loan_id)
	{
		$this->db->where('loan_id',$loan_id);
		$delete = $this->db->delete('loan_approved');
		return $delete;
	}

	public function delete_emis1($loan_id)
	{
		$this->db->where('loan_id',$loan_id);
		$delete = $this->db->delete('loan_emi');
		return $delete;
	}

	public function emi_status($emi_id,$form_array)
	{
		$this->db->where('emi_id',$emi_id);
		$update = $this->db->update('loan_emi',$form_array);
		return $update;
	}

	public function loan_status($loan_id,$form_array2)
	{
		$this->db->where('loan_id',$loan_id);
		$update = $this->db->update('loan_approved',$form_array2);
		return $update;
	}

	
}
