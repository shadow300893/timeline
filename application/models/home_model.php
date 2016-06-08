<?php
/* 
Author Name: Sahil Gheek
 */
class home_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    //insert into user table
    function insertContent($arr,$txt)
    {
		   if (!class_exists('S3')) require_once(APPPATH.'libraries/S3.php');
			
			//AWS access info
			if (!defined('awsAccessKey')) define('awsAccessKey', 'enter-here');
			if (!defined('awsSecretKey')) define('awsSecretKey', 'enter-here');
			
			//instantiate the class
			$s3 = new S3(awsAccessKey, awsSecretKey);	
			date_default_timezone_set("Asia/Kolkata");
		  
          $sql = "Insert into tbl_content (name,timestamp,user_id,tagline) values ('".$arr['name']."','".date('Y-m-d H:i:s')."','".$this->session->userdata['log_id']."','".$txt."')";
          $query = $this->db->query($sql);
		  if ($s3->putObjectFile($arr['tmp_name'], "timeline.in", $arr['name'], S3::ACL_PUBLIC_READ)) {
					return "success";
				}else{
					return "error";
				}
	}
	
	//return data to be displayed
    function display()
	{
		$sql = "Select * from tbl_content where user_id='".$this->session->userdata['log_id']."' order by id desc";
          $query = $this->db->query($sql);
		  return $query->result_array();
	}
    
    
}
?>
