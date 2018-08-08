<?php include('header.php'); ?>
<div class="container" style="width: 100%">
    <div class="panel panel-primary">
        <div class="panel-heading"><strong>Select Managed System</strong></div>
            <div class="panel-body">
                <hr>
                <form action="step3.php" method="post" enctype="multipart/form-data">
                    <select class="selectpicker" data-live-search="true" name="ms" required>
                        <optgroup label="Managed System">
                            <?php
                            if(isset($_POST['hmc']) && !empty($_POST['hmc']) && isset($_POST['install_recover']))
                            {
                                $hmc = strip_tags($_POST['hmc']);
                                $_SESSION['hmc'] = $hmc;

                                $sles = strip_tags($_POST['sles']);
                                $_SESSION['sles'] = $sles;
                                
                                $install_recover = strip_tags($_POST['install_recover']);
                                $_SESSION['install_recover'] = $install_recover;

                                require('config.php');
                                $sql = "select distinct ms_name from phys_sys where hmc_name='$hmc' order by ms_name asc";
                                $result = mysqli_query($db,$sql);
                                while($row = mysqli_fetch_array($result))
                                {
                                    echo "<option value=\"{$row['ms_name']}\">" . $row['ms_name'] . "</option>";
                                }
                            }
                            ?>
                        </optgroup>
                    </select>
                    <br />
                    <hr>
                    <input class="btn btn-medium btn-primary" type="button" name="go_back" value="   Back   " onclick="goBack()">
                    <input class="btn btn-medium btn-primary" type="submit" name="submit_ms" value="   Next   ">
                    <input class="btn btn-medium btn-primary" type="button" name="start_over" value=" Start Over " onclick="window.location='startover.php'">
                </form>
        </div>
    </div>
</div>