

 function fnKeepUnchanged(forRole){    
    var current_role_obj = lesson_master[forRole];
    fnResetRoleOptions(forRole);    

    current_role_obj["keep"] = true;
    current_role_obj["selected_option"] = "keep";
    fnCheckDependencies(forRole);
  }

  function fnAddUnchanged(forRole){    
    var current_role_obj = lesson_master[forRole];
    fnResetRoleOptions(forRole);    

    current_role_obj["add_unchanged"] = true;
    current_role_obj["selected_option"] = "add_unchanged";
    fnCheckDependencies(forRole);
  }


  function fnRemove(forRole){
    var current_role_obj = lesson_master[forRole];
    fnResetRoleOptions(forRole);
    
    current_role_obj["remove"] = true;
    current_role_obj["selected_option"] = "remove";
    fnCheckDependencies(forRole);
  }


  function fnSaveAdaptation(){
    forRole = current_adaption_role;    

    var radioName = "reuse_adapt_" + forRole;    
    
    if(ErrorCheck_AdaptInput(forRole)){   
    	var current_role_obj = lesson_master[forRole]; 
    	
    	//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$@#@#@$@#$@#@$@@#####
    	//Check change dependency before doing this
    	fnResetRoleOptions(forRole);    	
    	if(current_role_obj["originallyUsed"]){
    		if($("input[name="+radioName+"]:checked").val() == undefined || $("input[name="+radioName+"]:checked").val() == "new"){
		    	current_role_obj["adapt"] = true; 
			    current_role_obj["selected_option"] = "adapt";
			    current_role_obj["adapt_description"] = $('#adapt_description_txt').val();
			    $(".add_adapt").removeClass("hidden");
		    }else{
		    	current_role_obj["adapt"] = $("input[name="+radioName+"]:checked").val();
			    current_role_obj["selected_option"] = "reuse_adapt";
			    current_role_obj["reuse_add_from_role"] = $("input[name="+radioName+"]:checked").val();
			    current_role_obj["adapt_description"] = "NULL";
		    }
    	}else{
    		current_role_obj["adapt"] = $("input[name="+radioName+"]:checked").val();
			current_role_obj["selected_option"] = "add_adapted";
			current_role_obj["reuse_add_from_role"] = $("input[name="+radioName+"]:checked").val();
			current_role_obj["adapt_description"] = "NULL";
    	}
	    
	    

	   //Since adaptation has been saved, show the CHEVRON DOWN for the user to view the adapt details in future, wihtout clicking the radio
	   //First, check whether CHEVRON, is already present, in case user is Updating the adaptation details.
	   //If element exists, the length will be 1, or as per number of instances
	   if($("#adapt_chevron_"+forRole).length <= 0){
	   		$("#td_adapt_"+forRole).append('<span id="adapt_chevron_'+forRole+'" data-role="'+forRole+'" class="adapt_chevron glyphicon glyphicon-chevron-down pull-right" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Click to view the adaptation description."></span>');
	   }
	   
	   fnCloseAdaptationWindow();
    }
   	

  }
   

  //Error Check
  function ErrorCheck_AdaptInput(forRole){
  	var proceed = true;

  	var radioName = "reuse_adapt_" + forRole;
    if($("input[name="+radioName+"]").length > 0){
    	if($("input[name="+radioName+"]:checked").val() == undefined){
    		fnShowErrorMessage(1);
    		proceed = false;    		
    	}else if($("input[name="+radioName+"]:checked").val() == "new" && $("#adapt_description_txt").val()==""){
    		fnShowErrorMessage(2);
    		proceed = false; 
    	}
    }else{
    	if($("#adapt_description_txt").val()==""){
    		fnShowErrorMessage(2);
    		proceed = false;
    	}
    }

    return proceed;
  }
 
 //******* UTILITY FUNCTION TO RESET ALL ROLE-WISE OPTIONS *************************
  function fnResetRoleOptions(forRole){    
    var current_role_obj = lesson_master[forRole];
    for (var key in current_role_obj) {
      if(current_role_obj.hasOwnProperty(key)) {
        if(key!="role" && key!="roleName" && key!="originallyUsed" && key!="adapt_description"){
          current_role_obj[key] = "NULL";
        }
      }
    }

  }


  function fnSetUpAdaptationWindow(forRole){
  	//fnResetRoleOptions(forRole);
  	var current_role_obj = lesson_master[forRole];
  	var adaptTitle = "";
  	var adaptDescription = "";

  	current_adaption_role = forRole;

  	if(!current_role_obj["originallyUsed"]){
  		//if(fnAnyLiveAdaptations(forRole)!=false){
	      var alreadyAdaptedArray = fnAnyLiveAdaptations(forRole);
	      var radioButtonString = "";
	   
	      for(var i=0; i<alreadyAdaptedArray.length; i++){
	        var tempRoleabbr = alreadyAdaptedArray[i];
	        if(current_role_obj["reuse_add_from_role"] == tempRoleabbr){
	        	radioButtonString += '<input type="radio" class="reuse_adapt" name="reuse_adapt_'+forRole+'" value="'+tempRoleabbr+'" checked>Add the <b>'+lesson_master[tempRoleabbr]["roleName"]+'</b> adaptation for the <b>'+lesson_master[forRole]["roleName"]+'</b> role.</input><br>';
	        }else{
	        	radioButtonString += '<input type="radio" class="reuse_adapt" name="reuse_adapt_'+forRole+'" value="'+tempRoleabbr+'">Add the <b>'+lesson_master[tempRoleabbr]["roleName"]+'</b> adaptation for the <b>'+lesson_master[forRole]["roleName"]+'</b> role.</input><br>';
	        }
	        
	      }
	 //}
	  	$("#adapt_options_div").html(radioButtonString);
	    $("#adapt_options_div").removeClass("hidden");
	 	$("#adapt_description_div").addClass("hidden");
	 	adaptTitle = "Add Adapted Lesson - " + lessonName + " for <b>" + role_dictionary[forRole] + "</b>.";
    	adaptDescription = (lesson_master[forRole]["adapt_description"]!="NULL") ? lesson_master[forRole]["adapt_description"] : "";

  	}else{
  		if(fnAnyLiveAdaptations(forRole)!=false){  			
	      var alreadyAdaptedArray = fnAnyLiveAdaptations(forRole);
	      var radioButtonString = "";
	   
	      for(var i=0; i<alreadyAdaptedArray.length; i++){
	        var tempRoleabbr = alreadyAdaptedArray[i];        
	        if(current_role_obj["reuse_add_from_role"] == tempRoleabbr){
	        	radioButtonString += '<input type="radio" class="reuse_adapt" name="reuse_adapt_'+forRole+'" value="'+tempRoleabbr+'" checked>Use the <b>'+lesson_master[tempRoleabbr]["roleName"]+'</b> adaptation for the <b>'+lesson_master[forRole]["roleName"]+'</b> role.</input><br>';
	        }else{
	        	radioButtonString += '<input type="radio" class="reuse_adapt" name="reuse_adapt_'+forRole+'" value="'+tempRoleabbr+'">Use the <b>'+lesson_master[tempRoleabbr]["roleName"]+'</b> adaptation for the <b>'+lesson_master[forRole]["roleName"]+'</b> role.</input><br>';
	        }
	        
	      }

	      if(current_role_obj["selected_option"] == "adapt"){
	      	radioButtonString += '<input type="radio" class="reuse_adapt" name="reuse_adapt_'+forRole+'" value="new" checked>Request a new adaptation for the <b>'+lesson_master[forRole]["roleName"]+'</b> role.</input><br>';
	      	$("#adapt_description_div").removeClass("hidden");
	      }else{
	      	radioButtonString += '<input type="radio" class="reuse_adapt" name="reuse_adapt_'+forRole+'" value="new">Request a new adaptation for the <b>'+lesson_master[forRole]["roleName"]+'</b> role.</input><br>';
	      	$("#adapt_description_div").addClass("hidden");
	      }
	      
	      $("#adapt_options_div").html(radioButtonString);
	      $("#adapt_options_div").removeClass("hidden");

	    }else{
	    	$("#adapt_options_div").addClass("hidden");
	      	$("#adapt_description_div").removeClass("hidden");
	    }

	    adaptTitle = "Adaption of " + lessonName + " for <b>" + role_dictionary[forRole] + "</b>.";
    	adaptDescription = (lesson_master[forRole]["adapt_description"]!="NULL") ? lesson_master[forRole]["adapt_description"] : "";

  	} // END OF IF ELSE TO CHECK IF ORIGINALLY USED

    
  
    $("#adapt_title").html(adaptTitle);
    $("#adapt_description_txt").html(adaptDescription);

    $(".adapt_td").removeClass("bg-td-inselect");
    $("#td_adapt_"+forRole).addClass("bg-td-inselect");
    $("#adaptation_row").removeClass("hidden");
    $("#adaptation_div").fadeIn();

  }


  function fnAnyLiveAdaptations(forRole){
    var live_adapt_array = Array();
    for(var role in lesson_master) {
      var current_role_obj = lesson_master[role];
      //if(current_role_obj["adapt"]==true && role != forRole){
      if(current_role_obj["selected_option"]=="adapt" && role != forRole){
        live_adapt_array.push(role);
      }

    }

    var returnValue = (live_adapt_array.length>0)? live_adapt_array : false;
    return returnValue;

  }


  function fnCloseAdaptationWindow(){
    $("#adaptation_div").fadeOut("fast");
    $("#adaptation_row").addClass("hidden");
    $(".adapt_td").removeClass("bg-td-inselect");
    $('.adapt_chevron').each(function() {
    	$(this).removeClass("glyphicon-chevron-up");
    	$(this).addClass("glyphicon-chevron-down");
	});
    
  }


  function fnCheckDependencies(forRole){
  	$("#adapt_chevron_"+forRole).remove();

  	for(var role in lesson_master) {  	
  		var current_role_obj = lesson_master[role];	
  		if(current_role_obj["reuse_add_from_role"]==forRole && role != forRole){
  			fnResetRoleOptions(current_role_obj["role"]);
  			var radioName = "radiogroup_" + current_role_obj["role"];
  			$('input:radio[name='+radioName+']').iCheck('uncheck');  			
  			$("#adapt_chevron_"+current_role_obj["role"]).remove(); 
  			$("#add_adapt_"+current_role_obj["role"]).addClass("hidden");
  		}
  	}

  }

  function fnShowErrorMessage(messageNum){
  	var messageArray = ["", "Select the appropriate options before saving.", "Enter the required adaptation description before saving.", "Complete the information for all the roles before applying the changes."];
  	$("#errorBox").html(messageArray[messageNum]);
  	$("#errorBox").fadeIn();
  }

  function fnSubmitChanges(){  	
  	proceed_status = checkBeforeApply();
  	
  	if(proceed_status==true){
  		
  		$("#processingDiv").fadeIn();
	  	var action = baseURL + "/submitClientChanges";
	    var form_data = {
	      'clientId': clientId,
	      'lessonId': lessonId,
	      'lesson_master': lesson_master
	    };    

	    $.ajax({
	      type: "POST",
	      url: action,
	      data: form_data,
	      success: function(response)
	      {
         // alert(response);
	      	window.parent.fnLessonUpdated(lessonId, lesson_master);
          window.parent.fnCollateralDamage(response);      	
	      	$("#errorBox").hide();
	      	$("#processingDiv").hide();
	      	$("#msgBox").fadeIn();
	      }
	    });
  	}else{
  		fnShowErrorMessage(3);
  	}
  	

  }


  function checkBeforeApply(){
  	var proceed = true;
  	for(var role in lesson_master) {
  		var current_role_obj = lesson_master[role];	  		
  		if(current_role_obj["selected_option"] == "NULL" && current_role_obj["originallyUsed"]){
  			proceed += role+"$";
  		}
  	}

  	return proceed;
  }