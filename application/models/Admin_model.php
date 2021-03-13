<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function getByUsername($username)
	{
		$this->db->where('username',$username);
		$admin = $this->db->get('admin')->row_array();
		// select * from admin where usernane = value
		return $admin;
	}

	public function get_single_record($id)
	{
		$this->db->where('id',$id);
		$admin = $this->db->get('admin')->row_array();
		return $admin;
	}
}
