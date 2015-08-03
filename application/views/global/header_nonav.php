<!DOCTYPE HTML>
<html lang="en" >
<head>
<meta charset="utf-8" />
<meta name="author" content="Peace Odiase" />
<title>Enrollment Portal</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- <link rel="shortcut icon" href="<?php echo base_url("favicon.ico"); ?>" type="image/x-icon" />
<link rel="icon" href="<?php echo base_url("favicon.ico"); ?>" type="image/x-icon" /> -->

<!-- Loading commonly used CSS -->
<!-- <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'> -->
<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>">
<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap-theme.min.css"); ?>">
<link rel="stylesheet" href="<?php echo base_url("assets/css/stylesheet.css"); ?>">
<!--<link rel="stylesheet" href="<?php echo base_url("assets/plugins/iCheck-master/skins/square/green.css"); ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url("assets/plugins/formvalidation-master/dist/css/formValidation.css"); ?>" rel="stylesheet">-->

<!-- Dynamically include header files from the controller/individual pages. So header is re-usable -->
<?php foreach ($headerfiles as $item): ?>
	<?php echo $item ?>
<?php endforeach ?>

<script src="<?php echo base_url("assets/js/modernizr.custom.26324.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/css3-mediaqueries.js"); ?>"></script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->


<script src="<?php echo base_url("assets/js/jquery-1.11.0.js"); ?>"></script> 
<script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script> 


<!--<script src="<?php echo base_url("assets/plugins/iCheck-master/icheck.js"); ?>"></script> 
<script src="<?php echo base_url("assets/plugins/jquery-placeholder-master/jquery.placeholder.min.js"); ?>"></script> 
<script src="<?php echo base_url("assets/plugins/formvalidation-master/dist/js/formValidation.js"); ?>"></script> 
<script src="<?php echo base_url("assets/plugins/formvalidation-master/dist/js/framework/bootstrap.js"); ?>"></script> -->

</head>

<body>
<nav class = "navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a class ="navbar-brand" href="scmlogon.html"> Allscripts Learning Center Enrollment Form </a>
    </div>  
    <!-- <div>
      <ul id="mainNav" class="nav navbar-nav navbar-right">      
      
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> Welcome<span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li><a href="#">Profile </a></li>
              <li><a href="#">Log out</a></li>
            </ul>
          </li>
      
       </ul>
    </div> -->
  </div>
</nav>  

