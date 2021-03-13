<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_model extends CI_Model {

	public function create($table,$form_array)
	{
		$insert = $this->db->insert($table,$form_array);
		return $insert;
		
	}

	public function getAllrecords($table)
	{
		$return = $this->db->get($table)->result_array();
		return $return;
	}

	function get_single_record($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get_where('admin')->row_array();

		return $query;
	}

	function update($id,$form_array)
	{
		$this->db->where('id',$id);
		$update = $this->db->update('admin',$form_array);
		return $update;
	}

	function delete($id)
	{
		$this->db->where('id',$id);
		$delete = $this->db->delete('admin');
		return $delete;
	}
}
