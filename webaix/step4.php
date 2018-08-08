<?php include('header.php'); ?>
<script type="text/javascript">
    function check(elem) {
        document.getElementById('xlc_version').disabled = !elem.selectedIndex;
    }

    function check2(elem) {
        document.getElementById('ldap_type').disabled = !elem.selectedIndex;
    }
</script>
<?php
if(isset($_POST['submit_lpar']))
{
    $_SESSION['lpar'] = strip_tags($_POST['lpar']);
}
?>
<div class="container" style="width: 100%">
    <div class="panel panel-primary">
        <div class="panel-heading"><strong>C++ compiler required ? / LDAP ?</strong></div>
            <div class="panel-body">
            <hr>
            <form action="step5.php" method="post" enctype="multipart/form-data">
                <table class="table table-bordered" style="width: 60%">
                <tr>
                    <th><label><strong>XLC required ?</strong></label></th>
                    <th><label><strong>Select XLC version</strong></label></th>
                    <th><label><strong>LDAP required ?</strong></label></th>
                    <th><label><strong>GLDS / DLM</strong></label></th>
                </tr>
                <tr>
                    <td>
                        <select id="xlc" name="xlc" required onchange="check(this);">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
                    </td>
                    <td>
                        <select id="xlc_version" name="xlc_version" required disabled="disabled">
                            <option value="12">12</option>
                            <option value="13">13</option>
                        </select>
                    </td>
                    <td>
                        <select id="ldap" name="ldap" required onchange="check2(this);">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>                
                    </td>
                    <td>
                        <select id="ldap_type" name="ldap_type" required disabled="disabled">
                            <option value="GLDS">GLDS</option>
                            <option value="DLM">DLM</option>
                        </select>                
                    </td>
                </tr>
    </table>
<hr>
    <input class="btn btn-medium btn-primary" type="button" name="go_back" value="   Back   " onclick="goBack()">
    <input class="btn btn-medium btn-primary" type="submit" name="submit_xlc_ldap" value="   Next   ">
    <input class="btn btn-medium btn-primary" type="button" name="start_over" value=" Start Over " onclick="window.location='startover.php'">
</form>