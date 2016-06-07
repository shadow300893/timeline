<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
Author Name: Sahil Gheek
 */
 
class login_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

     //get the username & password from tbl_usrs
     function get_user($usr, $pwd)
     {
          $sql = "select * from tbl_usrs where username = '" . $usr . "' and password = '" . md5($pwd) . "' and status = 'active'";
          $query = $this->db->query($sql);
          return $query->num_rows();
     }
	 
	 //fetch user id for login
	 function get_id($usr, $pwd)
     {
          $sql1 = "select * from tbl_usrs where username = '" . $usr . "' and password = '" . md5($pwd) . "' and status = 'active'";
          $query1 = $this->db->query($sql1);
		  $user = $query1->row_array();
          return $user['id'];
     }
	 
	 //check if user exists with facebook login
	 function check_id($eml)
     {
          $sql2 = "select * from tbl_usrs where email = '" . $eml . "' and status = 'active'";
          $query2 = $this->db->query($sql2);
		  if($query2->num_rows()>0)
		  {
			$user = $query2->row_array();
			return $user;
		  }
		  else
			return 0;
     }
	 
	 //create profile for first login by facebook
	 function insert_id($nme,$eml)
     {
          $sql = "Insert into tbl_usrs (username,email,password,status) values ('".$nme."','".$eml."','".md5('test')."','active')";
          $query = $this->db->query($sql);
		  $sql2 = "select * from tbl_usrs where email = '" . $eml . "' and status = 'active'";
          $query2 = $this->db->query($sql2);
		  $user = $query2->row_array();
			return $user;
		  
     }
}?>