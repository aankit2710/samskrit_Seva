<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Result_model extends CI_Model {


	// public function getAllResult()
	// {						
	// 	$return_category = $this->db->get('loan_approved')->result_array();
	// 	return $return_category;
	// }s

	function update($id,$form_array)
	{
		$this->db->where('id',$id);
		$update = $this->db->update('praksopanam_jan_2021_results',$form_array);
		return $update;

	}


	public function getAllCourse()
	{		
		$query=$this->db->distinct()->select('COURSE')->get('praksopanam_jan_2021_results');
  			return $query->result_array();
	}

	public function getAllResult12()
	{						$this->db->order_by("id", "desc");
		$return_category = $this->db->get('praksopanam_jan_2021_results')->result_array();
		return $return_category;
	}

	public function getAllResult($branch_id)
	{
		$this->db->where('loan_approved.branch_id', $branch_id);
		$this->db->order_by('loan_approved.group_id', 'ASC');
		$this->db->join('branch','branch.branch_id = loan_approved.branch_id','left');
		$this->db->join('group','group.group_id = loan_approved.group_id','left');
		$this->db->join('members','members.member_id = loan_approved.user_id','left');
		$query = $this->db->get('loan_approved');
		$output = '';
		$i=1;
		foreach($query->result() as $row)
		{

			$duedate = date("Y-m-d", strtotime("last week monday"));
			$query1 = $this->db->query("SELECT sum(emi_amount) FROM loan_emi where loan_id='".$row->loan_id."' and emi_status=0 and emi_date<='".$duedate."' ");
			$last_due = $query1->result_array();

			if(!empty($last_due['sum(emi_amount)']))
			{
				$last_due = $last_due['sum(emi_amount)'];
			}else{
				$last_due = 0;
			}

			$this_week = date("Y-m-d", strtotime("this week monday"));
			$query1 = $this->db->query("SELECT sum(emi_amount) FROM loan_emi where loan_id='".$row->loan_id."' and emi_status=0 and emi_date='".$this_week."' ");
			$this_week_amount = $query1->result_array();

			if(!empty($this_week_amount['sum(emi_amount)']))
			{
				$this_week_amount = $this_week_amount['sum(emi_amount)'];
			}else{
				$this_week_amount = 0;
			}

			$output .= '<tr>
			<td>'.$row->group_name.'</td>
			<td>'.$row->member_name.'</td>
			<td>
			'.$row->member_id.'</b>
			</td>
			<td>₹ '.$row->loan_amount.' | ₹ '.$row->intrest_amount.'</td>
			
			<td>'.$row->tenure_week.'</td>
			<td>₹ '.$row->paid_amount.' | ₹ '.$row->due_amount.'</td>
			<td>₹ '.$last_due.' | ₹ '.$this_week_amount.'</td>
			<td>'.date("Y-m-d", strtotime("this week monday")).'</td>
			</tr>';
			$i++;
		}
		return $output;
	}

	public function getAllResult1($month,$year,$course)
	{
		if(!empty($month))
		{
			$this->db->where('month', $month);
		}

		if(!empty($year))
		{
			$this->db->where('year', $year);
		}

		if(!empty($course))
		{
			$this->db->where('COURSE', $course);
		}

		$this->db->order_by('id', 'desc');
		$query = $this->db->get('praksopanam_jan_2021_results')->result_array();
		// print_r($this->db->last_query());
		// exit();
		return $query;
	}
	
}
