<?php include('header.php'); ?>
<script>
function getUUID(str) {
    if (str == "") {
        document.getElementById("uuid").value = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("uuid").value = this.responseText;
            }
        };
        xmlhttp.open("GET","getuuid.php?lpar="+str,true);
        xmlhttp.send();
    }
}
</script>
<div class="container" style="width: 100%">
    <div class="panel panel-primary">
        <div class="panel-heading"><strong>Select LPAR and verify boot disk serial number</strong></div>
            <div class="panel-body">
                <div class="alert alert-info"><strong>If you are attempting to install a system with local disks, fill in the <kbd>Boot disk UID</kbd> only with zeros</strong></div>
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
                            $sql = "select distinct lpar_name from phys_sys where ms_name='$ms' and lpar_name like 'lsh%' order by lpar_name asc";
                            $result = mysqli_query($db,$sql);
                            while($row = mysqli_fetch_array($result))
                            {
                                echo "<option value=\"{$row['lpar_name']}\">" . $row['lpar_name'] . "</option>";
                            }
                        }
                        ?>
                        </optgroup>
                    </select>
                <input id="uuid" type="text" required="required" name="uuid" placeholder="Boot disk UID" pattern=".{32,32}" size="32" maxlength="32">
            <br />
            <hr>
                <input class="btn btn-medium btn-primary" type="button" name="go_back" value="   Back   " onclick="goBack()">
                <input class="btn btn-medium btn-primary" type="submit" name="submit_lpar_uuid" value="   Next   ">
                <input class="btn btn-medium btn-primary" type="button" name="start_over" value=" Start Over " onclick="window.location='startover.php'">
            </form>
        </div>
    </div>
</div>