<?php include('header.php'); ?>
    <input class="btn btn-medium btn-primary" type="button" name="finish" value="  Start Over  " onclick="window.location='startover.php'">
    <br />
    <hr>
<?php
if(isset($_POST['hmc']) && isset($_POST['lpar']) && isset($_POST['ms']))
{
    $hmc =  strip_tags($_POST['hmc']);
    $lpar =  strip_tags($_POST['lpar']);
    $ms =  strip_tags($_POST['ms']);
    
    $cmd = "/srv/scripts/vios_reimage.sh $hmc $ms $lpar";
    
    $date = date("Y-m-d H:i:s");
    
    $sql = "INSERT INTO webvios_log VALUES ('','$date','$hmc','$lpar','$ms','$cmd')";
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
    echo '</pre>';

        print "<hr>";
        print "<div class=\"alert alert-info\">";
        print "<ol type=\"1\">";
        print "<li>Login to HMC <b><u>" . $hmc . "</u></b> via SSH</li>";
        print "<li>Connecto to: <b><u>" . $lpar . "</u></b> by using this command: <font color=\"blue\"><u><b>mkvterm -m $ms -p $lpar</b></u></font></li>";
        print "<li>Follow the on-screen instructions to finalize the installation<b><u></li>";
        print "</ol>";
        print "</div>";
        print "<hr>";
}