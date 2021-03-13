<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newspaper_model extends CI_Model {

	public function create($form_array)
	{
		$insert = $this->db->insert('newspaper',$form_array);
		return $insert;
		
	}

	public function getAllnewspaper()
	{
		$return_newspaper = $this->db->select('*')
->from('newspaper')
->join('city','city.city_id = newspaper.city_id')
->get()->result_array();

		// $return_newspaper = $this->db->get('newspaper')->result_array();
		return $return_newspaper;
	}

	public function getAllstates($country_id)
	{
		$this->db->where('country_id',$country_id);
		$return_states = $this->db->get('state')->result_array();
		return $return_states;
	}

	function get_single_record($newspaper_id)
	{
		$this->db->where('newspaper_id',$newspaper_id);
		$query = $this->db->get_where('newspaper')->row_array();

		return $query;
	}

	function update_newspaper($newspaper_id,$form_array)
	{
		$this->db->where('newspaper_id',$newspaper_id);
		$update = $this->db->update('newspaper',$form_array);
		return $update;
	}

	function delete_newspaper($newspaper_id)
	{
		$this->db->where('newspaper_id',$newspaper_id);
		$delete = $this->db->delete('newspaper');
		return $delete;
	}

	
}
