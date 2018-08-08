<?php include('header.php'); ?>
<?php
if(isset($_POST['submit_vios']))
{
    $lpar = strip_tags($_POST['lpar']);
    $ms = $_SESSION['ms'];
    $hmc = $_SESSION['hmc'];
}
print "<div class=\"alert alert-info\">";
print "<ol type=\"1\">";
print "<li>HMC to be used for installation: <b><u>" . $hmc . "</u></b></li>";
print "<li>VIOS to be re-imaged: <b><u>" . $lpar . "</u></b></li>";
print "<li>Physical system where VIOS <b><u>$lpar</u></b> resides: <b><u>" . $ms . "</u></b></li>";
print "</ol>";
print "</div>";
?>
<form action="step5.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="hmc" value="<?php print $hmc; ?>">
    <input type="hidden" name="lpar" value="<?php print $lpar; ?>">
    <input type="hidden" name="ms" value="<?php print $ms; ?>">
<br />
<hr>
<div class="alert alert-info"><strong>Is this information correct ?</strong></div>
  <div class="alert alert-danger">
    <strong>Warning!</strong> Make sure you have selected the correct VIOS. By pressing YES, VIOS <?php print "<b>$lpar</b>"; ?> will be rebooted automatically
  </div>
    <input class="btn btn-medium btn-primary" type="button" name="go_back" value="   Back   " onclick="goBack()">
    <input class="btn btn-medium btn-primary" type="submit" name="submit_do" value="    Yes    " title="Be careful what LPAR you have selected">
    <input class="btn btn-medium btn-primary" type="button" name="start_over" value="   No   " onclick="window.location='startover.php'">
<hr>
</form>