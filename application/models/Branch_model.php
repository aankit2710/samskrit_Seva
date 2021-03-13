<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch_model extends CI_Model {

	public function create($form_array)
	{
		$insert = $this->db->insert('branch',$form_array);
		return $insert;
		
	}

	public function getAllCategory()
	{						$this->db->order_by("id", "desc");
		$return_category = $this->db->get('praksopanam_jan_2021_results')->result_array();
		return $return_category;
	}


	function get_single_record($branch_id)
	{
		$this->db->where('branch_id',$branch_id);
		$query = $this->db->get_where('branch')->row_array();

		return $query;
	}

	function update_category($branch_id,$form_array)
	{
		$this->db->where('branch_id',$branch_id);
		$update = $this->db->update('branch',$form_array);
		return $update;
	}

	function delete_category($branch_id)
	{
		$this->db->where('branch_id',$branch_id);
		$delete = $this->db->delete('branch');
		return $delete;
	}

	
}
