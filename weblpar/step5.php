<?php include('header.php'); ?>
<div class="alert alert-info"><strong>Fill in Memory details</strong></div>
<hr>
<div class="alert alert-success">
<form action="step6.php" method="post" enctype="multipart/form-data">
    <fieldset>
        <table class="table">
            <tr>
                <td><span class="label label-info">Minimum Memory</span></td>
                <td><input type="number" name="min_mem" required placeholder="Minimum memory" value="1" step="1" min="1"> GB</td>
            </tr>
            <tr>
                <td><span class="label label-info">Desired Memory</span></td>
                <td><input type="number" name="desired_mem" required placeholder="Desired memory" value="1" step="1" min="1"> GB</td>
            </tr>
            <tr>
                <td><span class="label label-info">Maximum Memory</span></td>
                <td><input type="number" name="max_mem" required placeholder="Desired memory" value="1" step="1" min="1"> GB</td>
            </tr>
        </table>
    </fieldset>

<br />
<hr>
    <input class="btn btn-medium btn-primary" type="button" name="go_back" value="   Back   " onclick="goBack()">
    <input class="btn btn-medium btn-primary" type="submit" name="submit_mem" value="   Next   ">
    <input class="btn btn-medium btn-primary" type="button" name="start_over" value=" Start Over " onclick="window.location='startover.php'">
</form>
</div>
<?php
if(isset($_POST['submit_cpu']))
{
    if($_SESSION['cpu_type'] == "dedicated")
    {
        $_SESSION['min_procs'] = strip_tags($_POST['min_procs']);
        $_SESSION['desired_procs'] = strip_tags($_POST['desired_procs']);
        $_SESSION['max_procs'] = strip_tags($_POST['max_procs']);
    }
    else
    {
        $_SESSION['min_proc_units'] = strip_tags($_POST['min_proc_units']);
        $_SESSION['desired_proc_units'] = strip_tags($_POST['desired_proc_units']);
        $_SESSION['max_proc_units'] = strip_tags($_POST['max_proc_units']);
        $_SESSION['min_virt_proc'] = strip_tags($_POST['min_virt_proc']);
        $_SESSION['desired_virt_proc'] = strip_tags($_POST['desired_virt_proc']);
        $_SESSION['max_virt_proc'] = strip_tags($_POST['max_virt_proc']);
        $_SESSION['weight'] = strip_tags($_POST['weight']);
    }
}