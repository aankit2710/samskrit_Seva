<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Other_model extends CI_Model {

	public function create($table,$form_array)
	{
		$insert = $this->db->insert($table,$form_array);
		return $insert;
		
	}

	public function getAllExpenses($table)
	{
		$this->db->order_by("created_date","desc");
		$return = $this->db->get($table)->result_array();
		return $return;
	}

	function get_single_record($id)
	{
		$this->db->where('expense_id',$id);
		$query = $this->db->get_where('other_income')->row_array();

		return $query;
	}

	function update($id,$form_array)
	{
		$this->db->where('expense_id',$id);
		$update = $this->db->update('other_income',$form_array);
		return $update;
	}

	function delete($id)
	{
		$this->db->where('expense_id',$id);
		$delete = $this->db->delete('other_income');
		return $delete;
	}
}
