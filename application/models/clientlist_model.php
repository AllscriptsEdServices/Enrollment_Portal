<?php
Class ClientList_Model extends CI_Model
{

  var $client_selected_roles = array();
  var $clientActionTaken = false;

  //var $role_dictionary = array("phy"=> "Physician", "nur"=>"Nurse", "ana"=>"Analyst");
  var $role_dictionary = array();
  var $clientId;
  var $curriculumId;

  var $adaptationCost = 2500;
  var $removalCost = 150;
  var $newLessonCost = 2500;
  var $simWiseLessonPrice = array(
                                  array("lowerLimit"=>0, "upperLimit"=>20, "pricePerLesson"=>535),
                                  array("lowerLimit"=>21, "upperLimit"=>50, "pricePerLesson"=>520),
                                  array("lowerLimit"=>51, "upperLimit"=>125, "pricePerLesson"=>475),
                                  array("lowerLimit"=>126, "upperLimit"=>225, "pricePerLesson"=>422),
                                  array("lowerLimit"=>226, "upperLimit"=>350, "pricePerLesson"=>355),
                                  array("lowerLimit"=>351, "upperLimit"=>500, "pricePerLesson"=>272),
                                  array("lowerLimit"=>501, "upperLimit"=>1000, "pricePerLesson"=>272)
                                );

  var $bedWiseMultiplier =  array(
                                  array("lowerLimit"=>0, "upperLimit"=>25, "multiplier"=>-0.3),
                                  array("lowerLimit"=>26, "upperLimit"=>50, "multiplier"=>-0.2),
                                  array("lowerLimit"=>51, "upperLimit"=>150, "multiplier"=>0),
                                  array("lowerLimit"=>151, "upperLimit"=>250, "multiplier"=>0.25),
                                  array("lowerLimit"=>251, "upperLimit"=>350, "multiplier"=>0.5),
                                  array("lowerLimit"=>351, "upperLimit"=>450, "multiplier"=>0.75),
                                  array("lowerLimit"=>451, "upperLimit"=>950, "multiplier"=>1),
                                  array("lowerLimit"=>951, "upperLimit"=>1450, "multiplier"=>1.3),
                                  array("lowerLimit"=>1451, "upperLimit"=>1950, "multiplier"=>1.6),
                                  array("lowerLimit"=>1951, "upperLimit"=>2450, "multiplier"=>1.9),
                                  array("lowerLimit"=>2451, "upperLimit"=>2950, "multiplier"=>2.2),
                                  array("lowerLimit"=>951, "upperLimit"=>3450, "multiplier"=>2.5),
                                  array("lowerLimit"=>3451, "upperLimit"=>10000, "multiplier"=>2.5)                               
                                );


  var $providerWiseMultiplier = array(
                                      array("lowerLimit"=>0, "upperLimit"=>11, "multiplier"=>-0.3),
                                      array("lowerLimit"=>11, "upperLimit"=>25, "multiplier"=>-0.2),
                                      array("lowerLimit"=>26, "upperLimit"=>50, "multiplier"=>0),
                                      array("lowerLimit"=>51, "upperLimit"=>75, "multiplier"=>0.25),
                                      array("lowerLimit"=>76, "upperLimit"=>100, "multiplier"=>0.5),
                                      array("lowerLimit"=>101, "upperLimit"=>150, "multiplier"=>0.75),
                                      array("lowerLimit"=>151, "upperLimit"=>200, "multiplier"=>1),
                                      array("lowerLimit"=>201, "upperLimit"=>250, "multiplier"=>1.3),
                                      array("lowerLimit"=>251, "upperLimit"=>300, "multiplier"=>1.6),
                                      array("lowerLimit"=>301, "upperLimit"=>400, "multiplier"=>1.9),
                                      array("lowerLimit"=>401, "upperLimit"=>500, "multiplier"=>2.2),
                                      array("lowerLimit"=>501, "upperLimit"=>800, "multiplier"=>2.5),
                                      array("lowerLimit"=>801, "upperLimit"=>10000, "multiplier"=>2.5) 
                                    );


  public function __construct()
  {
    $this->load->database();

    $query_roles = $this->db->get('role');
    $result_roles = $query_roles->result_array();
    foreach($result_roles as $role):
      $this->role_dictionary[$role["roleAbbrev"]] = $role["roleName"];
    endforeach;

  }

  function getCurrentClients(){
    $query = $this->db->get('clients');
    $resultArray = $query->result_array();
    for($i=0; $i<sizeof($resultArray); $i++){
       $resultArray[$i]["curriculumName"] = $this->getCurriculumName($resultArray[$i]["curriculumId"]);
    }
      
    return $resultArray;
  }

  function getCurriculumName($curriculumId){
    $query = $this->db->get_where('curriculum', array('curriculumId' => $curriculumId));
    $curriculumDetails =  $query->row_array();
    return $curriculumDetails["curriculumName"];
  }

  function getClientDetails($clientId){
     $query = $this->db->get_where('clients', array('clientId' => $clientId));
     return $query->row_array();
  } 


  function getOrderDetails($curriculumId, $clientId){
    $returnArray = array();
    $totalLessonsforRole = 0;
    $adaptedLessons = 0;
    $removedLessons = 0;
    $multiplierType = "";
    $reAffectedArray = array();

    $clientDetails = $this->getClientSelectedRoles($clientId);

    $queryAdditionalLesson = $this->db->get_where('client_additions', array('clientId' => $clientId));
    $returnArray["newlessons"] = $queryAdditionalLesson->num_rows();

    $curriculumData = $this->getCurriculumData($curriculumId, $clientId);
    $multiplierType = $curriculumData["multiplier"];

    
    $query = $this->db->get_where('module', array('curriculumId' => $curriculumId));
    $resultArray = $query->result_array();
    

    for($i=0; $i<sizeof($resultArray); $i++){

      //Querying all course except REs
      $this->db->order_by("sequenceNum", "asc");
      $queryCourse = $this->db->get_where('course', array('moduleId' => $resultArray[$i]["moduleId"], 'isRE'=>0));
      $resultArray[$i]["courses"] = $queryCourse->result_array();

      for($j=0; $j<sizeof($resultArray[$i]["courses"]); $j++){
       
          $courseId = $resultArray[$i]["courses"][$j]["courseId"];

          $this->db->order_by("sequenceNum", "asc");
          $queryLesson = $this->db->get_where('lesson', array('courseId' => $courseId));
          $resultArray[$i]["courses"][$j]["lessons"] = $queryLesson->result_array();

          for($k=0; $k<sizeof($resultArray[$i]["courses"][$j]["lessons"]); $k++){
            $lesssonId = $resultArray[$i]["courses"][$j]["lessons"][$k]["lessonId"];
            $lessonRoles = $resultArray[$i]["courses"][$j]["lessons"][$k]["rolesAssigned"];
            $requiredLesson = $this->fnIsRoleRequired($lessonRoles);
            if($requiredLesson){
              $totalLessonsforRole++;
            }
            $resultArray[$i]["courses"][$j]["lessons"][$k]["displayLesson"] = $requiredLesson;
            $resultArray[$i]["courses"][$j]["lessons"][$k]["clientAddedLesson"] = false;
            $clientChanges = $this->fnGetChangesNumber($lesssonId, $clientId, $lessonRoles);
            $adaptedLessons = $adaptedLessons + $clientChanges["adapted"];
            $removedLessons = $removedLessons + $clientChanges["removed"];

            //** Getting Number of REs affected **
            //Has this lesson been adapted or removed?
            if($clientChanges["adapted"]>0 || $clientChanges["removed"]>0){
              $reAffected_string = $resultArray[$i]["courses"][$j]["lessons"][$k]["reAffected"];
              $reAffected_array = explode("$", $reAffected_string);
              //Check if this lesson affects any REs. If so loop through each RE Id
              foreach($reAffected_array as $reId){
                // Is this RE meant for one of the client selected roles
                if($this->fnCheckIsRequiredRE($reId)){
                  //Check if it already exists in the $reAffectedArray, if not push the reId
                  if(!in_array($reId, $reAffectedArray)){
                    array_push($reAffectedArray, $reId);                  
                  }
                }
              }
            }

            $resultArray[$i]["courses"][$j]["lessons"][$k]["clientActionTaken"] = $this->clientActionTaken;
            
            // Reset flag for next lesson
            $this->clientActionTaken = false;
            
          }

      }

    }

    //Default Lessons + REs is the max SIMS
    $totalLessonsforRole = $totalLessonsforRole + sizeof($reAffectedArray);
    $returnArray["adaptedLessons"] = $adaptedLessons;
    $returnArray["removedLessons"] = $removedLessons;
    $returnArray["defaultLessons"] = $totalLessonsforRole; 
    $returnArray["reAffected"] = sizeof($reAffectedArray);

    //Start Calculating prices
    $pricePerLesson = $this->getCostPerLesson($totalLessonsforRole);
    
    $multiplierUnitNumber = ($multiplierType=="beds") ? $clientDetails["numberOfBeds"] : $clientDetails["numberOfProviders"];
    $multiplierFactor = $this->getMultiplierFactor($multiplierType, $multiplierUnitNumber);

    $part_1 = $totalLessonsforRole*$pricePerLesson;
    $part_2 = round($part_1*$multiplierFactor);
    $part_3 = ($adaptedLessons*$this->adaptationCost);
    $part_4 = ($removedLessons*$this->removalCost);
    $part_5 = sizeof($reAffectedArray)*$this->adaptationCost;
    $part_6 = ($returnArray["newlessons"]*$this->newLessonCost);

    $finalPrice = $part_1 + $part_2 + $part_3 + $part_4 + $part_5 + $part_6;

    $returnArray["pricePerLesson"] = $pricePerLesson;
    $returnArray["multiplierFactor"] = $multiplierFactor;
    $returnArray["multiplierType"] = $multiplierType;
    $returnArray["multiplierUnitNumber"] = $multiplierUnitNumber;
    $returnArray["finalPrice"] = number_format($finalPrice);

    $returnArray["adaptationCost"] = $this->adaptationCost;
    $returnArray["removalCost"] = $this->removalCost;
    $returnArray["newLessonCost"] = $this->newLessonCost;

    return $returnArray;

  }
 
  function getCostPerLesson($totalLessons){  
    foreach ($this->simWiseLessonPrice as $section) {
      if($totalLessons>=$section["lowerLimit"] && $totalLessons<=$section["upperLimit"]){
        return $section["pricePerLesson"];
        break;
      }
    }

  }

  function getMultiplierFactor($multiplierType, $multiplierUnitNumber){
    $multiplierArray = ($multiplierType=="beds") ? $this->bedWiseMultiplier : $this->providerWiseMultiplier;
    foreach ($multiplierArray as $section) {
      if($multiplierUnitNumber>=$section["lowerLimit"] && $multiplierUnitNumber<=$section["upperLimit"]){       
        return $section["multiplier"];
        break;
      }
    }

  }


  function fnIsRoleRequired($lessonRoles){
    $lessonRolesArray = explode("$", $lessonRoles);
    $isPresent = false;

    foreach ($lessonRolesArray as $role) {
      if(in_array($role,  $this->client_selected_roles)){
        $isPresent = true;
        break;
      }
    }

    return $isPresent;
  }

  function fnCheckIsRequiredRE($courseId){
    $required = false;

    $this->client_selected_roles;
    $this->db->select('courseId, rolesAssigned');
    $this->db->from('course');
    $this->db->where('courseId', $courseId);
    $query = $this->db->get();
    $reDetails = $query->row_array();
    
    if(isset($reDetails["rolesAssigned"])){
      $rolesForThisRE = explode("$", $reDetails["rolesAssigned"]);
      foreach($this->client_selected_roles as $role){
        if(in_array($role,  $rolesForThisRE)){
          $required = true;
          break;
        }
      }
    }
    

    return $required;

  }


  function fnGetChangesNumber($lessonId, $clientId, $lessonRoles){
    $lessonRolesArray = explode("$", $lessonRoles);
    $lesson_master = array();
    $adapted = 0;
    $removed = 0;
    foreach($this->client_selected_roles as $single_role):
      $queryAdapt = $this->db->get_where('client_changes', array('lessonId' => $lessonId, 'clientId' => $clientId, 'forRole'=>$single_role));
      $resultArrayAdapt = $queryAdapt->row_array();

      if($queryAdapt->num_rows()>0){
        $this->clientActionTaken = $queryAdapt->num_rows();
      }
      
      $originallyUsed = (in_array($single_role, $lessonRolesArray)) ? true : false;

      $selectedOption = ($queryAdapt->num_rows()>0) ? $resultArrayAdapt["changeType"] : "NULL";
      /*$adaptDescription = ($queryAdapt->num_rows()>0) ? $resultArrayAdapt["changeDescription"] : "NULL";
      $reuseAddFromRole = ($queryAdapt->num_rows()>0) ? $resultArrayAdapt["reuse_add_from_role"] : "NULL";*/


      switch($selectedOption){
        case "keep":
          
          break;
        case "add_unchanged":
         
          break;
        case "adapt":
          $adapted++;
          break;
        case "reuse_adapt":
          
          break;
        case "add_adapted":
         
          break;
        case "remove":
          // Making removal count only 1 irrespective of role-wise removal
          if($removed==0){$removed++;}
          break;
        default:
          break;
      }

    endforeach;

    $lesson_master["adapted"] = $adapted;
    $lesson_master["removed"] = $removed;
    return $lesson_master;

  }


  function getCurriculumData($curriculumId, $clientId){
     $this->$clientId = $clientId;
     $this->$curriculumId = $curriculumId;
     $query = $this->db->get_where('curriculum', array('curriculumId' => $curriculumId));
     return $query->row_array();
  }


  

  function getClientSelectedRoles($clientId){
    $query = $this->db->get_where('clients', array('clientId' => $clientId));
    $resultArray = $query->row_array();
    if($query->num_rows()>0){
      $this->client_selected_roles = explode("$", $resultArray["staffRoles"]);
    }

    return $resultArray;
  }


  
  function addClient($orgName, $contactName, $contactEmail){
    $returnString = "";
    $userId = 0;

    if($this->session->userdata('logged_in_admin')) {
       $session_data = $this->session->userdata('logged_in_admin');
       $userId = $session_data['userId'];                   
    }

    $query = $this->db->get_where('users', array('mail' => $contactEmail, 'userType'=>'External'));
    if($query->num_rows()<=0){
      
       $clientArray = array(                   
          'orgName' => $orgName,
          'contactName' => $contactName,
          'contactEmail' => $contactEmail,
          'curriculumId' => 1,          
          'addedBy' => $userId,
          'addedDate' => date("Y-m-j")
      );

      $this->db->insert('clients', $clientArray);
      $clientId = $this->db->insert_id();


      $contactArray = array(        
          'name' => $contactName,
          'mail' => $contactEmail,
          'password' => "welcome123",          
          'userType' => 'External',
          'clientId' => $clientId,
      );
      $this->db->insert('users', $contactArray);

      $returnString = $clientId;

      $this->load->library('email');
      $this->email->set_mailtype("html");
      $this->email->from('vishwajit.menon@allscripts.com', 'Allscripts Education Services | Curriculum Builder');
      $this->email->to($contactEmail);
      //$this->email->cc($mailArray["mailTo"]);
      $this->email->bcc('vishwajit.menon@allscripts.com');
     
       $mailBody = "<!doctype html><meta http-equiv='X-UA-Compatible' content='IE=Edge'><html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'><style type='text/css'>.ExternalClass{display:block !important;}</style></head><body leftmargin='0' rightmargin='0' topmargin='0' bottommargin='0' bgcolor='#d9dadc' style='font-family:Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;'><table width='100%' cellspacing='0' cellpadding='0' bgcolor='#d9dadc' style='padding:20px; font-family:Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;'> <tr><td width='100%' bgcolor='#222222' style='padding:0px 5px; height:52px; color:#fff; font-size:20px'> Education Services | Curriculum Builder </td></tr><tr><td width='100%' bgcolor='#FFFFFF' style='padding:20px'> <table cellpadding='0' cellspacing='0'><tr><td style='font-size:15px; font-family:Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif; padding:0px 20px;color:#000000;'><p>Hi ".$contactName.",</p><p>Welcome to Curriculum Builder!</p><p>Curriculum Builder is an online tool that allows you to preview our baseline Experiential Learning lessons and identify which lessons to keep, remove, and customize to build a curriculum that works for the learners in your organization.</p>  <p>Use the login details below to access Curriculum Builder and begin making your lesson selections.</p></br></td></tr><tr>  <td style='font-size:15px; font-family:Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif; padding:0px 20px;color:#000000;'>  <table style='font-family:Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif; font-size:15px; padding:0px; border-top:1px solid #DDDDDD; border-right:1px solid #DDDDDD' cellpadding='0px' cellspacing='0px'><tr><td bgcolor='#9CC690' style='padding:10px;border-bottom:1px solid #DDDDDD;border-left:1px solid #DDDDDD;text-align: center; font-size:18px' colspan='2' >Login Details</td>  </tr><tr><td style='padding:10px;border-bottom:1px solid #DDDDDD;border-left:1px solid #DDDDDD' >Site</td><td style='padding:10px;border-bottom:1px solid #DDDDDD;border-left:1px solid #DDDDDD' >http://curriculum.eduserv.myallscripts.com</td> </tr><tr><td style='padding:10px;border-bottom:1px solid #DDDDDD;border-left:1px solid #DDDDDD' >User Name</td><td style='padding:10px;border-bottom:1px solid #DDDDDD;border-left:1px solid #DDDDDD' >".$contactEmail."</td><tr><td style='padding:10px;border-bottom:1px solid #DDDDDD;border-left:1px solid #DDDDDD' >Password</td><td style='padding:10px;border-bottom:1px solid #DDDDDD;border-left:1px solid #DDDDDD' >welcome123</td></tr></table>  </td></tr><tr><td style='padding:20px;color:#000; font-size:15px; font-family:Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;'></br><p>It is advised that you change your password upon logging in the first time.</p><p>If you face any issues logging in, viewing the lessons, or using Curriculum Builder, feel free to <a href='mailto:vishwajit.menon@allscripts.com;jennifer.hruska@allscripts.com'>contact us</a>.</p>  </td></tr></table></td></tr></table></body></html>";
      
      $this->email->subject("Curriculum Builder - Welcome!");
      $this->email->message($mailBody);

      $this->email->send();

    }else{
      $returnString = "User Exists";
    }

    

    return $returnString;
  }


  
 


}  // End of Class Declaration


?>
