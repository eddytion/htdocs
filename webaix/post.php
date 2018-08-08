<?php

date_default_timezone_set('Europe/Berlin');

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$lpar = strip_tags($_GET['lpar']);
$xlc = strip_tags($_GET[['xlc']]);
$ldap = strip_tags($_GET['ldap']);

if(isset($_GET['lpar']) && $_GET['xlc'] == "get" && is_string($_GET['lpar']))
{
    $lpar = strip_tags($_GET['lpar']);
    require("../sap/config.php");
    $query = "SELECT xlc,xlc_version FROM webaix_log WHERE lpar='$lpar' ORDER BY date DESC LIMIT 0,1";
    $result = mysqli_query($db,$query);
    if(mysqli_num_rows($result) == 1)
    {
        while($row = mysqli_fetch_array($result))
        {
            print strtolower($row['xlc']) . " " . strtolower($row['xlc_version']);
        }
    }
    else
    {
        print "NULL";
    }
}
elseif(isset($_GET['lpar']) && $_GET['ldap'] == "get" && is_string($_GET['lpar']))
{
    $lpar = strip_tags($_GET['lpar']);
    require("../sap/config.php");
    $query = "SELECT ldap,ldap_type FROM webaix_log WHERE lpar='$lpar' ORDER BY date DESC LIMIT 0,1";
    $result = mysqli_query($db,$query);
    if(mysqli_num_rows($result) == 1)
    {
        while($row = mysqli_fetch_array($result))
        {
            print strtolower($row['ldap']) . " " . strtolower($row['ldap_type']);
        }
    }
    else
    {
        print "NULL";
    }
}