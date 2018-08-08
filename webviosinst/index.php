<?php include('header.php'); ?>
        <div class="alert warn-info">
            <strong>Please read the following information before starting the installation process</strong>
            <br>
            <br>
                <ol type="1">
                    <li>Make sure DNS entries exists</li>
                    <li>Check that zoning is done and disks are assigned</li>
                    <li>VIO server must be started in Open Firmware mode</li>
                    <li>As a good common practice, update the microcode for all adapters and update the managed system's firmware</li>
                </ol>
        </div>
<div class="alert alert-info"><strong>Select HMC</strong></div>
<hr>
<form action="step2.php" method="post" enctype="multipart/form-data">
    <select name="hmc" required>
<?php
    require('config.php');
    $sql = "SELECT DISTINCT hmc FROM phys_vios";
    print $sql;
    $result = mysqli_query($db,$sql);
    while($row = mysqli_fetch_array($result))
    {
        echo "<option value=\"{$row['hmc']}\">" . $row['hmc'] . "</option>";
    }
?>
    </select>
    <br>
    <input class="btn btn-medium btn-primary" type="submit" name="submit_hmc" value="   Next   " disabled><font color="red"><b> --> Not finalized yet, do not use</b></font>
</form>