<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Multiple install</title>
	<!-- Force IE latest version -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" type="text/css" media="all" href="styles/bootstrap.min.css" />
	<style type="text/css">	
	body {
                padding-top: 10px;
                padding-left: 20px;
                padding-right: 20px;
                background-image: url('images/black_suse.jpg');
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
<div class="alert alert-success">
    <strong>1) Please be careful that this process works only for Linux</strong>
    <p>As a best practice, name your file like &lt; IT Direct Ticket &gt;.csv (eg: 72810027736.csv)</p>
    <p>
        <b>2) The structure of the CSV file is as follows:</b>
        <br>
        <i>lparname,boot_disk_uuid,os_version,C++,Validation,Make ( each LPAR entry on 1 line )</i>
        <br>
        <b>3) Example:</b>
        <br>
        lsh35000,60100029399209023802840280804,rhel72,No,No,No
        <br>
        lsh35999,60100029399209023802840299999,sles12sp1,No,No,Yes
    </p>
</div>
    <form action="" enctype="multipart/form-data" method="post">
        <div class="fileUpload btn btn-primary">
            <span>Choose</span>
            <input type="file" class="filestyle" name="fileToUpload"/>
            <input type="submit" class="btn btn-default" name="upload" value="Upload">
        </div>
    </form>
</body>
</html>
<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
if(isset($_POST['upload']))
{
    $target_dir = "/var/www/html/uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $csv_mimetypes = array(
        'text/csv',
        'text/plain',
        'application/csv',
        'text/comma-separated-values',
        'application/excel',
        'application/vnd.ms-excel',
        'application/vnd.msexcel',
        'text/anytext',
        'application/octet-stream',
        'application/txt',
    );

    if (in_array($_FILES["fileToUpload"]['type'], $csv_mimetypes))
    {
       if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
       {
           echo "<div class=\"alert alert-info\">The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</div>";
           $cmd = "/srv/scripts/multiple.pl $target_file";
           
           while (@ ob_end_flush());
           $proc = popen($cmd, 'r');
           
           echo '<pre>';
           while (!feof($proc))
           {
               echo fread($proc, 4096);
               @ flush();
           }
           pclose($proc);
           echo '</pre>';
       } 
       else 
       {
           echo "<div class=\"alert alert-danger\"><b>Sorry, there was an error uploading your file.</b></div>";
       }
    }
    else
    {
        print "<div class=\"alert alert-danger\"><b>Only csv files allowed</b></div>";
    }
}