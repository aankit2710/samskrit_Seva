<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {


	// public function getAllResult()
	// {						
	// 	$return_category = $this->db->get('loan_approved')->result_array();
	// 	return $return_category;
	// }s

	function update($id,$form_array)
	{
		$this->db->where('student_profile_id',$id);
		$update = $this->db->update('wp_an34bk_student_profile',$form_array);
		return $update;

	}


	public function getAllResult12()
	{						$this->db->order_by("student_profile_id", "desc");
		$return_category = $this->db->select('*')
		->from('wp_an34bk_student_course_info i')
		->join('wp_an34bk_student_profile p','p.student_profile_id = i.student_course_student_id',"inner")
		->get()->result_array();
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

		$this->db->order_by('student_profile_id', 'desc');
		$query = $this->db->get('wp_an34bk_student_profile')->result_array();
		return $query;
	}
	
}
