<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Logout extends CI_Controller {	


	public function __construct()
	{
		parent::__construct();

	}



	public function index()
	{		
		$this->load->helper('form');
	
		
		$userType = "";

		if($this->session->userdata('logged_in')) {
		     $session_data = $this->session->userdata('logged_in');		     
		     $userType = $session_data['userType'];

		     $this->session->unset_userdata('logged_in');

		     /*if($userType	 == "external"){
		     	redirect('clientlog/c_login', 'refresh');
		     }else{*/
		     	redirect('login', 'refresh');
		     //}
		}else{
		     //If no session, redirect to login page
		     redirect('login', 'refresh');
		}

		
	}
	

}