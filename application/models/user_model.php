<?php
Class User_Model extends CI_Model
{
  
  public function __construct()
  {
    $this->load->database();
  }
  

  function createLogin(){

  }
  

  // Return a comprehensive array with login status and further details for navigating ahead
  function doLogin($email, $password){ 

    /*@ var return_array properties definition: ****
          status = stores whether a valid user  //--Possible Values - Success, Fail --//       
          reason = If status is Fail, what is reason. //--Possible Values - "username/password" --//
          Following applicable if successful login
            clientId =    //--Possible Values - integer --//   
            formFilled = Have the client details (name, accountnum) been filled. Else navigate them to the form first. //--Possible Values - true/false --//
            skipIntro = Status of the Skip Intro button for further navigation  //--Possible Values - true/false --//
    */
    $return_array = array("status"=> "None", "reason"=>"", "clientId"=>"", "formFilled"=>false, "skipIntro"=>false);

    $query = $this->db->get_where('client_users', array('email' => $email, 'password'=>$password));
    if($query->num_rows()>0){      
      $login_result = $query->row_array();

      $this->setSessionDetails($login_result);
        
      $return_array["status"] = "Success";      
      $return_array["clientId"] = $login_result["clientId"];
      
      if($login_result["clientId"]>0){
         $return_array["formFilled"] = true;
      }

    }else{
      $return_array["status"] = "Fail";
      $return_array["reason"] = "Username";      
    }

    return $return_array;
    //return "Fail";

  }


  /*
      Function - Sets the session data for logged in user.
      Session variable name - 'logged_in_user'
      No return value
  */
  function setSessionDetails($login_result){
    $sess_array = array();
      
    $sess_array = array(
       'userId' => $login_result["userId"],
       'email' => $login_result["email"],
       'first_name' => $login_result["first_name"],
       'last_name' => $login_result["last_name"],
       'phone' => $login_result["phone"],
       'date_added' => $login_result["date_added"],
       'clientId' => $login_result["clientId"]     
    );
    
    $this->session->set_userdata('logged_in_user', $sess_array); 

  }


  function getSessionDetails(){
    $session_details = array("active_status"=>false, "userDetails"=>array());
    if($this->session->userdata('logged_in_user')) {
        //$session_data = $this->session->userdata('logged_in_user');
        $session_details["active_status"] = true;
        $session_details["userDetails"] =  $this->session->userdata('logged_in_user');
    }else{
      $session_details["active_status"] = false;
    }

    return $session_details;
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


  function changePassword($oldPassword, $newpassword_1){
    $returnString = "";
    $session_data = $this->session->userdata('logged_in_admin');
    $currentUserId = $session_data['userId'];

    $query = $this->db->get_where('users', array('userId' => $currentUserId, 'password'=>$oldPassword));
    if($query->num_rows() > 0){
      $this->db->where('userId', $currentUserId);
      $this->db->update('users', array('password' => $newpassword_1)); 
      $returnString = "Success";
    }else{
      $returnString = "Wrong Password";
    }

    return $returnString;
  }

  



} // End of Class Declaration


?>