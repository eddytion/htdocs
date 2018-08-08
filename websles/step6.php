<?php include('header.php'); ?>
<div class="container" style="width: 100%">
    <div class="panel panel-primary">
        <div class="panel-heading"><strong>Script output</strong></div>
            <div class="panel-body">
                <hr>
                <?php
                if(isset($_POST['hmc']) && isset($_POST['lpar']) && isset($_POST['cpp']) && isset($_POST['ms']) && isset($_POST['sles']))
                {
                    $hmc =  strip_tags($_POST['hmc']);
                    $lpar =  strip_tags($_POST['lpar']);
                    $cpp =  strip_tags($_POST['cpp']);
                    $ms =  strip_tags($_POST['ms']);
                    $sles =  strip_tags($_POST['sles']);
                    $uuid = strip_tags($_POST['uuid']);
                    $validation = strip_tags($_POST['validation']);
                    $make = strip_tags($_POST['make']);
                    $install_recover = strip_tags($_POST['install_recover']);
                    
                    if($install_recover == "install")
                    {
                        if($sles == "sles12sp1" || $sles == "sles12sp2" || $sles == "sles12sp3")
                        {
                            $cmd = "/srv/scripts/install_suse_new.sh $hmc $ms $lpar $sles";
                        }
                        elseif($sles == "sles11sp4")
                        {
                            $cmd = "/srv/scripts/install_sles11sp4.sh $hmc $ms $lpar $sles $uuid";
                        }
                    }
                    elseif($install_recover == "maintenance")
                    {
                        $cmd = "/srv/scripts/suse_maintenance.py $hmc $ms $lpar $sles";
                    }
                    $date = date("Y-m-d H:i:s");

                    $sql = "INSERT INTO websles_log VALUES ('','$date','$hmc','$lpar','$cpp','$ms','$sles','$uuid','$validation','$make','$cmd')";
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

                    if($sles == "sles12sp1" || $sles == "sles12sp2" || $sles == "sles12sp3")
                    {
                        print "<hr>";
                        print "<div class=\"panel panel-success\">";
                        print "<div class=\"panel-heading\"><strong>Please follow these steps to finish your installation/maintenance:</strong></div>";
                        print "<div class=\"panel-body\">";
                        print "<ol type=\"1\">";
                        print "<li>Login to HMC <b><u>" . $hmc . "</u></b> via SSH</li>";
                        print "<li>Connecto to: <b><u>" . $lpar . "</u></b> by using this command: <font color=\"blue\"><u><b>mkvterm -m $ms -p $lpar</b></u></font></li>";
                        print "<li>Wait for grub prompt : <b><u>( grub> )</u></b></li>";
                        print "<li>Input in grub> prompt the following command: configfile <b><u>grub.cfg</u></b> file shown above</li>";
                        print "<li>Follow the on-screen instructions<b><u></li>";
                        print "</ol>";
                        print "</div></div>";
                        print "<hr>";
                        print "<input class=\"btn btn-medium btn-primary\" type=\"button\" name=\"finish\" value=\"Start Over\" onclick=\"window.location='startover.php'\">";
                    }
                    elseif($sles == "sles11sp4")
                    {
                        print "<hr>";
                        print "<div class=\"alert alert-info\">";
                        print "<h5><u>Please follow these steps to finish your installation/maintenance:</u></h5>";
                        print "<ol type=\"1\">";
                        print "<li>Login to HMC <b><u>" . $hmc . "</u></b> via SSH</li>";
                        print "<li>Connecto to: <b><u>" . $lpar . "</u></b> by using this command: <font color=\"blue\"><u><b>mkvterm -m $ms -p $lpar</b></u></font></li>";
                        print "<li>Follow the on-screen instructions<b><u></li>";
                        print "</ol>";
                        print "</div>";
                        print "<hr>";
                        print "<input class=\"btn btn-medium btn-primary\" type=\"button\" name=\"finish\" value=\"Start Over\" onclick=\"window.location='startover.php'\">";
                    }
                }
                ?>
        </div>
    </div>
</div>