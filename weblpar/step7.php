<?php include('header.php'); ?>
    <input class="btn btn-medium btn-primary" type="button" name="finish" value=" Start Over " onclick="window.location='startover.php'">
    <br />
    <hr>
<?php
if(isset($_POST['submit_create']))
{
    $date = date("Y-m-d H:i:s");
    $hmc = $_SESSION['hmc'];
    $lpar = $_SESSION['lpar_name'];
    $ms = $_SESSION['ms'];
    $profile = $_SESSION['profile_name'];

    $min_mem = $_SESSION['min_mem'];
    $min_mem_mb = $min_mem * 1024;
    
    $desired_mem = $_SESSION['desired_mem'];
    $desired_mem_mb = $desired_mem  *1024;
    
    $max_mem = $_SESSION['max_mem'];
    $max_mem_mb = $max_mem * 1024;

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

    if($cpu_type == "shared")
    {
        $cmd = "/srv/scripts/create.sh $hmc $ms $lpar $min_proc_units $desired_procs_units $max_proc_units $min_virt_proc $desired_virt_proc $max_virt_proc $min_mem_mb $desired_mem_mb $max_mem_mb";
    }
    else
    {
        $cmd = "/srv/scripts/create.sh $hmc $ms $lpar $min_procs $desired_procs $max_procs $min_mem_mb $desired_mem_mb $max_mem_mb";
    }
    
    $sql = "INSERT INTO weblpar_log VALUES ('','$date','$hmc','$lpar','$ms','$profile','$min_mem_mb',"
            . "'$desired_mem_mb','$max_mem_mb','$cpu_type','$min_procs','$desired_procs','$max_procs',"
            . "'$min_proc_units','$desired_procs_units','$max_proc_units','$min_virt_proc','$desired_virt_proc',"
            . "'$max_virt_proc','$weight','$cmd')";
    require("config.php");
    mysqli_query($db, $sql);
    
    while (@ ob_end_flush());
    $proc = popen($cmd, 'r');
    
    echo '<pre>';
    while (!feof($proc))
    {
        echo fread($proc, 4096);
        @ flush();
    }
    pclose($proc);

    print "<span class=\"label label-info\">$cmd</span>";
}