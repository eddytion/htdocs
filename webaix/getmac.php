<?php

date_default_timezone_set('Europe/Berlin');

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$lpar = strip_tags($_GET['lpar']);

if(isset($_GET['lpar']) && $_GET['mac'] == "get" && is_string($_GET['lpar']))
{
    $lpar = strip_tags($_GET['lpar']);
    require("../sap/config.php");
    $query = "SELECT mac_addr FROM lpar_eth WHERE lpar_name='$lpar' AND is_trunk='0' AND port_vlan_id='10'";
    $result = mysqli_query($db,$query);
    if(mysqli_num_rows($result) == 1)
    {
        while($row = mysqli_fetch_array($result))
        {
            print strtolower($row['mac_addr']);
        }
    }
    else
    {
        print "NULL";
    }
}
