<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

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


	
	function fnLoadPage($page_data){
		//$this->load->model('user_model');
		$session_data = $this->user_model->getSessionDetails();

		//Check if a valid session is active. Else redirect to login page.
		if(!$session_data["active_status"]){
			redirect('login', 'refresh');
		}

		$header_data['userDetails'] = $session_data["userDetails"];
		$header_data['headerfiles'] = array(
			//'1' => '<link rel="stylesheet" href="'.base_url("assets/css/app_main.css").'">'
		);
		$page_data["baseURL"] = base_url("index.php/");
		$footer_data["activeTab"] = "nav_users";

		$this->load->view('global/header', $header_data);
   		$this->load->view('users_view', $page_data);
   		$this->load->view('global/footer', $footer_data);

	}



}