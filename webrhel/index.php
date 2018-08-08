<?php include('header.php'); ?>
<div class="container" style="width: 100%">
     <div class="panel panel-primary">
        <div class="panel-heading"><strong>Select HMC and RHEL version</strong></div>
            <div class="panel-body">
                <form action="step2.php" method="post" enctype="multipart/form-data">
                <select class="selectpicker" data-live-search="true" name="hmc" required>
                    <optgroup label="HMC">
                <?php
                    require('config.php');
                    $sql = "SELECT DISTINCT hmc_name FROM phys_sys WHERE lpar_name like 'lsh%' ORDER BY hmc_name";
                    print $sql;
                    $result = mysqli_query($db,$sql);
                    while($row = mysqli_fetch_array($result))
                    {
                        echo "<option value=\"{$row['hmc_name']}\">" . $row['hmc_name'] . "</option>";
                    }
                ?>
                    </optgroup>
                </select>
                    <select class="selectpicker" data-live-search="true" name="rhel" required>
                        <optgroup label="RHEL Version">
                            <option value="rhel72">RHEL 7.2</option>
                            <option value="rhel73">RHEL 7.3</option>
                            <option value="rhel74">RHEL 7.4</option>
                        </optgroup>
                    </select>
                    <select class="selectpicker" data-live-search="true" name="install_recover" required>
                        <optgroup label="Install or Maintenance">
                            <option value="install">Install</option>
                            <option value="maintenance" disabled>Maintenance</option>
                        </optgroup>
                    </select>
                    <br />
                    <br />
                    <a href="update_db.php" onclick="return popitup('update_db.php')">Update LPAR Database</a>
                    <br>
                    <a href="multiple.php" target="_blank">Mass install ?</a>
                    <hr>
                    <input class="btn btn-primary btn-md" type="submit" name="submit_hmc" value="   Next   ">
                </form>
        </div>
     </div>
</div>