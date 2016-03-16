<?php
/**
 * Created by PhpStorm.
 * User: Sebin PJ
 * Date: 3/16/2016
 * Time: 11:09 AM
 */
require("dbsettings.php");
$cid = $_GET['cid'];
mysqli_select_db($dbhandle, $mysqlidb);
$qry = "UPDATE `odcs`.`conversations` SET `status` = 'Closed' WHERE `conversations`.`cid` = '$cid'";
$cresult6 = mysqli_query($dbhandle, $qry) or die("<h2>C7 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
$newURL  = "http://localhost/ODCS/acfiles/consult.php";
//setcookie("id", $uid, time() + (86400 * 30), "/");
header('Location: '.$newURL);
?>