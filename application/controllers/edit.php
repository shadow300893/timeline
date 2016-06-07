<?php
/* 
Author Name: Sahil Gheek
 */
class Edit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation', 'email'));
        $this->load->database();
        $this->load->model('edit_model');
    }
    
    function index()
    {
        $this->edit_data();
    }

    function edit_data()
    {
        //validation rules
        $this->form_validation->set_rules('username', 'User Name', 'trim|required|alpha|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required');
        
        //validate form input
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('edit_view');
        }
        else
        {
            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')
            );
            
            // insert form data into database
            if ($this->edit_model->editUser($data,$this->session->userdata['log_id']))
            {

                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Your details are successfully Edited! Go back to <a href="'.base_url().'home">Home</a> page</div>');
                redirect('edit/edit_data');
                
            }
            else
            {
                // error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                redirect('edit/edit_data');
            }
        }
    }
    
}
?>