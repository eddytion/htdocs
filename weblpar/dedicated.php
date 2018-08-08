<div class="alert alert-info"><strong>Fill in CPU details</strong></div>
<hr>
<div class="alert alert-success">
    <form action="step5.php" method="post" enctype="multipart/form-data" id="cpu">
    <fieldset>
        <table class="table">
            <tr>
                <td><span class="label label-info">Minimum processors</span></td>
                <td><input type="number" name="min_procs" required placeholder="Minimum processors" value="1" step="1" min="1"></td>
            </tr>
            <tr>
                <td><span class="label label-info">Desired processors</span></td>
                <td><input type="number" name="desired_procs" required placeholder="Desired processors" value="1" step="1" min="1"></td>
            </tr>
            <tr>
                <td><span class="label label-info">Maximum processors</span></td>
                <td><input type="number" name="max_procs" required placeholder="Maximum processors" value="1" step="1" min="1"></td>
            </tr>
        </table>
    </fieldset>

<br />
<hr>
    <input class="btn btn-medium btn-primary" type="button" name="go_back" value="   Back   " onclick="goBack()">
    <input class="btn btn-medium btn-primary" type="submit" name="submit_cpu" value="   Next  ">
    <input class="btn btn-medium btn-primary" type="button" name="start_over" value=" Start Over " onclick="window.location='startover.php'">
</form>
</div>