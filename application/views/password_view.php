<div class="container custom-container" >
	<div class="row title_row">
		<div class="column col-lg-12 text-center">
			<h2 class="pageTitle text-uppercase" style="font-weight:bolder">Password Update</h2>
		</div>
	</div> <!-- End of Row -->


	<div class="row">

		<form id="defaultForm" method="" class="" action="">

			<div class="column col-sm-4 col-sm-offset-4">

				<p>Please fill in the details below to change your password.</p>

				<div class="form-group">
					<label class="control-label" for="orgName">Old Password</label>
					<input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Enter Old Password" value="">				 
				</div>	

				<div class="form-group">
					<label class="control-label" for="orgName">New Password</label>
					<input type="password" class="form-control" id="newpassword_1" name="newpassword_1" placeholder="Enter New Password" value="">				 
				</div>

				<div class="form-group">
					<label class="control-label" for="orgName">New Password Confirm</label>
					<input type="password" class="form-control" id="newpassword_2" name="newpassword_2" placeholder="Re-Enter New Password" value="">				 
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary  center-block">Change Password</button>
				</div>
				

			</div>

		</form>

	</div> <!-- End of Row -->

	<div class="row top-buffer">
		<div class="column col-sm-6 col-sm-offset-3 text-center" >

	        <div id="processingDiv" class="processingDiv bg-info">
	          <img src="<?php echo base_url("assets/img/loader.gif"); ?>" /> Processing..
	        </div> 

	        <div id="msgBox" class="msgBox bg-success">
	          Your password has been successfully updated.<br>
	          Click <a href="<?php echo base_url("index.php/logout"); ?>"><b>here</b></a> to log in again with the new password.     
	        </div>

	        <div id="errorBox" class="msgBox bg-danger">
	         The old password you entered does not match. Please check and try again.
	        </div>

      	</div>  <!-- /End of Column -->
    </div> <!-- End of Row -->


	

</div> <!-- End of Container -->

<script type="text/javascript">
	$('input, textarea').placeholder();
	var baseURL = <?php echo json_encode(base_url("index.php/password/")) ?>;

	$(document).ready(function() {
	   
	    $('#defaultForm')
		    .formValidation({

		        message: 'This value is not valid',
		        icon: {
		            valid: 'glyphicon glyphicon-ok',
		            invalid: 'glyphicon glyphicon-remove',
		            validating: 'glyphicon glyphicon-refresh'
		        },

		        fields: {		            
		            oldPassword: {	                
		                validators: {
		                    notEmpty: {
		                        message: 'The old password cannot be empty.'
		                    }
		                }
		            },
		            newpassword_1: {
		                validators: {
		                    notEmpty: {
		                    	message: 'The password cannot be empty.'
		                    },
		                    stringLength: {
		                        min: 6,
		                        max: 20,
		                        message: 'The password must be more than 6 and less than 20 characters long.'
		                    }
		                }
		            },
		            newpassword_2: {
		                validators: {
		                    notEmpty: {
		                    	message: 'The password cannot be empty.'
		                    },
		                    identical: {
		                        field: 'newpassword_1',
		                        message: 'The password and its confirm are not the same.'
		                    }
		                }
		            }
		            
		        }
		    })	
			.on('success.form.fv', function(e) {
	            //console.log('success.form.fv');
	            e.preventDefault();
	            fnUpdatePassword();

	            // If you want to prevent the default handler (formValidation._onSuccess(e))
	            // 
	        });
	});

	
	function fnUpdatePassword(){
		$("#errorBox").hide();
		$("#processingDiv").show();
		
		var action = baseURL + "/changePassword";
	    var form_data = {	      
	      'oldPassword': $("#oldPassword").val(),
	      'newpassword_1': $("#newpassword_1").val()	     
	    };

	    $.ajax({
	      	type: "POST",
	      	url: action,
	      	data: form_data,
	      	success: function(response)
	      	{	
	      		
	      		if(response=="Success"){
	      			$("#processingDiv").hide();
	      			$("#msgBox").fadeIn();     

	      			$("#client_list").addClass("disabled");	      			
	      			$("#user_profile").addClass("disabled");	      			
	      			
	      		}else{
	      			$("#processingDiv").hide();
	      			$("#errorBox").show();
	      		}	      	   			
	      		    		
	      	}
	    });

      	
	      	
		
	}


</script>