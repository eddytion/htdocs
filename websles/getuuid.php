<?php
$lpar = ($_GET['lpar']);

$con = mysqli_connect('localhost','root','','sap');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"sap");
$sql="SELECT lun_serial FROM storage WHERE lpar_name='$lpar' ORDER BY lun_serial ASC LIMIT 0,1 ";
$result = mysqli_query($con,$sql);

if($result)
{
    if(mysql_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            echo "{$row['lun_serial']}";
        }
    }
    else
    {
        echo "00000000000000000000000000000000";
    }
}
else
{
    echo "00000000000000000000000000000000";
}
mysqli_close($con);
