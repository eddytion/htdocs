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
<nav class="navbar navbar-default navbar-fixed-top" style="padding: 0px;">
  <div class="container-fluid">
    <div class="navbar-header">
        <img class="img-responsive" src="images/sap-logo-svg.svg" alt="SAP" style="margin-top: 2px; margin-right: 0px;">
    </div>
  </div>
</nav>
<br>
<br>
<hr>
<?php
if(isset($_GET['ms']) && is_string($_GET['ms']))
{
    require("config.php");
    if(!$db)
    {
	die("Conn failed: " . mysqli_connect_error());
    }
    else
    {
        $ms_name = $_GET['ms'];
        $sql="SELECT lpar_ms.msname,mem_cpu_lpars.lpar_name, (mem_cpu_lpars.desired_mem/1024) as desired_mem,mem_cpu_lpars.desired_proc_units, "
             ."mem_cpu_lpars.desired_procs,mem_cpu_lpars.proc_mode FROM mem_cpu_lpars"
             ." INNER JOIN lpar_ms ON mem_cpu_lpars.lpar_name=lpar_ms.lparname WHERE lpar_ms.msname like '$ms_name' order by mem_cpu_lpars.lpar_name";
        $result = mysqli_query($db,$sql);
        if (mysqli_num_rows($result) > 0) 
	{
		echo "<table class=\"table table-bordered table-hover\">";
                echo "<thead>";
		echo "<tr>";
		echo "<th>LPAR</th>
		      <th>Desired Memory(GB)</th>
		      <th>Desired CPU</th>
                      <th>CPU mode</th>";
                echo "</thead>";
                echo "<tbody>";
		while($row = mysqli_fetch_assoc($result)) 
		{
			echo "<tr>";
			echo "<td>" . $row["lpar_name"] . "</td><td>" . 
                             $row["desired_mem"] . "</td>";
                             if($row['proc_mode'] == "ded")
                             {
                                print "<td>" . $row["desired_procs"] . "</td>"; 
                             }
                             else
                             {
                                 echo "<td>" . $row["desired_proc_units"] . "</td>";
                             }
                        echo "<td>" . $row["proc_mode"] . "</td>";
			echo "</tr>";
		}
                echo "</tbody>";
		echo "</table>";
	}
	else
	{
	    echo "0 results";
	}
        
        $query = "SELECT * FROM ms_mem WHERE ms_name='$ms_name' ";
        $result2 = mysqli_query($db,$query);
        if (mysqli_num_rows($result2) > 0) 
	{
		echo "<table class=\"table table-bordered table-hover\">";
                echo "<thead>";
		echo "<tr>";
                echo "<th title=\"The amount of memory on the managed system that is being used by system firmware at the time of the sample.\">Sys Firmware Mem (GB)</th>
		      <th title=\"The amount of memory which has been deconfigured due to some hardware error\">Deconfigured System Memory (GB)</th>";
                echo "</thead>";
                echo "<tbody>";
                while($row2 = mysqli_fetch_assoc($result2))
                {
                    print "<tr>";
                    print "<td>" . round($row2['sys_firmware_mem']/1024) . "</td>";
                    print "<td>" . round($row2['deconfig_sys_mem']/1024) . "</td>";
                    print "</tr>";
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