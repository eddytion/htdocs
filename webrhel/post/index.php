<?php

date_default_timezone_set('Europe/Berlin');

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$lpar = strip_tags($_GET['lpar']);
$date = date("Y-m-d");

if(isset($_GET['uuid']) && $_GET['uuid'] == "get" && is_string($_GET['uuid']))
{
    require("config.php");
    $query = "SELECT * FROM webrhel_log WHERE lpar='$lpar' AND date LIKE '{$date}%' ORDER BY date DESC LIMIT 0,1";
    $result = mysqli_query($db,$query);
    if(mysqli_num_rows($result) == 1)
    {
        while($row = mysqli_fetch_array($result))
        {
            print "{$row['uuid']}";
        }
    }
    else
    {
        print "NULL";
    }
}