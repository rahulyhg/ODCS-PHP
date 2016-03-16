<?php
/**
 * Created by PhpStorm.
 * User: Sebin PJ
 * Date: 3/16/2016
 * Time: 11:09 AM

require("dbsettings.php");
$cid = $_GET['cid'];
mysqli_select_db($dbhandle, $mysqlidb);
$qry = "UPDATE `odcs`.`conversations` SET `status` = 'Closed' WHERE `conversations`.`cid` = '$cid'";
$cresult6 = mysqli_query($dbhandle, $qry) or die("<h2>C7 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
$newURL  = "http://localhost/ODCS/acfiles/consult.php";
//setcookie("id", $uid, time() + (86400 * 30), "/");
header('Location: '.$newURL);
?>
 * */
print_r($_POST);
$user = $_COOKIE['id'];
$rating = $_POST['optradio'];
$did = $_POST['did'];
$cid = $_POST['cid'];
$msg = $_POST['msg'];
$runquery = "INSERT INTO `odcs`.`rating` (`did`, `pid`, `rate`, `msg`) VALUES ('$did', '$user', '$rating', '$msg')";
require("dbsettings.php");
mysqli_select_db($dbhandle, $mysqlidb);
$result2 = mysqli_query($dbhandle, $runquery) or die("<h2>C2 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
$qry = "UPDATE `odcs`.`conversations` SET `status` = 'Closed' WHERE `conversations`.`cid` = '$cid'";
$cresult6 = mysqli_query($dbhandle, $qry) or die("<h2>C7 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
$newURL  = "http://localhost/ODCS/acfiles/consult.php";
//setcookie("id", $uid, time() + (86400 * 30), "/");
header('Location: '.$newURL);
