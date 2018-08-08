<?php include('header.php'); ?>
<div class="alert alert-info"><strong>Select Managed System</strong></div>
<hr>
<form action="step3.php" method="post" enctype="multipart/form-data">
    <select name="ms" required>
<?php
if(isset($_POST['hmc']) && !empty($_POST['hmc']))
{
    $hmc = strip_tags($_POST['hmc']);
    $_SESSION['hmc'] = $hmc;
    
    require('config.php');
    $sql = "select distinct ms_name from phys_vios where hmc_name='$hmc' order by ms_name asc";
    $result = mysqli_query($db,$sql);
    while($row = mysqli_fetch_array($result))
    {
        echo "<option value=\"{$row['ms_name']}\">" . $row['ms_name'] . "</option>";
    }
}
?>
</select>
    <br />
    <hr>
    <input class="btn btn-medium btn-primary" type="button" name="go_back" value="   Back   " onclick="goBack()">
    <input class="btn btn-medium btn-primary" type="submit" name="submit_ms" value="   Next   ">
    <input class="btn btn-medium btn-primary" type="button" name="start_over" value=" Start Over " onclick="window.location='startover.php'">
</form>
