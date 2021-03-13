<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donation_model extends CI_Model {


	// public function getAllResult()
	// {						
	// 	$return_category = $this->db->get('loan_approved')->result_array();
	// 	return $return_category;
	// }s

	function update($id,$form_array)
	{
		$this->db->where('id',$id);
		$update = $this->db->update('ss_main_donations',$form_array);
		return $update;

	}


	public function getAllCourse()
	{		
		$query=$this->db->distinct()->select('COURSE')->get('ss_main_donations');
  			return $query->result_array();
	}

	public function getAllResult12()
	{						$this->db->order_by("donations_id", "desc");
		$return_category = $this->db->get('ss_main_donations')->result_array();
		return $return_category;
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
		$query = $this->db->get('ss_main_donations')->result_array();
		return $query;
	}
	
}
