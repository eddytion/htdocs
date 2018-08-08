<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>LPAR DB Update</title>
	<!-- Force IE latest version -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" type="text/css" media="all" href="styles/bootstrap.min.css" />
	<style type="text/css">	
	body {
                padding-top: 58px;
                padding-left: 20px;
                padding-right: 20px;
                background-size: 100%;
                background-color: #eee;
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
    <form action="" method="post" enctype="multipart/form-data">
        <table class="table">
            <tr>
                <td><input type="text" value="<?php $text = rand(10000,99999); print "$text"; ?>" name="vercode" readonly></td>
                <td><input type="text" name="captcha" placeholder="Enter the number displayed"></td>
            </tr>
            <tr>
                <td colspan="2"><p align="center"><input type="submit" value="Update DB" class="btn btn-medium btn-primary" name="submit"></p></td>
            </tr>
        </table>
    </form>
<?php
if(isset($_POST['submit']))
{
    $validate = $_POST['vercode'];
    $input = $_POST['captcha'];
        if($validate === $input)
        {
            $cmd = "/srv/scripts/test.sh";
            while (@ ob_end_flush());
            $proc = popen($cmd, 'r');
    
            while (!feof($proc))
            {
                echo fread($proc, 4096);
                @ flush();
            }
            pclose($proc);
        }
        else
        {
            die("Invalid validation code");
        }
}