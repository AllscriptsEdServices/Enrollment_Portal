<!DOCTYPE HTML>
<html lang="en" >
<head>
<meta charset="utf-8" />
<meta name="author" content="Vishwajit Menon" />
<title>Education Services - Curriculum Builder</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="shortcut icon" href="<?php echo base_url("favicon.ico"); ?>">

<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>">
<link rel="stylesheet" href="<?php echo base_url("assets/css/intro.css"); ?>">


<!-- Dynamically include header files from the controller. So header is re-usable -->
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

<!-- For fixed navbar class -> navbar-fixed-top -->
<nav class="navbar navbar-custom navbar-fixed-top" id="myNavbar" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-main"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
	    <a class="navbar-brand" id="brandName" href="#">
        <img class="" src="<?php echo base_url("assets/img/Logo.png"); ?>"/>        
      </a>
	</div>

  <div class="collapse navbar-collapse" id="navbar-collapse-main">
    <ul id="mainNav" class="nav navbar-nav navbar-right">     
        <li id="intro"><a href="<?php echo base_url("index.php/intro/") ?>">INTRODUCTION</a></li>
        <li id="clients"><a href="<?php echo base_url("index.php/entry/client/").'/'.$userData['clientId'] ?>">CLIENT DETAILS</a></li>
        <?php if($userData["selection_active"] == 1){ ?>
          <li id="selections" class=""><a href="<?php echo base_url("index.php/courselist/getCourses/").'/1/'.$userData['clientId'] ?>">SELECTIONS</a></li>
        <?php }else{  ?>
          <li id="selections" class="disabled"><a href="<?php echo base_url("index.php/courselist/getCourses/").'/1/'.$userData['clientId'] ?>">SELECTIONS</a></li>
       <?php  }   ?>
        
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Welcome <?php echo $userData["name"] ?><strong class="caret"></strong></a>
            <ul class="dropdown-menu">
              <li>
                <a href="#"><?php echo $userData["mail"] ?></a>
              </li>
              <li>
                <a href="<?php echo base_url("index.php/logout"); ?>">Logout</a>
              </li>
            </ul>
        </li> 
        
    </ul>
  </div>

  </div>
</nav>
<!-- /navbar --> 