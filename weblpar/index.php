<?php include('header.php'); ?>
<div class="alert alert-info"><strong>Select HMC</strong></div>
<hr>
<form action="step2.php" method="post" enctype="multipart/form-data">
    <select name="hmc" required>
<?php
    require('config.php');
    $sql = "select name from hmc order by name asc";
    print $sql;
    $result = mysqli_query($db,$sql);
    while($row = mysqli_fetch_array($result))
    {
        echo "<option value=\"{$row['name']}\">" . $row['name'] . "</option>";
    }
?>
</select>
    <br />
    <hr>
    <input class="btn btn-medium btn-primary" type="submit" name="submit_hmc" value="   Next   ">
</form>