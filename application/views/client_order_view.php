<div class="container-fluid custom-container">  
  
  <div class="row title_row">    
    <div class="col-lg-12 column">
      <h2 class="text-uppercase text-center pageTitle" >Order Summary</h2> 

    </div>    
  </div> <!-- ROW ENDS HERE -->

   <!--<div class="row">
  	 <div class="column col-xs-6">  		
  		<h2><?php echo $clientDetails["orgName"] ?></h2>
  		<h4>Number of Beds = <?php echo $order["pricePerLesson"] ?></h4>
  		<?php
  			foreach ($order as $key => $value) {
  				echo $key." = ".$order[$key]."<br>";
  			}
  		?>
  	</div>
  </div> -->

  <div class="row">
  	<div class="column col-xs-12 text-center">
  		<h3 class="center-block"><?php echo $clientDetails["orgName"] ?></h3>    
  	</div>
  	<div class="col-xs-3 billboard">
  		<div class="well">
  			<h4>Number of Beds <br><span><?php echo $order["multiplierUnitNumber"] ?></span></h4>
  		</div>
  	</div>
  	<div class="col-xs-3 billboard">
  		<div class="well">
  			<h4>Roles Selected: <?php echo sizeof($client_selected_roles) ?> <br><span>
  				<?php 
  				$all_roles = "";
  				foreach($client_selected_roles as $single_role) { 
  					$all_roles .= $role_dictionary[$single_role].", ";
  				} 
  				$all_roles = rtrim($all_roles, ", ");
  				echo $all_roles;
  				?>
  			</span></h4>
  		</div>
  	</div>
  	<div class="col-xs-3  billboard">	
  		<div class="well">
  			<h4>Per Lesson Cost <br><span>$<?php echo $order["pricePerLesson"] ?></span></h4>
  		</div>
  	</div>
  	<div class="col-xs-3  billboard">
  		<div class="well">
  			<h4>Adaptation Cost: <span>$<?php echo $order["adaptationCost"] ?></span></h4>
  			<h4>Removal Cost: <span>$<?php echo $order["removalCost"] ?></span></h4>
  			<h4>New Lesson Cost: <span>$<?php echo $order["newLessonCost"] ?></span></h4>
  		</div>
  	</div>
  </div>

  <div class="row ">
  	<div class="column col-xs-6">
  		<table id="calculation_table" class="table table-bordered table-striped">
  			<tr>
  				<td>Unique Lessons (Includes REs) <span class="math_sign">X</span> Price Per Lesson</td>
  				<td><?php echo $order["defaultLessons"] ?> <span class="math_sign">X</span> $<?php echo $order["pricePerLesson"] ?></td>
  				<td><?php echo ($order["defaultLessons"]*$order["pricePerLesson"])?></td>
  			</tr>
  			<tr>
  				<td>(Unique Lessons <span class="math_sign">X</span> Price Per Lesson) <span class="math_sign">X</span> Number of Beds/Providers Factor</td>
  				<td><?php echo ($order["defaultLessons"]*$order["pricePerLesson"])?> <span class="math_sign">X</span> <?php echo $order["multiplierFactor"] ?></td>
  				<td><?php echo round($order["defaultLessons"]*$order["pricePerLesson"]*$order["multiplierFactor"])?></td>
  			</tr>
  			<tr>
  				<td>Adapted Lessons <span class="math_sign">X</span> Price Per Adaptation</td>
  				<td><?php echo $order["adaptedLessons"] ?> <span class="math_sign">X</span> $<?php echo $order["adaptationCost"] ?></td>
  				<td><?php echo ($order["adaptedLessons"]*$order["adaptationCost"])?></td>
  			</tr>
  			<tr>
  				<td>Removed Lessons <span class="math_sign">X</span> Price Per Removal</td>
  				<td><?php echo $order["removedLessons"] ?> <span class="math_sign">X</span> $<?php echo $order["removalCost"] ?></td>
  				<td><?php echo ($order["removedLessons"]*$order["removalCost"])?></td>
  			</tr>
  			<tr>
  				<td>Affected Readiness Evaluations <span class="math_sign">X</span> Price Per RE Adaptation</td>
  				<td><?php echo $order["reAffected"] ?> <span class="math_sign">X</span> $<?php echo $order["adaptationCost"] ?></td>
  				<td><?php echo ($order["reAffected"]*$order["adaptationCost"])?></td>
  			</tr>
  			<tr>
  				<td>New Lessons Requested <span class="math_sign">X</span> Price Per New Lesson</td>
  				<td><?php echo $order["newlessons"] ?> <span class="math_sign">X</span> $<?php echo $order["newLessonCost"] ?></td>
  				<td><?php echo ($order["newlessons"]*$order["newLessonCost"])?></td>
  			</tr>
  			<tr>
  				<td colspan="2">Sum Total</td>
  				<td><h3>$<?php echo $order["finalPrice"] ?></h3></td>
  			</tr>

  		</table>
  	</div>

  </div>

  <div class="row top-buffer">
  	<div class="column col-xs-6" >
	  	<a href="<?php echo ( base_url('index.php/export/excel').'/'.$clientDetails["clientId"].'/'.$clientDetails["curriculumId"] ) ?>" class="excel_btn" target="_blank"></a><br> Export the selection details
	  	<!-- <span class="h3">Export Detailed Order: </span> -->	  	
	</div>
  </div>

 <!--  <div class="row custom-panel top-buffer">
	 <div class="column col-xs-12">
	    <p>Here is the summary of the selections you have made.
	      <table class="table table-bordered">
	        <tr class="bg-primary">
	          <th>Summary Details</th>
	          <th>Total</th>
	        </tr>
	        <tr>
	          <td>Roles selected for the training</td>
	          <td><?php echo sizeof($client_selected_roles) ?></td>
	        </tr>
	        <tr>
	          <td>Unique Lessons offered by Allscripts for these roles</td>
	          <td><?php echo $order["defaultLessons"] ?></td>
	        </tr>
	        <tr>
	          <td>Lessons Adapted</td>
	          <td><?php echo $order["adaptedLessons"] ?></td>
	        </tr>
	        <tr>
	          <td>Lessons Removed</td>
	          <td><?php echo $order["removedLessons"] ?></td>
	        </tr>
	        <tr>
	          <td>New Lessons Requested</td>
	          <td><?php echo $order["newlessons"] ?></td>
	        </tr>	     
	        
	      </table>	    
	      

	    </div>

  </div> --> <!-- ROW ENDS HERE -->

</div> <!-- END OF CONTAINER -->

<div class="hidden">
	<img src="<?php echo base_url("assets/img/Export-Over.png"); ?>" />
</div>