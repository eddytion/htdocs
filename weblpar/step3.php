<?php include('header.php'); ?>
<div class="alert alert-info"><strong>Fill in LPAR details</strong></div>
<hr>
<div class="alert alert-success">
<form action="step4.php" method="post" enctype="multipart/form-data">
    <fieldset>
        <table class="table">
            <tr>
                <td><span class="label label-info">Input LPAR Name</span></td>
                <td><input type="text" name="lpar_name" required placeholder="Input LPAR name"></td>
            </tr>
            <tr>
                <td><span class="label label-info">Input profile Name</span></td>
                <td><input type="text" name="profile_name" required placeholder="Profile name" value="default"></td>
            </tr>
            <tr>
                <td><span class="label label-info">CPU Mode</span></td>
                <td>
                    <select name="cpu_type" required>
                        <option value="dedicated">Dedicated</option>
                        <option value="shared">Shared</option>
                    </select>
                </td>
            </tr>
        </table>
    </fieldset>

<br />
<hr>
    <input class="btn btn-medium btn-primary" type="button" name="go_back" value="   Back   " onclick="goBack()">
    <input class="btn btn-medium btn-primary" type="submit" name="submit_lpar" value="   Next   ">
    <input class="btn btn-medium btn-primary" type="button" name="start_over" value=" Start Over " onclick="window.location='startover.php'">
</form>
</div>
<?php
if(isset($_POST['submit_ms']) && is_string($_POST['submit_ms']))
{
    $ms = strip_tags($_POST['ms']);
    $_SESSION['ms'] = $ms;
}