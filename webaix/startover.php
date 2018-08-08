<?php
include('header.php');
session_unset($_GET);
session_destroy();
header("Location: index.php");