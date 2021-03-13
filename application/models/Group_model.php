<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_model extends CI_Model {

	public function create($form_array)
	{
		$insert = $this->db->insert('group',$form_array);
		return $insert;
		
	}

	public function getAllSubCategory()
	{
		$return_subcategory = $this->db->select('*')
		->from('group')
		->join('branch','branch.branch_id = group.branch_id','left')
		->join('admin','admin.id = group.staff_id','left')
		->order_by("group.group_id", "desc")
		->get()->result_array();
		return $return_subcategory;
	}


	function get_single_record($group_id)
	{
		$this->db->where('group_id',$group_id);
		$query = $this->db->get_where('group')->row_array();

		return $query;
	}

	function update_subcategory($group_id,$form_array)
	{
		$this->db->where('group_id',$group_id);
		$update = $this->db->update('group',$form_array);
		return $update;
	}

	function delete_category($group_id)
	{
		$this->db->where('group_id',$group_id);
		$delete = $this->db->delete('group');
		return $delete;
	}

	
}
