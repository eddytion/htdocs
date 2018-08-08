<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'nXEzT0Ae0k9RJTM');
   define('DB_DATABASE', 'sap');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   if(mysqli_connect_errno())
   {
       print "<script>alert(\" Some error occured --> " . mysqli_connect_error() . "\")</script>";
   }
?>