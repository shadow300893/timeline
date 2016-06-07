<?php
/* 
Author Name: Sahil Gheek
 */
class Signup extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation', 'email'));
        $this->load->database();
        $this->load->model('signup_model');
    }
    
    function index()
    {
		//check if already logged in
		if($this->session->userdata('loginuser')) {
			redirect("home");
			exit;
		  }
        $this->register();
    }

    function register()
    {
        //validation rules
        $this->form_validation->set_rules('username', 'User Name', 'trim|required|alpha|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email|is_unique[tbl_usrs.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]|md5');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('signup_view');
        }
        else
        {
            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')
            );
            
            // insert form data into database
            if ($this->signup_model->insertUser($data))
            {

                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are Successfully Registered! Go back to <a href="'.base_url().'login">Login</a> page</div>');
                redirect('signup/register');
                
            }
            else
            {
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                redirect('signup/register');
            }
        }
    }
    
}
?>