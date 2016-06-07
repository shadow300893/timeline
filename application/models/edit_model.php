<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
Author Name: Sahil Gheek
 */
class edit_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

     //get the username & password from tbl_usrs
     function get_user($id)
     {
          $sql = "select * from tbl_usrs where id='".$id."'";
          $query = $this->db->query($sql);
          $data = $query->row_array();
          return $data;
     }
	 //update user data
	 function editUser($data,$id)
    {
		  $this->session->set_userdata('username', $data['username']);

          $sql = "Update tbl_usrs Set username='".$data['username']."',email='".$data['email']."',password='".$data['password']."' where id='".$id."'";
          return $query = $this->db->query($sql);
	}
}?>