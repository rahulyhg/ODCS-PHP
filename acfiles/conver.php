<?php
require("dbsettings.php");
mysqli_select_db($dbhandle, $mysqlidb);

$cid = $_POST['cid'];
$message = $_POST['con'];
$user = $_COOKIE["id"];
$mn = 1;
echo $cid.'---'.$user.'---'.$message;
$addc = "INSERT INTO `odcs`.`conversation` (`cid`, `mid`, `msg`, `no`) VALUES ('$cid', '$user', '$message', '$mn')";
mysqli_query($dbhandle, $addc) or die("<h2>CR1 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
