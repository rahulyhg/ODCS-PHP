<?php
require("dbsettings.php");
mysqli_select_db($dbhandle, $mysqlidb);

$cid = $_POST['cid'];
$did = $_POST['did'];
$message = $_POST['con'];
$user = $_COOKIE["id"];
$mnq = "SELECT MAX(no) AS no FROM conversation WHERE cid='$cid'";
$result2  = mysqli_query($dbhandle, $mnq) or die("<h2>CR0 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
$row2 = mysqli_fetch_assoc($result2);
$n = $row2['no'];
$mn = $n+1;
echo $cid.'---'.$user.'---'.$message;
$addc = "INSERT INTO `odcs`.`conversation` (`cid`, `mid`, `msg`, `no`) VALUES ('$cid', '$user', '$message', '$mn')";
mysqli_query($dbhandle, $addc) or die("<h2>CR1 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
$newURL  = "http://localhost/ODCS/acfiles/conversation.php?cid=".$cid."&did=".$did;
//setcookie("id", $uid, time() + (86400 * 30), "/");
header('Location: '.$newURL);
?>