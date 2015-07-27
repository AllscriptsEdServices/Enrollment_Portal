<?php
Class Password_Model extends CI_Model
{
  
  public function __construct()
  {
    $this->load->database();
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