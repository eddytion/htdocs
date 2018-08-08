<?php

date_default_timezone_set('Europe/Berlin');

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$lpar = strip_tags($_GET['lpar']);
$os = $_GET['os'];
$uuid = $_GET['uuid'];
$date = date("Y-m-d");

if(isset($_GET['uuid']) && $_GET['uuid'] == "get" && is_string($_GET['uuid']))
{
    require("config_websles.php");
    $query = "SELECT * FROM websles_log WHERE lpar='$lpar' ORDER BY date DESC LIMIT 0,1";
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
elseif (isset($_GET['hmc']) && $_GET['hmc'] == "get" && is_string($_GET['hmc']))
{
    require("config_websles.php");
    $query = "SELECT hmc from websles_log WHERE lpar ='$lpar' ORDER BY date DESC LIMIT 0,1";
    $result = mysqli_query($db, $query);
    if(mysqli_num_rows($result) == 1)
    {
        while($row = mysqli_fetch_array($result))
        {
            print "{$row['hmc']}";
        }
    }
    else
    {
        print "NULL";
    }
}
else
{
    require("config_websles.php");
    $query = "SELECT cpp,validation FROM websles_log WHERE lpar='$lpar' ORDER BY date DESC LIMIT 0,1";
    $result = mysqli_query($db,$query);
    if(mysqli_num_rows($result) == 1)
    {
        while($row = mysqli_fetch_array($result))
        {
            print "{$row['cpp']} {$row['validation']}";
        }
    }
    else
    {
        print "NULL";
    }
}