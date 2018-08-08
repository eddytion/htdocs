<?php include('header.php'); ?>
<div class="container" style="width: 100%">
    <div class="panel panel-primary">
        <div class="panel-heading"><strong>Script output</strong></div>
            <div class="panel-body">
                <hr>
                    <?php
                    if(isset($_POST['hmc']) && isset($_POST['lpar']) && isset($_POST['ms']) && isset($_POST['rhel']))
                    {
                        $hmc =  strip_tags($_POST['hmc']);
                        $lpar =  strip_tags($_POST['lpar']);
                        $ms =  strip_tags($_POST['ms']);
                        $rhel =  strip_tags($_POST['rhel']);
                        $uuid = strip_tags($_POST['uuid']);
                        $install_recover = strip_tags($_POST['install_recover']);
                        
                        if($install_recover == "install")
                        {
                            if($rhel == "rhel72")
                            {
                                $cmd = "/srv/scripts/install_rhel.sh $hmc $ms $lpar";
                            }
                            elseif($rhel == "rhel73")
                            {
                                $cmd = "/srv/scripts/install_redhat73.sh $hmc $ms $lpar";
                            }
                            elseif($rhel == "rhel74")
                            {
                                $cmd = "/srv/scripts/install_redhat74.sh $hmc $ms $lpar";
                            }
                        }
                        elseif($install_recover == "maintenance")
                        {
                            $cmd = "/srv/scripts/redhat_maintenance.py $hmc $ms $lpar $rhel";
                        }

                        $date = date("Y-m-d H:i:s");

                        $sql = "INSERT INTO webrhel_log VALUES ('','$date','$hmc','$lpar','$ms','$rhel','$uuid','$cmd')";
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
                        print "<h5><u>Now please follow these steps to finish your installation / maintenance:</u></h5>";
                        print "<ol type=\"1\">";
                        print "<li>Login to HMC <b><u>" . $hmc . "</u></b> via SSH</li>";
                        print "<li>Connecto to: <b><u>" . $lpar . "</u></b> by using this command: <font color=\"blue\"><u><b>mkvterm -m $ms -p $lpar</b></u></font></li>";
                        print "<li>Wait for grub prompt : <b><u>( grub> )</u></b></li>";
                        print "<li>Follow the on-screen instructions to finalize the installation / maintenance<b><u></li>";
                        print "</ol>";
                        print "</div>";
                        print "<input class=\"btn btn-medium btn-primary\" type=\"button\" name=\"finish\" value=\"Start Over\" onclick=\"window.location='startover.php'\">";
                        print "<hr>";
                    }
                    ?>
            </div>
    </div>
</div>