<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Password extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->helper('form');
		$this->load->helper('url');	
	}

	public function index()
	{			
   		$content = "";
   		$this->fnLoadPage($content);
	}


	public function change(){
		$this->load->model('password_model');	
		$page_data = "";
		$this->fnLoadPage($page_data);
		
	}

	function fnLoadPage($page_data){
		if($this->session->userdata('logged_in_admin')) {
		     $session_data = $this->session->userdata('logged_in_admin');
		     $data['userId'] = $session_data['userId'];
		     $data['mail'] = $session_data['mail'];
		     $data['name'] = $session_data['name'];
		     $data['clientId'] = $session_data['clientId'];
		     $data['selection_active'] = $session_data['selection_active'];
		     $data['userType'] = $session_data['userType'];
		     $page_data['name'] = $session_data['name'];
		     /*if($page_data["clientId"] != $session_data['clientId']){
		     	 redirect('login', 'refresh');
		     }*/
						     
		}else{
		     //If no session, redirect to login page
		     redirect('login', 'refresh');
		}

		$headerfiles = array(
			//'1' => '<link rel="stylesheet" href="'.base_url("assets/css/app_main.css").'">'
		);

		$header_data['headerfiles'] = $headerfiles;
		$header_data['userData'] = $data;
		
		$footer_data["activeTab"] = "password";

		$this->load->view('global/header', $header_data);
   		$this->load->view('password_view', $page_data);
   		$this->load->view('global/footer', $footer_data);

	}

	public function changePassword(){
		$this->load->model('password_model');	
		$oldPassword = $this->input->post('oldPassword');
		$newpassword_1 = $this->input->post('newpassword_1');
				
		$changeStatus = $this->password_model->changePassword($oldPassword, $newpassword_1);
		echo $changeStatus;
	}


}