<div class="container-fluid custom-container">  
  
  <div class="row title_row">    
    <div class="col-lg-12 column">
      <h2 class="text-uppercase text-center pageTitle" >Clients</h2>     
    </div>    
  </div> <!-- ROW ENDS HERE -->

  <div class="row form_row">

  	<div class="column col-xs-12" style="padding-right:0px">
  		<button id="add_client_btn" class="btn btn-primary pull-right">Add Client <span id="add_client_glyph" class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></button>
  	</div>

  	<form id="defaultForm" method="" class="" action="">
	  	<div id="clientForm_div" class="clientForm_div">
			<div class="column col-xs-4">
				<div class="form-group">
					<label class="control-label" for="orgName">Organization Name</label>
					<input type="text" class="form-control" id="orgName" name="orgName" placeholder="Enter Organization Name" value=""> 
				</div>
			</div>

			<div class="column col-xs-4">
				<div class="form-group">
					<label class="control-label" for="contactName">Contact Name</label>
					<input type="text" class="form-control" id="contactName" name="contactName" placeholder="John Doe" value="">
				</div>
			</div>

			<div class="column col-xs-4">
				<div class="form-group">
					<label class="control-label" for="contactEmail">Email</label>
					<input type="text" class="form-control" id="contactEmail" name="contactEmail" placeholder="john.doe@example.com" value="">				 
				</div>	
			</div>
			
			<div class="column col-xs-12">
				<button type="submit" class="btn btn-primary center-block">Submit</button>
			</div>
	  		
	  		<div class="column col-xs-12" style="margin:5px 0px">
		  		<div id="msgBox" class="msgBox bg-success">
		          The client has been added. A mail with login details to the tool has been sent to the contact person.
		        </div>
		        <div id="errorBox" class="msgBox bg-danger">
		          This client already exists.
		        </div>

		    </div>
		</div> <!-- End of clientForm_div  -->

	</form>

  </div> <!-- END OF ROW -->

  <div class="row">
  	<div class="column col-xs-12">
  		<table id="clientlist_table" class="table table-bordered table-striped">
  			<tr>
  				<th>Organization Name</th>
  				<th class="hidden-sm hidden-xs">Account Number</th>
  				<th>Curriculum</th>
  				<th class="hidden-sm hidden-xs">Contact Name</th>
  				<th class="hidden-sm hidden-xs">Contact Email</th>
  				<th>Order Status</th>
  				<th>Order Accepted On</th>
  				<th>Actions</th>
  			</tr>
  	
  			<?php 
	  			foreach ($clients as $client) { 
	  				echo '<tr>';

	  				echo '<td>'.$client['orgName'].'</td>';
	  				echo '<td class="hidden-sm hidden-xs">'.$client['accountNumber'].'</td>';
	  				echo '<td>'.$client['curriculumName'].'</td>';
	  				echo '<td class="hidden-sm hidden-xs">'.$client['contactName'].'</td>';
	  				echo '<td class="hidden-sm hidden-xs">'.$client['contactEmail'].'</td>';
	  				if($client['order_final']==1){
	  					echo '<td>Order Submiited</td>';
	  					echo '<td>'.$client['order_accepted_date'].'</td>';
	  					$order_url = base_url("index.php/clientlist/showOrder/")."/".$client["clientId"]."/".$client["curriculumId"];
	  					echo '<td><a href="'.$order_url.'">Order Details</td>';
	  				}else{
	  					echo '<td>NA</td>';
	  					echo '<td>NA</td>';
	  					echo '<td>NA</td>';
	  				}

	  				echo '</tr>';

	  			}
  			?>

  		</table>
  	</div>
  </div>
 


</div> <!-- END OF CONTAINER -->

<script type="text/javascript">
	var baseURL = <?php echo json_encode(base_url("index.php/clientlist/")) ?>;
	$('input, textarea').placeholder();

	$("#add_client_btn").click(function(){
		$("#clientForm_div").fadeToggle();
		$("#add_client_glyph").toggleClass("glyphicon-chevron-down");
		$("#add_client_glyph").toggleClass("glyphicon-chevron-up");
	})

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
		            orgName: {
		                validators: {
		                    notEmpty: {
		                        message: 'The organization name is required'
		                    }
		                }
		            },		            
		            contactName: {	                
		                validators: {
		                    notEmpty: {
		                        message: 'The contact name is required'
		                    }
		                }
		            },		            
		           
		            contactEmail: {
		                validators: {
		                    notEmpty: {
		                        message: 'The email address is required'
		                    },
		                    emailAddress: {
		                        message: 'The input is not a valid email address'
		                    }
		                }
		            }
		        }
		    })	
			.on('success.form.fv', function(e) {
	            //console.log('success.form.fv');
	            e.preventDefault();
	            fnAddClient();

	            // If you want to prevent the default handler (formValidation._onSuccess(e))
	            // 
	        });
	});
	
	function fnAddClient(){
		$("#errorBox").hide();    
		var action = baseURL + "/addClient";
	    var form_data = {		      
	      'orgName': $("#orgName").val(),		      
	      'contactName': $("#contactName").val(),		      
	      'contactEmail': $("#contactEmail").val()		      
	    };

	    $.ajax({
	      	type: "POST",
	      	url: action,
	      	data: form_data,
	      	success: function(response)
	      	{	
	      		if(response!="User Exists"){
	      			$("#msgBox").fadeIn();	      

	      			var newRow = '<tr><td>'+ $("#orgName").val()+ '</td> <td></td> <td></td> <td>' + $("#contactName").val() + '</td> <td>' + $("#contactEmail").val() + '</td> <td>NA</td><td>NA</td><td>NA</td>';
	      			$('#clientlist_table > tbody').append(newRow);
	      			
	      		}else{
	      			$("#errorBox").fadeIn();
	      		}

	      	}
	    });

      	
	      	
		
	}


</script>