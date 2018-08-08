<?php include('header.php'); ?>
<div class="alert alert-info"><strong>System summary</strong></div>
<hr>
<?php
if(isset($_POST['submit_mem']) && is_string($_POST['submit_mem']))
{
    $hmc = $_SESSION['hmc'];
    $lpar = $_SESSION['lpar_name'];
    $ms = $_SESSION['ms'];
    $profile = $_SESSION['profile_name'];

    $min_mem = strip_tags($_POST['min_mem']);
    $desired_mem = strip_tags($_POST['desired_mem']);
    $max_mem = strip_tags($_POST['max_mem']);
    
    if($max_mem < $desired_mem || $max_mem < $min_mem)
    {
        print "<span class=\"alert alert-danger\">Max memory cannot be smaller than min memory or desired memory</span><br><br>";
    }

    $_SESSION['min_mem'] = $min_mem;
    $_SESSION['desired_mem'] = $desired_mem;
    $_SESSION['max_mem'] = $max_mem;

    $cpu_type = $_SESSION['cpu_type'];
    
    $min_procs = $_SESSION['min_procs'];
    $desired_procs = $_SESSION['desired_procs'];
    $max_procs = $_SESSION['max_procs'];

    $min_proc_units = $_SESSION['min_proc_units'];
    $desired_procs_units = $_SESSION['desired_proc_units'];
    $max_proc_units = $_SESSION['max_proc_units'];

    $min_virt_proc = $_SESSION['min_virt_proc'];
    $desired_virt_proc = $_SESSION['desired_virt_proc'];
    $max_virt_proc = $_SESSION['max_virt_proc'];

    $weight = $_SESSION['weight'];

    print "<div class=\"alert alert-info\">";
    print "<hr>";
    print "<strong>--------------------------------- General Settings -----------------------------------</strong>";
    print "<ol type=\"1\">";
    print "<li>HMC to be used for creation: <b><u>" . $hmc . "</u></b></li>";
    print "<li>LPAR to be created: <b><u>" . $lpar . "</u></b></li>";
    print "<li>Profile name: <b><u>" . $profile . "</u></b></li>";
    print "<li>Physical system where LPAR <b><u>$lpar</u></b> will be created: <b><u>" . $ms . "</u></b></li>";
    print "</ol>";

    print "<hr>";
    print "<strong>--------------------------------- Memory Settings -----------------------------------</strong>";

    print "<ol type=\"1\">";
    print "<li>Minimum memory: <b><u>" . $min_mem . "</u></b> GB</li>";
    print "<li>Desired memory: <b><u>" . $desired_mem . "</u></b> GB</li>";
    print "<li>Maximum memory: <b><u>" . $max_mem . "</u></b> GB</li>";
    print "</ol>";

    print "<hr>";
    print "<strong>--------------------------------- CPU Settings -----------------------------------</strong>";

    print "<ol type=\"1\">";
    print "<li>CPU Mode: <b><u>" . $cpu_type . "</u></b></li>";

    if($cpu_type == "shared")
    {
        print "<li>Minimum processing units: <b><u>" . $min_proc_units . "</u></b></li>";
        print "<li>Desired processing units: <b><u>" . $desired_procs_units . "</u></b></li>";
        print "<li>Maximum processing units: <b><u>" . $max_proc_units . "</u></b></li>";
    
        print "<li>Minimum virtual processors: <b><u>" . $min_virt_proc . "</u></b></li>";
        print "<li>Desired virtual processors: <b><u>" . $desired_virt_proc . "</u></b></li>";
        print "<li>Maximum virtual processors: <b><u>" . $max_virt_proc . "</u></b></li>";
    
        print "<li>Uncapped Weight: <b><u>" . $weight . "</u></b></li>";
    }
    else
    {
        print "<li>Minimum processors: <b><u>" . $min_procs . "</u></b></li>";
        print "<li>Desired processors: <b><u>" . $desired_procs . "</u></b></li>";
        print "<li>Maximum processors: <b><u>" . $max_procs . "</u></b></li>";
    }

    print "</ol>";
    print "</div>";
}
?>
<form action="step7.php" method="post" enctype="multipart/form-data">
<br />
<hr>
<div class="alert alert-info"><strong>Is this information correct ?</strong></div>
    <input class="btn btn-medium btn-primary" type="button" name="go_back" value="   Back   " onclick="goBack()">
    <input class="btn btn-medium btn-primary" type="submit" name="submit_create" value="    Yes    " title="Be careful what LPAR you have selected">
    <input class="btn btn-medium btn-primary" type="button" name="start_over" value="   No   " onclick="window.location='startover.php'">
<hr>
</form>