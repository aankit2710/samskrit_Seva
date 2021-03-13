<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_model extends CI_Model {


	function update($id,$form_array)
	{
		$this->db->where('id',$id);
		$update = $this->db->update('praksopanam_jan_2021_Courses',$form_array);
		return $update;

	}


	public function getAllCourse()
	{		
		$query=$this->db->distinct()->select('COURSE')->get('praksopanam_jan_2021_Courses');
  			return $query->result_array();
	}


	public function getAllCourse12()
	{
		$return_product = $this->db->select('*')
		->from('wp_an34bk_student_course_info i')
		->join('wp_an34bk_student_profile p','p.student_profile_id = i.student_course_student_id',"inner")
		->get()->result_array();
		return $return_product;
	}
	
}
