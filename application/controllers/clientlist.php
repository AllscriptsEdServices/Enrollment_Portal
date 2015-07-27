<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ClientList extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('clientlist_model');
	}

	public function index()
	{
		$page_data = "";
		$this->fnLoadPage($page_data);
	}

	public function getClients(){
		/*$page_data["curriculum_data"] = $this->courselist_model->getCurriculumData($curriculumId, $clientId);
		$page_data["moduleData"] = $this->courselist_model->getModules($curriculumId, $clientId);
		$page_data["clientData"] = $this->courselist_model->getClientSelectedRoles($clientId);
		$page_data["clientId"] = $clientId;
		$page_data["curriculumId"] = $curriculumId;
		$page_data["gotoCourse"] = $gotoCourse;
		$page_data["gotoLesson"] = $gotoLesson;*/
		$page_data["clients"] = $this->clientlist_model->getCurrentClients();		
		
		$this->fnLoadPage($page_data, "clientlist_view");
	}

	public function showOrder($clientId, $curriculumId){
		$page_data["order"] = $this->clientlist_model->getOrderDetails($curriculumId, $clientId);
		$page_data["clientDetails"] = $this->clientlist_model->getClientDetails($clientId);
		$page_data["client_selected_roles"] = $this->clientlist_model->client_selected_roles;
		$page_data["role_dictionary"] = $this->clientlist_model->role_dictionary;
		
		
		
		
		$this->fnLoadPage($page_data, "client_order_view");
	}


	function fnLoadPage($page_data, $view_name){
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
		$header_data["userData"] = $data;
		
		
		$footer_data["activeTab"] = "client_list";

		$this->load->view('global/header', $header_data);
   		$this->load->view($view_name, $page_data);
   		$this->load->view('global/footer', $footer_data);
	}


	function check_AllLessonsReviewed(){
		$clientId = $this->input->post('clientId');
		$curriculumId = $this->input->post('curriculumId');
		$status = $this->courselist_model->check_AllLessonsStatus($clientId, $curriculumId);
		echo json_encode($status);
	}

	function addClient(){
		$orgName = $this->input->post('orgName');
		$contactName = $this->input->post('contactName');
		$contactEmail = $this->input->post('contactEmail');
		$status = $this->clientlist_model->addClient($orgName, $contactName, $contactEmail);
		echo ($status);
	}
	
}