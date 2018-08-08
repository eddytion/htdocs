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
<nav class="navbar navbar-default" style="padding: 0px;">
  <div class="container-fluid">
    <div class="navbar-header">
        <img class="img-responsive" src="images/sap-logo-svg.svg" alt="SAP" style="margin-top: 2px; margin-right: 0px;">
    </div>
  </div>
</nav>
<?php
if(isset($_GET['svc']) && is_string($_GET['svc']))
{
    require("config.php");
    if(!$db)
    {
	die("Conn failed: " . mysqli_connect_error());
    }
    else
    {
        $svc_name = $_GET['svc'];
        $sql="SELECT * FROM svc WHERE svc='$svc_name' ";
        $result = mysqli_query($db,$sql);
        if (mysqli_num_rows($result) > 0) 
	{
		echo "<table class=\"table table-bordered table-hover\">";
                echo "<thead>";
		echo "<tr>";
		echo "<th>Storage name</th>
		      <th>Total Capacity (GB)</th>
		      <th>Free Capacity (GB)</th>
                      <th>Used Capacity (GB)</th>";
                echo "</thead>";
                echo "<tbody>";
		while($row = mysqli_fetch_assoc($result)) 
		{
			echo "<tr>";
			echo "<td>" . $row["storage_name"] . "</td>"
                            ."<td>" . round($row["capacity"]/1024/1024/1024) . "</td>"
                            ."<td>" . round($row['free_capacity']/1024/1024/1024) ."</td>"
                            ."<td>" . round($row['used_capacity']/1024/1024/1024) ."</td>";
			echo "</tr>";
 		$counter++;
		}
                echo "</tbody>";
		echo "</table>";
	}
	else
	{
	    echo "0 results";
	}
	mysqli_close($db);
    }
}
else
{
    die("<h2>Bad Request</h2>");
}
