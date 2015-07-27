function fnChangeSpanBtn(id){
    $("#span_btn_"+id).toggleClass("glyphicon-plus");
    $("#span_btn_"+id).toggleClass("glyphicon-minus");
  }


  function fnLessonUpdated(lessonId, lesson_changes){
    
    for(var role in lesson_changes) {
      var current_role_obj = lesson_changes[role];  
      var status_content = "";

      switch(current_role_obj["selected_option"]){
        case "keep":
          status_content = '<span class="status_badge badge_unchanged">Unchanged</span>';
          break;
        case "add_unchanged":
          status_content = '<span class="status_badge badge_unchanged">Added</span>';
          break;
        case "adapt":
          status_content = '<span class="status_badge badge_adapt">Adapted</span>';
          break;
        case "reuse_adapt":
          resusedFrom = role_dictionary[current_role_obj["reuse_add_from_role"]];
          status_content = '<span class="status_badge badge_adapt">Reused ' + resusedFrom + '</span>';
          break;
        case "add_adapted":
          addedFrom = role_dictionary[current_role_obj["reuse_add_from_role"]];
          status_content = '<span class="status_badge badge_adapt">Added Adapted ' + addedFrom + '</span>';
          break;
        case "remove":
          status_content = '<span class="status_badge badge_remove">Removed</span>';
          break;
        default:
          status_content = '';
      }
      
      $('#statusbox_'+lessonId+'_'+role).html(status_content);
      $('#btn_select_'+lessonId).html("Update Selections");

    }

    fnCheck_AllLessonsReviewed(false, true);
  }

  function fnCollateralDamage(changes){
    var responseObj = $.parseJSON(changes);    
    $.each(responseObj, function(key,single_obj) {      
      $('#statusbox_'+single_obj.lessonId+'_'+single_obj.role).html('<span class="status_badge badge_remove">Removed</span>');
    }); 
    
  }

  function fnAddnewLessonRow(courseId, sequenceNum, newLessonName, for_roles, lessonId){
 
    var this_lesson_roles = for_roles.split("$");
    $(".lesson_row_"+courseId).each(function(index, value) { 
        //console.log('div' + index + ':' + $(this).attr('id'));
        if($(this).attr('data-sequenceNum')==sequenceNum){
          var displace_row_id = $(this).attr('id');
          
          var newRow = '<tr class="lesson_row_'+courseId+'" id="row_new_'+courseId+'_'+lessonId+'"><td>'+newLessonName+'</td><td><span class="glyphicon glyphicon-flag lesson_present_span" aria-hidden="true"> New</span> &nbsp;&nbsp; <a href="#" id="updateLesson_'+lessonId+'"  data-toggle="modal" data-target="#lessonPropModal" onclick="fnEditLessonDialog('+lessonId+')" data-lessonName="'+newLessonName+'">Update</a></td>';
          for(var i=0; i < client_roles_array.length; i++){
            
            if(this_lesson_roles.indexOf(client_roles_array[i])>=0){
              newRow += '<td id="statusbox_new_'+lessonId+'_'+client_roles_array[i]+'"><span class="glyphicon glyphicon-ok lesson_present_span" aria-hidden="true"></span></td>';
            }else{
              newRow += '<td id="statusbox_new_'+lessonId+'_'+client_roles_array[i]+'"> </td>';
            }
            
          }
          newRow +='</tr>';

          $("#"+displace_row_id).before($(newRow));
          //$("#"+displace_row_id).before(newRow);
        }
    });

    //var newRow = $('<tr><td>New Lesson</td><td colspan="4">asd</td></tr>');
    //$("#row_1_1").after(newRow);

  }


  function fnNewLessonUpdated(newLessonId, newLessonName, for_roles, courseId){
    var this_lesson_roles = for_roles.split("$");

    var newRow = '<td>'+newLessonName+'</td><td><span class="glyphicon glyphicon-flag lesson_present_span" aria-hidden="true"> New</span> &nbsp;&nbsp; <a href="#" id="updateLesson_'+newLessonId+'"  data-toggle="modal" data-target="#lessonPropModal" onclick="fnEditLessonDialog('+newLessonId+')" data-lessonName="'+newLessonName+'">Update</a></td>';

    for(var i=0; i < client_roles_array.length; i++){
      
      if(this_lesson_roles.indexOf(client_roles_array[i])>=0){
        newRow += '<td id="statusbox_new_'+newLessonId+'_'+client_roles_array[i]+'"><span class="glyphicon glyphicon-ok lesson_present_span" aria-hidden="true"></span></td>';
      }else{
        newRow += '<td id="statusbox_new_'+newLessonId+'_'+client_roles_array[i]+'"> </td>';
      }
      
    }

    $("#row_new_"+courseId+"_"+newLessonId).html(newRow);
  }


  function fnDeleteAddedLesson(courseId, newLessonId){    
    $('#row_new_'+courseId + '_' + newLessonId).remove();
    //row_new_1_28
  }

  function fnCheck_AllLessonsReviewed(userClicked, showHighlight){

      var action = baseURL + "/check_AllLessonsReviewed"; 
      var form_data = {
        'clientId': clientId,
        'curriculumId': curriculumId,
      };    

      $.ajax({
        type: "POST",
        url: action,
        data: form_data,
        success: function(response)
        {          
          //alert(response);
          var responseObj = $.parseJSON(response);   
          
          if(responseObj.length <= 0 ){
            $("#flowtab_rolereview").removeClass("flow_role-disable");
            $("#flowtab_rolereview").addClass("flow_role");
            $("#flowtab_rolereview").prop("disabled", false);
            $("#flowtab_summary").removeClass("flow_summary-disable");
            $("#flowtab_summary").addClass("flow_summary");
            $("#flowtab_summary").prop("disabled", false);

            //$(".custom-panel-heading").removeClass("custom-panel-warning");
            $(".course_highlight").addClass("hidden");
            if(userClicked){ HandleNextButtonRequest(true); }
          }else{
            if(userClicked){userHasClickedNextOnce = true; HandleNextButtonRequest(false);}

            if(userHasClickedNextOnce && showHighlight){
                //$(".custom-panel-heading").removeClass("custom-panel-warning");
                $(".course_highlight").addClass("hidden");
                $.each(responseObj, function(key,single_obj) {                
                  //$("#course_header_"+single_obj).addClass("custom-panel-warning");  
                  $("#course_highlight_"+single_obj).removeClass("hidden");
                });                
            }
            
            
          }
          
          
        }
      });

    
  }
