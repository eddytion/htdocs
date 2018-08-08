<?php
if(isset($_GET['ipaddr']))
{
    if(is_string($_GET['ipaddr']))
    {
        $ipaddr = gethostbyaddr($_GET['ipaddr']);
        print "$ipaddr";
    }
}
 else
{
     print "NULL";
}