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
	<title>AIX Web Install</title>
	<!-- Force IE latest version -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" type="text/css" media="all" href="styles/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" media="all" href="styles/bootstrap-select.css" />
	<style type="text/css">	
	body {
                background-image: url('../webaix/images/back_aix.jpg');
                background-size: 100%;
	     }
        </style>
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
	<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
	<![endif]-->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/prevent-double-submission.js"></script>
        <script src="js/bootstrap-select.min.js"></script>
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

<nav class="navbar navbar-default" style="padding: 0px;">
  <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="#"><b>AIX Web Install</b></a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="../websles/index.php">SLES Installation</a></li>
        <li><a href="../weblpar/index.php">LPAR Creation</a></li>
        <li><a href="../webrhel/index.php">RHEL Installation</a></li>
        <li class="active"><a href="index.php">AIX Installation</a></li>
        <li><a href="../webvios/index.php">VIOS Re-image</a></li>
        <li><a href="../webviosinst/index.php">VIOS Install</a></li>
        <li><a href="../sancmd/index.php">SAN cmd generator</a></li>
    </ul>
  </div>
</nav>