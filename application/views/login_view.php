
<header class="intro">
	<div class="intro-head">
		<div class="container-fluid">
			<div clas="row">
				<img src="<?php echo base_url("assets/img/Logo.png"); ?>" />
			</div>
		</div>
	</div>
    <div class="intro-body">
        <div class="container">
            <div class="row">            	
            	<div class="column col-md-8 col-md-offset-2">
            		<form class="" action="javascript:fnLogin()">

	            		<div class="loginDiv">

	            			<div class="form-fields">															
	            				<div class="title" style="">Administrator Login</div>
								<div class="input-group">										
									<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
									<input type="email" class="form-control" id="mail" name="mail" placeholder="Enter email" aria-describedby="basic-addon1">
								</div>
							
								<div class="input-group" style="margin-top:10px;" >					
									<span class="input-group-addon" id="basic-addon2" style="line-height:10px!important"><span class="glyphicon glyphicon-lock" ></span></span>	
									<input type="password" class="form-control"  id="password" name="password" placeholder="Password"  aria-describedby="basic-addon2">
																
								</div>

								<div class="forgot-password-div" style="margin-top:15px; font-size:16px">
									<a href="#" class=""  data-toggle="modal" data-target="#myModal">Forgot Password?</a>
								</div>
												
								<!-- <button type="submit" class="btn btn-primary center-block" onclick="fnLogin()">Submit</button> -->							
						
							</div>

							<div class="loginBtn">
								<button type="submit" class="login-label"  onclick="fnLogin()">Login</button>
							</div>

							<div class="">
								<div id="loadingDiv" class="loadingDiv">
								    <img src="<?php echo base_url("assets/img/loader.gif"); ?>" /> Processing..
								</div>  

								<div id="msgBox" class="messageBox bg-correct">
								    Your changes have been saved. You may close this dialog now.		      
								</div>

								<div id="errorBox" class="messageBox bg-error">
								    Enter a valid email address.
								</div>
							</div>

						</div>	<!-- /End of  loginDiv -->

					</form>

				</div>    

           	</div>

        </div>

    </div> 

    <div class="intro-footer">
    	<div class="container-fluid">
    		<div clas="row">
    			<img src="<?php echo base_url("assets/img/Allscripts-logo-small.png"); ?>" />
    		</div>
		</div>
    </div>   


</header>

<!-- Preload the hover images -->
<div class="hidden">
  <img src="<?php echo base_url("assets/img/Login Button_Over.png"); ?>" />
</div>


<div class="modal fade" id="myModal" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Password Recovery</h4>
      </div>
      <div class="modal-body">
	      	<p>Enter your registered email address and we'll mail you a temporary password.</p>
	      	<label class="control-label" for="forgotMail">Email Address</label>
	        <input type="email" class="form-control" id="forgotMail" name="forgotMail" placeholder="Enter email">

	        <div id="msg-error" class="bg-danger hidden" style="margin-top:20px; padding:5px;">
	        	<p>This email is not registered in the system. Please check the email address and retry.</p> 
	        	<p>For further assisstance/queries you can reach out to <a href="mailTo:info-curricula@allscripts.com">info-curricula@allscripts.com</a>.</p>
	    	</div>

	    	<div id="msg-success" class="bg-success hidden" style="margin-top:20px; padding:5px;">
	        	<p>Your password has been reset! You will be receiving a mail with the temporary password shortly to the above mail address. If you cannot find it in your Inbox, please check the Junk/Spam folders as well.</p> 
	        	<p>If you are still facing problems logging in, you can write to <a href="mailTo:info-curricula@allscripts.com">info-curricula@allscripts.com</a>.</p>
	        </div>

      </div>
      <div class="modal-footer">	        
        <button id="forgot_submit_btn" type="button" class="btn btn-primary" onclick="fnForgotPassword()">Submit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
	var baseURL = <?php echo json_encode(base_url("index.php/login/")) ?>;

	$('input, textarea').placeholder();
	
	function fnForgotPassword(){
		if(validateEmail($("#forgotMail").val()))
		{
			var action = baseURL + "/forgotPassword";
		    var form_data = {
		      'forgotMail': $("#forgotMail").val()
		    };

		    $.ajax({
		      	type: "POST",
		      	url: action,
		      	data: form_data,
		      	success: function(response)
		      	{		      				      
		      		if(response == "Success"){
		      			$("#msg-success").removeClass("hidden");
		      			$("#msg-error").addClass("hidden");
		      			$("#forgot_submit_btn").hide();
		      		}else{
		      			$("#msg-success").addClass("hidden");
		      			$("#msg-error").removeClass("hidden");
		      		}		      		
		      	}
		    });
		}
		else
		{
			alert("Enter a valid email address.");
		}
		
	}

	function fnLogin(){
		if(validateEmail($("#mail").val()))
		{
			$('#errorBox').hide();
			$('#loadingDiv').show();
			var action = baseURL + "/doLogin";
		    var form_data = {
		      'mail': $("#mail").val(),
		      'password': $("#password").val()
		    };

		    $.ajax({
		      	type: "POST",
		      	url: action,
		      	data: form_data,
		      	success: function(response)
		      	{		
		      		//alert(response); 		      		
		      		$('#loadingDiv').hide();  		      		
		      		if(response=="Fail"){
		      			$('#errorBox').html("Either the email or password is incorrect. Please verify and try again.");
		      			$('#errorBox').fadeIn();
		      		}else{
		      			//var url = <?php echo json_encode(base_url("index.php/entry/client")) ?> + "/" + response;
		      			var url = <?php echo json_encode(base_url("index.php/clientlist/getClients")) ?>;
		      			window.location.href = url;
		      		}	      		
		      		    		
		      	}
		    });
		}
		else
		{
			$('#errorBox').html("Enter a valid email address.");
			$('#errorBox').fadeIn();
		}
		
	}


	function validateEmail(email) { 
	    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    return re.test(email);
	} 

</script>
