<div class="container">
		
		<br>
		
		<form action="" method ="" class ="form-horizontal" role ="form">
			<div class="fieldset">
				<h4 >Organization Information</h4><br>
				
			
					<div  class="form-group col-sm-6">
					
						<h5> <strong> Organization Name </strong> </h5>
					
						<div id = "Orgname" class ="col-sm-10" >
							<input type="text"  id = "orgname" class ="form-control"  onfocus = "focusfeedback(this)" onblur = "feedback(this)" placeholder ="Enter your organization name here"/>
							<span id = "spanok" class="glyphicon glyphicon-ok form-control-feedback hidden"></span>
							<span id = "spandel" class="glyphicon glyphicon-remove form-control-feedback hidden"></span>
						</div>
						
					</div>
					
					
				<div class= "form-group col-sm-6">
			
					<h5> <strong> Account Number </strong></h5>
				
					<div   id ="Orgnumber" class ="col-sm-10">
						<input type="text" id ="orgnumber" class ="form-control" onfocus = "focusfeedback(this)"  onblur = "feedback(this)"  placeholder ="Enter your organization number here (xxx-xxx-xxx)"/>
						<span id = "spanok1" class="glyphicon glyphicon-ok form-control-feedback hidden"></span>
						<span id = "spandel1" class="glyphicon glyphicon-remove form-control-feedback hidden"></span>
						
					</div>
					
				</div>
		
			</div>
		
		
		
			<div class="fieldset" id ="contactinfo">
				<h4 >Contact Information</h4><br>
				
				<div id = "contact" class="form-group col-sm-6">
				
					<h5> <strong> First Name </strong> </h5>
					<div  id ="Contfname" class ="col-sm-10">
						<input type="text" class ="form-control" id ="contfname" onfocus = "focusfeedback(this)"  onblur = "feedback(this)" placeholder ="Enter your first name here"/>
						<span id = "spanok2" class="glyphicon glyphicon-ok form-control-feedback hidden"></span>
						<span id = "spandel2" class="glyphicon glyphicon-remove form-control-feedback hidden"></span>
					</div>
					
				</div>
					
				
				<div id = "contact" class="form-group col-sm-6">
				
					<h5> <strong> Last Name </strong> </h5>
					<div id ="Contlname" class ="col-sm-10">
						<input type="text" class ="form-control" id ="contlname" onfocus = "focusfeedback(this)" onblur = "feedback(this)" placeholder ="Enter your last name here"/>
						<span id = "spanok3" class="glyphicon glyphicon-ok form-control-feedback hidden"></span>
						<span id = "spandel3" class="glyphicon glyphicon-remove form-control-feedback hidden"></span>
					</div>
					
				</div>
				
				<div id = "contact" class="form-group col-sm-6">
				
					<h5> <strong> Email </strong> </h5>
					<div id ="Contemail" class ="col-sm-10">
						<input type="email" class ="form-control"  id ="contemail" onfocus = "focusfeedback(this)" onblur = "feedback(this)" placeholder ="Enter your email address here"/>
						<span id = "spanok4" class="glyphicon glyphicon-ok form-control-feedback hidden"></span>
						<span id = "spandel4" class="glyphicon glyphicon-remove form-control-feedback hidden"></span>
					</div>
					
				</div>
				
				<div id = "contact" class="form-group col-sm-6">
					<h5> <strong> Phone Number </strong></h5>
				
					<div id ="Contnumber" class ="col-sm-10">
						<input type="text" class ="form-control" id ="contnumber" onfocus = "focusfeedback(this)" onkeyup = "checkdigit(this)" onblur = "phonefeedback(this)" placeholder ="Enter your contact number here (xxx-xxx-xxx)"/>
						<span id = "spanok5" class="glyphicon glyphicon-ok form-control-feedback hidden"></span>
						<span id = "spandel5"  class="glyphicon glyphicon-remove form-control-feedback hidden"></span>
						<div id = "submitwarn" class="alert alert-warning hidden">
						<span  class="glyphicon glyphicon-warning-sign"></span> Wrong input: Digits only. </div>
					</div>
					
				</div>
			</div>
			
			<div role = "form" class = "create">
				<label for="submit"></label>
				<button type ="button" id ="submit"  onclick = "SUbmit(this)" class="btn btn-default col-sm-2"> Save </button>
			</div>
			
			<div role = "form" class = "create">
				<label for="submit"></label>
				<a href="introduction.html"><button type ="button" id ="moveon"  class="btn btn-success col-sm-2 hidden">Begin Enrolling </button></a>
			</div>
			
		</form>
					
		
		<div id = "submitwarn" class="alert alert-warning hidden ">
			<span  class="glyphicon glyphicon-warning-sign"></span> Fill in all information before proceeding 
		</div>
		
		<div id = "submitok" class="alert alert-success hidden col-sm-11">
			<span  class="glyphicon glyphicon-ok"></span> You have successfully added your user details to your account. .
		</div>

	</div>
	
<button class="btn btn-default" onclick="fnSubmitClient()">Submit Details</button>

<script src="<?php echo base_url("assets/js/javascript.js"); ?>"></script> 
<script type="text/javascript">
	var baseURL = <?php echo json_encode($baseURL) ?>;

	function fnSubmitClient(){
		var action = baseURL + "/createnew/addClient";
	    var form_data = {
	      'orgName': "New Front Health",
	      'accountNumber': "10982",
	      'cdhNumber': "1000200300",
	      'first_name': "John",
	      'last_name': "Admin",
	      'email': "john@front.com",
	      'phone': "9000100200",
	    };

	    $.ajax({
	      	type: "POST",
	      	url: action,
	      	data: form_data,
	      	success: function(response)
	      	{		
	      		$('#loadingDiv').hide();

	      		var responseObj = $.parseJSON(response);
	      		alert(responseObj.status);
	      		if(responseObj.status=="Fail"){
	      			$('#errorBox').html("A client with this CDH number already exists in the system.");
	      			$('#errorBox').fadeIn();
	      		}else if(responseObj.status=="Success"){
	      			$('#errorBox').hide();
	      			window.location.href = <?php echo json_encode(base_url("index.php/introduction/")) ?>;
	      		}
	      			
	      	}
	    });
	}

</script>