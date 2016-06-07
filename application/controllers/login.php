<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
Author Name: Sahil Gheek
 */
class login extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          $this->load->library('session');
          $this->load->helper('form');
          $this->load->helper('url');
          $this->load->helper('html');
          $this->load->database();
          $this->load->library('form_validation');
		  $this->load->model('login_model');
		  $this->load->library('facebook');
     }

     public function index()
     {
          //check if already logged in
		  if($this->session->userdata('loginuser')) {
			redirect("home");
			exit;
		  }
		  $data['login_url'] = $this->facebook->getLoginUrl(array('redirect_uri' => site_url('login/flogin'), 'scope' => array("email")));
		  $this->load->view('login_view',$data);
		  
          $username = $this->input->post("txt_username");
          $password = $this->input->post("txt_password");

          //validations
          $this->form_validation->set_rules("txt_username", "Username", "trim|required");
          $this->form_validation->set_rules("txt_password", "Password", "trim|required");

          if ($this->form_validation->run() == FALSE);
          else
          {
               //form submitted
               if ($this->input->post('btn_login') == "Login")
               {
                    //check if username and password is correct
                    $usr_result = $this->login_model->get_user($username, $password);
                    if ($usr_result > 0) //active user record is present
                    {
						$usr_id = $this->login_model->get_id($username, $password);
						if($usr_id!=''){
                         //set the session variables
                         $sessiondata = array(
                              'username' => $username,
                              'loginuser' => TRUE,
							  'log_id' => $usr_id
                         );
                         $this->session->set_userdata($sessiondata);
                         redirect("home");}
                    }
                    else
                    {
                         $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username and password!</div>');
                         redirect('login/index');
                    }
               }
               else
               {
                    redirect('login/index');
               }
          }
     }
	 
	 public function flogin()
	{
	    $user = "";
	    $userId = $this->facebook->getUser();
        if ($userId) {
            try {
			    //get data from facebook
                $user = $this->facebook->api('/me?fields=id,name,link,email,gender');
            } catch (FacebookApiException $e) {
                $user = "";
            }
        }
        else {
            echo 'Please try again.'; exit;
        }
        if($user!="") {
           $num = $this->login_model->check_id($user['email']);
		   if($num){
                         //set the session variables
                         $sessiondata = array(
                              'username' => $num['username'],
                              'loginuser' => TRUE,
							  'log_id' => $num['id']
                         );
                         $this->session->set_userdata($sessiondata);
                         redirect("home");
			}
			else {
						 $insrt = $this->login_model->insert_id($user['name'],$user['email']);
						 //set the session variables
                         $sessiondata = array(
                              'username' => $insrt['username'],
                              'loginuser' => TRUE,
							  'log_id' => $insrt['id']
                         );
                         $this->session->set_userdata($sessiondata);
						 $this->session->set_flashdata('msg1', '<div class="alert alert-success text-center">Your account has been created. Default user name is '.$insrt['username'].' and default password is test</div>');
                         redirect("home");
			}
		}
        else {
            $data['login_url'] = $this->facebook->getLoginUrl(array('redirect_uri' => site_url('login/flogin'),'scope' => array("email")));
        }
        
    }
}?>