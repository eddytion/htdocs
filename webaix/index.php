<?php include('header.php'); ?>
<div class="container" style="width: 100%">
     <div class="panel panel-primary">
        <div class="panel-heading"><strong>Select HMC and AIX version</strong></div>
            <div class="panel-body">
                <form action="step2.php" method="post" enctype="multipart/form-data">
                <select class="selectpicker" data-live-search="true" name="hmc" required>
                    <optgroup label="HMC">
                    <?php
                    require('config.php');
                    $sql = "select * from hmc order by hmc asc";
                    print $sql;
                    $result = mysqli_query($db,$sql);
                    while($row = mysqli_fetch_array($result))
                    {
                        echo "<option value=\"{$row['hmc']}\">" . $row['hmc'] . "</option>";
                    }
                    ?>
                    </optgroup>
                </select>
                    <select class="selectpicker" data-live-search="true" name="aix" required>
                        <optgroup label="aix">
                            <option value="7200-00">AIX 7.2 TL 0 Base</option>
                            <option value="7100-05">AIX 7.1 TL 5 Base</option>
                            <option value="7100-04">AIX 7.1 TL 4 Base</option>
                            <option value="7100-03">AIX 7.1 TL 3 Base</option>
                            <option value="7100-02">AIX 7.1 TL 2 Base</option>
                            <option value="7100-01">AIX 7.1 TL 1 Base</option>
                            <option value="7100-00">AIX 7.1 TL 0 Base</option>
                            <option value="6100-09">AIX 6.1 TL 9 Base</option>
                            <option value="6100-08">AIX 6.1 TL 8 Base</option>
                            <option value="6100-07">AIX 6.1 TL 7 Base</option>
                            <option value="6100-06">AIX 6.1 TL 6 Base</option>
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