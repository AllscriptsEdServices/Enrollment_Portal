<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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


	public function doLogin(){
		$this->load->model('user_model');
		
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$loginObj = $this->user_model->doLogin($email, $password);

		/*if($loginObj["status"]=="Success"){
			//redirect('createnew', 'refresh');
			echo anchor('createnew');
		}else{
			echo json_encode($loginObj);
		}*/
		
		echo json_encode($loginObj);		
	}


	function fnLoadPage($page_data){

		$headerfiles = array(
			//'1' => '<link rel="stylesheet" href="'.base_url("assets/css/app_main.css").'">'
		);

		$header_data['headerfiles'] = $headerfiles;
		$page_data["baseURL"] = base_url("index.php/");
		$footer_data["activeTab"] = "login";

		$this->load->view('global/header_nonav', $header_data);
   		$this->load->view('login_view', $page_data);
   		$this->load->view('global/footer_nonav', $footer_data);

	}

	public function forgotPassword(){
		$this->load->model('login_model');	
		$mail = $this->input->post('forgotMail');

		$resetStatus = $this->login_model->resetPassword($mail);
		echo $resetStatus;
	}



}