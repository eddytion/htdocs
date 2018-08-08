<div class="alert alert-info"><strong>Fill in CPU details</strong></div>
<hr>
<div class="alert alert-success">
<form action="step5.php" method="post" enctype="multipart/form-data">
    <fieldset>
        <table class="table">
            <tr>
                <td><span class="label label-info">Minimum processing units</span></td>
                <td><input type="number" name="min_proc_units" required placeholder="Minimum processing units" value="0.1" min="0.1" step="0.1"></td>
            </tr>
            <tr>
                <td><span class="label label-info">Desired processing units</span></td>
                <td><input type="number" name="desired_proc_units" required placeholder="Desired processing units" value="0.1" min="0.1" step="0.1"></td>
            </tr>
            <tr>
                <td><span class="label label-info">Maximum processing units</span></td>
                <td><input type="number" name="max_proc_units" required placeholder="Maximum processing units" value="0.1" min="0.1" step="0.1"></td>
            </tr>
            <tr>
                <td><span class="label label-info">Minimum virtual processors</span></td>
                <td><input type="number" name="min_virt_proc" required placeholder="Minimum virtual processors" value="1" min="1" step="0.1"></td>
            </tr>
            <tr>
                <td><span class="label label-info">Desired virtual processors</span></td>
                <td><input type="number" name="desired_virt_proc" required placeholder="Desired virtual processors" value="1" min="1"></td>
            </tr>
            <tr>
                <td><span class="label label-info">Maximum virtual processors</span></td>
                <td><input type="number" name="max_virt_proc" required placeholder="Maximum virtual processors" value="1" min="1"></td>
            </tr>
            <tr>
                <td><span class="label label-info">Uncapped Weight</span></td>
                <td><input type="number" name="weight" required placeholder="Maximum virtual processors" value="128" step="1" min="1"></td>
            </tr>
        </table>
    </fieldset>

<br />
<hr>
    <input class="btn btn-medium btn-primary" type="button" name="go_back" value="   Back   " onclick="goBack()">
    <input class="btn btn-medium btn-primary" type="submit" name="submit_cpu" value="   Next   ">
    <input class="btn btn-medium btn-primary" type="button" name="start_over" value=" Start Over " onclick="window.location='startover.php'">
</form>
</div>