<?php include('header.php'); ?>
<div class="container" style="width: 100%">
    <div class="panel panel-primary">
        <div class="panel-heading"><strong>Select LPAR</strong></div>
            <div class="panel-body">
            <hr>
            <form action="step4.php" method="post" enctype="multipart/form-data">
                    <select class="selectpicker" data-live-search="true" name="lpar" required onchange="getUUID(this.value)">
                        <optgroup label="LPAR Name">
                        <option value="">Select LPAR</option>
                        <?php
                        require('config.php');
                        if(isset($_POST['ms']) && !empty($_POST['ms']))
                        {
                            $ms = strip_tags($_POST['ms']);
                            $_SESSION['ms'] = $ms;
                            require('config.php');
                            $sql = "select distinct lpar_name from phys_sys where ms_name='$ms' and lpar_name not like '%vio%' order by lpar_name asc";
                            $result = mysqli_query($db,$sql);
                            while($row = mysqli_fetch_array($result))
                            {
                                echo "<option value=\"{$row['lpar_name']}\">" . $row['lpar_name'] . "</option>";
                            }
                        }
                        ?>
                        </optgroup>
                    </select>
            <br />
            <hr>
                <input class="btn btn-medium btn-primary" type="button" name="go_back" value="   Back   " onclick="goBack()">
                <input class="btn btn-medium btn-primary" type="submit" name="submit_lpar" value="   Next   ">
                <input class="btn btn-medium btn-primary" type="button" name="start_over" value=" Start Over " onclick="window.location='startover.php'">
            </form>
        </div>
    </div>
</div>