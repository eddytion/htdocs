<?php 
include('header.php');
if(isset($_POST['cpu_type']) && is_string($_POST['cpu_type']) && isset($_POST['submit_lpar']) && is_string($_POST['submit_lpar']))
{
    $_SESSION['lpar_name'] = strip_tags($_POST['lpar_name']);
    $_SESSION['cpu_type'] = strip_tags($_POST['cpu_type']);
    $_SESSION['profile_name'] = strip_tags($_POST['profile_name']);

    $cpu_type=strip_tags($_POST['cpu_type']);
    if($cpu_type == "shared")
    {
        include('shared.php');
    }
    else
    {
        include('dedicated.php');
    }
}