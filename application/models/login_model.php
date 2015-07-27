<?php
Class Login_Model extends CI_Model
{
  
  public function __construct()
  {
    $this->load->database();
  }
  

  function createLogin(){

  }
  
  function doLogin($mail, $password){ 
    $query = $this->db->get_where('users', array('mail' => $mail, 'password'=>$password, 'userType'=>'Internal'));
    if($query->num_rows()>0){
      $login_result = $query->row_array();
      $sess_array = array();
      
      $sess_array = array(
         'userId' => $login_result["userId"],
         'mail' => $login_result["mail"],
         'name' => $login_result["name"],
         'userType' => $login_result["userType"],
         'selection_active' => $login_result["selection_active"],
         'clientId' => $login_result["clientId"]     
      );
      
      $this->session->set_userdata('logged_in_admin', $sess_array);

      /*$query = $this->db->get_where('clients', array('clientId' => $clientId)); 
      $query->row_array();*/

      return $login_result["clientId"];

    }else{
      return "Fail";
    }

    


  }


  

  function resetPassword($mail){
    $userId = "Not Found";
    $query = $this->db->get_where('users', array('mail' => $mail));
    
    if($query->num_rows() > 0){
      $resultArray = $query->row_array();
      $userId = $resultArray["userId"];
      $this->db->where('userId', $resultArray["userId"]);
      $this->db->update('users', array('password' => "welcome123")); 
    }
    
    
    if($userId != "Not Found"){
      return 'Success';
    }else{
      return "Fail";
    }

  }

  

  



} // End of Class Declaration


?>