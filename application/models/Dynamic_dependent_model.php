<?php
class Dynamic_dependent_model extends CI_Model
{

 function fetch_state()
 {
    $this->db->order_by("name", "ASC");
     $this->db->where("country_id", "101");
    $query = $this->db->get("state");
    return $query->result();
 }

 function fetch_group($branch_id,$selected_val)
 {
  $this->db->where('branch_id', $branch_id);
  $this->db->order_by('group_name', 'ASC');
  $query = $this->db->get('group');
  $output = '<option value="">Select Group</option>';
  foreach($query->result() as $row)
  {
    if($selected_val==$row->group_id){
      
      $selected = "selected";
    }else{
      $selected = "";
    }

   $output .= '<option value="'.$row->group_id.'" '.$selected.'>'.$row->group_name.'</option>';
  }
  return $output;
 }

 function fetch_subcategory($category_id,$selected_val)
 {
  
  $this->db->where('category_id', $category_id);
  $this->db->order_by('subcategory_name', 'ASC');
  $query = $this->db->get('subcategory');
  $output = '<option value="">Select Subcategory</option>';
  foreach($query->result() as $row)
  {
    if($selected_val==$row->subcategory_id){
      
      $selected = "selected";
    }else{
      $selected = "";
    }
   $output .= '<option value="'.$row->subcategory_id.'" '.$selected.'>'.$row->subcategory_name.'</option>';
  }
  return $output;
 }
}

?>
