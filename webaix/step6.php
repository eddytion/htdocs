<?php include('header.php'); ?>
<div class="container" style="width: 100%">
    <div class="panel panel-primary">
        <div class="panel-heading"><strong>Script output</strong></div>
            <div class="panel-body">
                <hr>
<?php
if(isset($_POST['hmc']) && isset($_POST['lpar']) && isset($_POST['ms']) && isset($_POST['aix']))
{
    $hmc =  strip_tags($_POST['hmc']);
    $lpar =  strip_tags($_POST['lpar']);
    $ms =  strip_tags($_POST['ms']);
    $aix =  strip_tags($_POST['aix']);
    $xlc = strip_tags($_POST['xlc']);
    $xlc_version = strip_tags($_POST['xlc_version']);
    $ldap = strip_tags($_POST['ldap']);
    $ldap_type = strip_tags($_POST['ldap_type']);
    $cmd = "/srv/scripts/install_aix.sh $hmc $ms $lpar $aix";
    print "$cmd";
        
    $date = date("Y-m-d H:i:s");
    
    $sql = "INSERT INTO webaix_log VALUES ('','$date','$hmc','$lpar','$ms','$aix','$xlc','$xlc_version','$ldap','$ldap_type')";
    require("config.php");
    mysqli_query($db, $sql);

    while (@ ob_end_flush());
    $proc = popen($cmd, 'r');
    
    echo '<pre>';
    print "$cmd <br>";
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
        print "<input class=\"btn btn-medium btn-primary\" type=\"button\" name=\"finish\" value=\"Start Over\" onclick=\"window.location='startover.php'\">";
        print "<hr>";
}