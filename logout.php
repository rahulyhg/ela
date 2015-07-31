<?php
session_start();
$_SESSION['flag'] = false;
$_SESSION['email'] = "";
session_destroy();
$url="index.php";
header("Refresh:0;URL=$url");
exit(0);
?>