<?php
session_start(); // Session starts here.

if(file_exists("../maintenance/maintenance.mod"))
{
    header("Location: ../maintenance/index.php");
}
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

// **PREVENTING SESSION HIJACKING**
// Prevents javascript XSS attacks aimed to steal the session ID
ini_set('session.cookie_httponly', 1);

// **PREVENTING SESSION FIXATION**
// Session ID cannot be passed through URLs
ini_set('session.use_only_cookies', 1);

// Uses a secure connection (HTTPS) if possible
ini_set('session.cookie_secure', 1);

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>VIOS Install</title>
	<!-- Force IE latest version -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" type="text/css" media="all" href="styles/bootstrap.min.css" />
	<style type="text/css">	
	body {
                padding-top: 58px;
                padding-left: 20px;
                padding-right: 20px;
                background-image: url('images/back_lpar.jpg');
                background-size: 100%;
	     }
        </style>
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
	<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
	<![endif]-->
	<meta name="robots" content="noindex, nofollow" />
<script>
function goBack() {
    window.history.back();
}
</script>
</head>
<body>
<script type="text/javascript">
<!--
function popitup(url) {
	newwindow=window.open(url,'name','height=300,width=650,scrollbars=yes,toolbar=no,menubar=no,directories=no,titlebar=no');
	if (window.focus) {newwindow.focus();}
	return false;
}

// -->
</script>
	<div class="navbar navbar-fixed-top" style="border-top: 3px solid #0088cc">
	<div class="navbar-inner" style="padding:0">
	<div class="container-fluid ">	
	<ul class="nav"> 				
	<li class="active" ><h4>VIOS Install &nbsp;</h4></li>
        <li><a href="../websles/index.php">SLES Installation</a></li>
        <li><a href="../weblpar/index.php">LPAR Creation</a></li>
        <li><a href="../webrhel/index.php">RHEL Installation</a></li>
        <li><a href="../webaix/index.php">AIX Installation</a></li>
        <li><a href="../webvios/index.php">VIOS Re-image</a></li>
        <li class="active"><a href="index.php">VIOS Install</a></li>
        <li><a href="../sancmd/index.php">SAN cmd generator</a></li>
	</ul>
	</div>
	</div>
</div>