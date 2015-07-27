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
		$this->load->model('login_model');

		$mail = $this->input->post('mail');
		$password = $this->input->post('password');
		$loginStatus = $this->login_model->doLogin($mail, $password);

		echo $loginStatus;
	
		/*redirect("entry", 'refresh');
		if($loginStatus=="Fail"){
			echo $loginStatus;
		}else{
			echo "here";
			//$url = "entry/client/".$loginStatus;			
			redirect("entry", 'refresh');
		}*/
	}

	function fnLoadPage($page_data){

		$headerfiles = array(
			//'1' => '<link rel="stylesheet" href="'.base_url("assets/css/app_main.css").'">'
		);

		$header_data['headerfiles'] = $headerfiles;
		
		$footer_data["activeTab"] = "login";

		$this->load->view('global/header_login', $header_data);
   		$this->load->view('login_view', $page_data);
   		$this->load->view('global/footer_login', $footer_data);

	}

	public function forgotPassword(){
		$this->load->model('login_model');	
		$mail = $this->input->post('forgotMail');

		$resetStatus = $this->login_model->resetPassword($mail);
		echo $resetStatus;
	}


}