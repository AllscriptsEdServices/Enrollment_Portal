<?php
Class Clients_Model extends CI_Model
{
  
  public function __construct()
  {
    $this->load->database();
  }
  

  // Return a comprehensive array with client addition status and further details for navigating ahead
  function addClient($clientDetails, $client_userId){
    /*@ var return_array properties definition: ****
              status = stores status of insert  //--Possible Values - Success, Fail --//  
              reason = If status is Fail, what is reason. //--Possible Values - "cdh/tbd" --//
              clientId =    //--Possible Values - integer --// 
    */

    $return_array = array("status"=>"", "reason"=>"", "clientId"=>0);
    $userId = 0;
    
    $query = $this->db->get_where('clients', array('cdhNumber' => $clientDetails["cdhNumber"]));
    if($query->num_rows()<=0){
      $clientArray = array(                   
        'orgName' =>$clientDetails["orgName"],
        'cdhNumber' => $clientDetails["cdhNumber"],
        'accountNumber' => $clientDetails["accountNumber"],           
        'addedBy' => 0,
        'addedOn' => date('Y-m-d G:i:s')
      );

      $this->db->insert('clients', $clientArray);
      $clientId = $this->db->insert_id();     
      

      $userArray = array(                   
        'first_name' =>$clientDetails["first_name"],
        'last_name' => $clientDetails["last_name"],
        'phone' => $clientDetails["phone"],
        'clientId' => $clientId    
      );

      $this->db->where('userId', $client_userId);
      $this->db->update('client_users', $userArray);

      $return_array["status"] = "Success";
      $return_array["clientId"] = $clientId;
    }else{
      $return_array["status"] = "Fail";
      $return_array["reason"] = "cdh";
    }
    
    return $return_array;
  }

 
  



} // End of Class Declaration


?>