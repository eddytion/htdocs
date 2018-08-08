<?php include('header.php'); ?>
<div class="alert alert-info"><strong>Input details</strong></div>
<hr>
<div class="alert alert-success">
<form action="" method="post" enctype="multipart/form-data" id="wwpns">
    <fieldset>
        <table class="table">
            <tr>
                <td><span class="label label-info">Input LPAR Name</span></td>
                <td><input type="text" name="lpar_name" required placeholder="Input LPAR name"></td>
            </tr>
            <tr>
                <td><span class="label label-info">Input WWPNs</span></td>
                <td><textarea class="form-control" rows="4" required placeholder="Input WWPNs" name="wwpns"></textarea>
                    <br> (no spaces, no blank lines,1 wwpn per line)
                </td>
            </tr>
        </table>
    </fieldset>

<br />
<hr>
    <input class="btn btn-medium btn-primary" type="submit" name="submit" value="   Generate   ">
</form>
</div>
<?php
if(isset($_POST['submit']) && is_string($_POST['submit']))
{
    $lpar = $_POST['lpar_name'];
    $wwpn = explode("\r\n", $_POST['wwpns']);
    $host_pattern = substr($lpar, 0,5);
    if(preg_match('/isvio/', $host_pattern))
    {
        $zone_alias = $lpar;
        $wwn_array = array();
        foreach ($wwpn as $wwid)
        {
            $parts = str_split($wwid,2);
            $wwid = implode(':', $parts);
            array_push($wwn_array, $wwid);
        }
        $wwn_list = implode("; ",$wwn_array);
        $cmd_alias = "alicreate \"$zone_alias\", \"$wwn_list\"<br>";
        
        //==============================================================
        
        $cmd_line = array();
        print "<pre>";
        print "$cmd_alias<br>";
        for ($n = 1; $n <= 8; $n++)
        {
            print "zonecreate \"{$lpar}_hopsvc_n{$n}, $zone_alias; hopsvc_n{$n}a2p1; hopsvc_n{$n}a2p2; hopsvc_n{$n}a2p3; hopsvc_n{$n}a2p4\"<br>";
        }
        print "<br>";
        print "cfgadd \"default\", \"{$lpar}_hopsvc_n1;{$lpar}_hopsvc_n2;{$lpar}_hopsvc_n3;{$lpar}_hopsvc_n4;{$lpar}_hopsvc_n5;{$lpar}_hopsvc_n6;{$lpar}_hopsvc_n7;{$lpar}_hopsvc_n8\"<br>";
        print "cfgsave<br>";
        print "cfgenable \"default\"<br>";
        print "</pre>";
    }
    else
    {
        $zone_alias = $lpar . "_npiv";
        $wwn_array = array();
        foreach ($wwpn as $wwid)
        {
            $parts = str_split($wwid,2);
            $wwid = implode(':', $parts);
            array_push($wwn_array, $wwid);
        }
        $wwn_list = implode("; ",$wwn_array);
        $cmd_alias = "alicreate \"$zone_alias\", \"$wwn_list\"<br>";
        
        //==============================================================
        
        $cmd_line = array();
        print "<pre>";
        print "$cmd_alias<br>";
        for ($n = 1; $n <= 8; $n++)
        {
            print "zonecreate \"{$lpar}_hopsvc_n{$n}, $zone_alias; hopsvc_n{$n}a2p1; hopsvc_n{$n}a2p2; hopsvc_n{$n}a2p3; hopsvc_n{$n}a2p4\"<br>";
        }
        print "<br>";
        print "cfgadd \"default\", \"{$lpar}_hopsvc_n1;{$lpar}_hopsvc_n2;{$lpar}_hopsvc_n3;{$lpar}_hopsvc_n4;{$lpar}_hopsvc_n5;{$lpar}_hopsvc_n6;{$lpar}_hopsvc_n7;{$lpar}_hopsvc_n8\"<br>";
        print "cfgsave<br>";
        print "cfgenable \"default\"<br>";
        print "</pre>";
    }
}