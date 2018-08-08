<?php include('header.php'); ?>
<?php
if(isset($_POST['submit_lpar_uuid']))
{
    if(strlen(strip_tags($_POST['uuid'])) <= 33 && strlen(strip_tags($_POST['uuid'])) >= 32 && ctype_xdigit($_POST['uuid']))
    {
        $_SESSION['lpar'] = strip_tags($_POST['lpar']);
        $_SESSION['uuid'] = strip_tags(trim($_POST['uuid']));
    }
    else
    {
        die("<div class=\"alert alert-danger\"><strong>Disk serial number --> <font color=\"blue\">" . strip_tags($_POST['uuid']) . "</font> is invalid</strong></div>"
        . "<br><input class=\"btn btn-medium btn-primary\" type=\"button\" name=\"go_back\" value=\"   Back   \" onclick=\"goBack()\">");
    }
}
?>
<div class="container" style="width: 100%">
    <div class="panel panel-primary">
        <div class="panel-heading"><strong>C++ compiler required ? / Validation Server ?</strong></div>
            <div class="panel-body">
            <hr>
            <form action="step5.php" method="post" enctype="multipart/form-data">
                <table class="table table-bordered" style="width: 60%">
                    <thead>
                        <th><label><strong>C++ required ?</strong></label></th>
                        <th><label><strong>Validation server ?</strong></label></th>
                        <th><label><strong>Make server ?</strong></label></th>
                    </thead>
                    <tbody>
                    <tr>
                    <td>
            <select name="cpp" required>
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select>
                        </td>
                        <td>
            <select name="validation" required>
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select>
                        </td>
                        <td>
            <select name="make" required>
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select>
                        </td>
                </tr>
                    </tbody>
                </table>
            <hr>
                <input class="btn btn-medium btn-primary" type="button" name="go_back" value="Back" onclick="goBack()">
                <input class="btn btn-medium btn-primary" type="submit" name="submit_cpp" value="Next">
                <input class="btn btn-medium btn-primary" type="button" name="start_over" value="Start Over" onclick="window.location='startover.php'">
            </form>
        </div>
    </div>
</div>