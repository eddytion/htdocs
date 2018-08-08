<?php include('header.php'); ?>
<div class="container" style="width: 100%">
    <div class="panel panel-primary">
        <div class="panel-heading"><strong>System summary</strong></div>
            <div class="panel-body">
            <hr>
            <?php

            $hmc = $_SESSION['hmc'];
            $lpar = $_SESSION['lpar'];
            $cplusplus = $_POST['cpp'];
            $ms = $_SESSION['ms'];
            $sles = $_SESSION['sles'];
            $uuid = $_SESSION['uuid'];
            $validation = $_POST['validation'];
            $make = $_POST['make'];
            $install_recover = $_SESSION['install_recover'];

            print "<ol type=\"1\">";
                if($install_recover == "install")
                {
                    print "<li>Image to be used for installation: <b><u><kbd>" . $sles . "</kbd></u></b></li>";
                    print "<li>HMC to be used for installation: <b><u><kbd>" . $hmc . "</kbd></u></b></li>";
                    print "<li>LPAR to be installed: <b><u><kbd>" . $lpar . "</kbd></u></b></li>";
                    print "<li>Serial number of the boot disk: <b><u><kbd>" . strtolower($uuid) . "</kbd></u></b></li>";
                    print "<li>C++ Compiler to be installed: <b><u><kbd>" . $cplusplus . "</kbd></u></b></li>";
                    print "<li>Validation LPAR to be installed: <b><u><kbd>" . $validation . "</kbd></u></b></li>";
                    print "<li>Make LPAR to be installed: <b><u><kbd>" . $make . "</kbd></u></b></li>";
                }
                elseif($install_recover == "maintenance")
                {
                    print "<li>Image to be used for maintenance: <b><u><kbd>" . $sles . "</kbd></u></b></li>";
                    print "<li>HMC to be used for maintenance boot: <b><u><kbd>" . $hmc . "</kbd></u></b></li>";
                    print "<li>LPAR to be booted in maintenance mode: <b><u><kbd>" . $lpar . "</kbd></u></b></li>";
                    print "<li>Serial number of the boot disk: <b><u><kbd>" . strtolower($uuid) . "</kbd></u></b></li>";
                }
                print "<li>Physical system where LPAR <b><u><kbd>$lpar</kbd></u></b> resides: <b><u><kbd>" . $ms . "</kbd></u></b></li>";
            print "</ol>";

            ?>
            <form action="step6.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="hmc" value="<?php print $hmc; ?>">
                <input type="hidden" name="lpar" value="<?php print $lpar; ?>">
                <input type="hidden" name="cpp" value="<?php print $cplusplus; ?>">
                <input type="hidden" name="ms" value="<?php print $ms; ?>">
                <input type="hidden" name="sles" value="<?php print $sles; ?>">
                <input type="hidden" name="uuid" value="<?php print strtolower($uuid); ?>">
                <input type="hidden" name="validation" value="<?php print $validation; ?>">
                <input type="hidden" name="make" value="<?php print $make; ?>">
                <input type="hidden" name="install_recover" value="<?php print $install_recover; ?>">
            <br />
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Is this information correct ?</strong></div>
                    <div class="panel-body">
                    <div class="alert alert-danger"><strong>Warning!</strong> Make sure you have selected the correct lpar. By pressing YES, lpar <?php print "<b>$lpar</b>"; ?> will be rebooted automatically</div>
                    <input class="btn btn-medium btn-primary" type="button" name="go_back" value="Back" onclick="goBack()">
                    <input class="btn btn-danger" type="submit" name="submit_create" value="Yes" title="Be careful which LPAR you have selected">
                    <input class="btn btn-medium btn-primary" type="button" name="start_over" value="No" onclick="window.location='startover.php'">
                    <hr>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>