<?php include('header.php'); ?>
<div class="container" style="width: 100%">
    <div class="panel panel-primary">
        <div class="panel-heading"><strong>System summary</strong></div>
            <div class="panel-body">
            <hr>
                <?php

                $hmc = $_SESSION['hmc'];
                $lpar = $_SESSION['lpar'];
                $xlc = $_POST['xlc'];
                $xlc_version = $_POST['xlc_version'];
                $ldap = $_POST['ldap'];
                $ldap_type = $_POST['ldap_type'];
                $ms = $_SESSION['ms'];
                $aix = $_SESSION['aix'];

                print "<div class=\"alert alert-info\">";
                print "<ol type=\"1\">";
                print "<li>AIX version to be installed: <b><u>" . $aix . "</u></b></li>";
                print "<li>HMC to be used for installation: <b><u>" . $hmc . "</u></b></li>";
                print "<li>LPAR to be installed: <b><u>" . $lpar . "</u></b></li>";
                print "<li>C++ Compiler to be installed: <b><u>" . $xlc . "</u></b></li>";
                print "<li>C++ Compiler version: <b><u>" . $xlc_version . "</u></b></li>";
                print "<li>LDAP config: <b><u>" . $ldap . "</u></b></li>";
                print "<li>LDAP config type: <b><u>" . $ldap_type . "</u></b></li>";
                print "<li>Physical system where LPAR <b><u>$lpar</u></b> resides: <b><u>" . $ms . "</u></b></li>";
                print "</ol>";
                print "</div>";
                ?>
                <form action="step6.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="hmc" value="<?php print $hmc; ?>">
                    <input type="hidden" name="lpar" value="<?php print $lpar; ?>">
                    <input type="hidden" name="xlc" value="<?php print $xlc; ?>">
                    <input type="hidden" name="xlc_version" value="<?php print $xlc_version; ?>">
                    <input type="hidden" name="ms" value="<?php print $ms; ?>">
                    <input type="hidden" name="aix" value="<?php print $aix; ?>">
                    <input type="hidden" name="ldap" value="<?php print $ldap; ?>">
                    <input type="hidden" name="ldap_type" value="<?php print $ldap_type; ?>">
                <br />
                <hr>
                <div class="alert alert-info"><strong>Is this information correct ?</strong></div>
                  <div class="alert alert-danger">
                    <strong>Warning!</strong> Make sure you have selected the correct lpar. By pressing YES, lpar <?php print "<b>$lpar</b>"; ?> will be rebooted automatically
                  </div>
                    <input class="btn btn-medium btn-primary" type="button" name="go_back" value="   Back   " onclick="goBack()">
                    <input class="btn btn-medium btn-primary" type="submit" name="submit_create" value="    Yes    " title="Be careful what LPAR you have selected">
                    <input class="btn btn-medium btn-primary" type="button" name="start_over" value="   No   " onclick="window.location='startover.php'">
                <hr>
                </form>
            </div>
    </div>
</div>