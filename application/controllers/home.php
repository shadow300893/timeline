<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
Author Name: Sahil Gheek
 */
 class Home extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('form','url'));
        $this->load->library(array('session', 'form_validation', 'email'));
        $this->load->database();
        $this->load->model('home_model');
		
	}
	
	public function index(){
		$data['arr'] = $this->home_model->display();
		
		$this->load->view('home_view',$data);

		
			//check whether a form was submitted
			if(isset($_POST['upld'])){
				
				$val = $this->home_model->insertContent($_FILES['theFile'],$_POST['tag']);
				if($val == 'success')
				{
				$this->session->set_flashdata('msg','<div class="alert alert-success text-center"><strong>We successfully uploaded your file.</strong></div>');
                redirect('home');
				}
				else
				{
                // error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center"><strong>Something went wrong while uploading your file... sorry.</strong></div>');
                redirect('home');
				}
				
			}
		
	}
	
	public function do_logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
 }
 ?>