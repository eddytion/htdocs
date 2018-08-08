<?php
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
	<title>SAP DC Info</title>
	<!-- Force IE latest version -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" type="text/css" media="all" href="styles/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" media="all" href="styles/bootstrap-select.css" />
        <link rel="stylesheet" type="text/css" media="all" href="styles/bootstrap-theme.min.css" />
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
                <script src="js/respond.min.js"></script>
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
	newwindow=window.open(url,'name','height=800,width=1200,scrollbars=yes,toolbar=no,menubar=no,directories=no,titlebar=no');
	if (window.focus) {newwindow.focus();}
	return false;
}

// -->
</script>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
        <img class="img-responsive" src="images/sap-logo-svg.svg" alt="SAP" style="margin-top: 2px; margin-right: 20px;">
    </div>
    <ul class="nav navbar-nav">
      <li <?php if(isset($_GET['dc'])){ if($_GET['dc'] == "dc23") {print "class=\"active\""; } } ?>><a href="index.php?dc=dc23">Hana new ( DC23 )</a></li>
      <li <?php if(isset($_GET['dc'])){ if($_GET['dc'] == "dc53") {print "class=\"active\""; } } ?>><a href="dc53.php?dc=dc53">Hana old ( DC53 )</a></li>
      <li <?php if(isset($_GET['dc'])){ if($_GET['dc'] == "aix") {print "class=\"active\""; } } ?>><a href="aix.php?dc=aix">AIX Landscape</a></li>
      <li <?php if(isset($_GET['dc'])){ if($_GET['dc'] == "report") {print "class=\"active\""; } } ?>><a href="report.php?dc=report">Download</a></li>
    </ul>
  </div>
</nav>
<br>
<hr>
