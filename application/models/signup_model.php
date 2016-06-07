<?php
class signup_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    //insert into usr table
    function insertUser($data)
    {
		  $sql = "Insert into tbl_usrs (username,email,password,status) values ('".$data['username']."','".$data['email']."','".$data['password']."','active')";
          return $query = $this->db->query($sql);
	}
    
}
?>