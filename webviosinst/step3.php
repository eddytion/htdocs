<?php include('header.php'); ?>
<div class="alert alert-info"><strong>Select VIOS</strong></div>
<hr>
<form action="step4.php" method="post" enctype="multipart/form-data">
    <select name="lpar" required>
<?php
require('config.php');
if(isset($_POST['ms']) && !empty($_POST['ms']))
{
    $ms = strip_tags($_POST['ms']);
    $_SESSION['ms'] = $ms;
    require('config.php');
    $sql = "select distinct vios_name from phys_vios where ms_name='$ms' order by vios_name asc";
    $result = mysqli_query($db,$sql);
    while($row = mysqli_fetch_array($result))
    {
        echo "<option value=\"{$row['vios_name']}\">" . $row['vios_name'] . "</option>";
    }
}
?>
</select>
<br />
<hr>
    <input class="btn btn-medium btn-primary" type="button" name="go_back" value="   Back   " onclick="goBack()">
    <input class="btn btn-medium btn-primary" type="submit" name="submit_vios" value="   Next   ">
    <input class="btn btn-medium btn-primary" type="button" name="start_over" value=" Start Over " onclick="window.location='startover.php'">
</form>