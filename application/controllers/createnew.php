<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CreateNew extends CI_Controller {

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


	public function addClient(){
		$this->load->model('clients_model');

		$client_data["orgName"] = $this->input->post('orgName');
		$client_data["accountNumber"] = $this->input->post('accountNumber');
		$client_data["cdhNumber"] = $this->input->post('cdhNumber');
		$client_data["first_name"] = $this->input->post('first_name');
		$client_data["last_name"] = $this->input->post('last_name');
		$client_data["email"] = $this->input->post('email');
		$client_data["phone"] = $this->input->post('phone');

		$session_data = $this->user_model->getSessionDetails();

		$process_status = $this->clients_model->addClient($client_data, $session_data["userDetails"]["userId"]);

		echo json_encode($process_status);
	
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
		$footer_data["activeTab"] = "login";

		$this->load->view('global/header_nonav', $header_data);
   		$this->load->view('create_new_view', $page_data);
   		$this->load->view('global/footer_nonav', $footer_data);

	}



}