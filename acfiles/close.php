<?php
/**
 * Created by PhpStorm.
 * User: Sebin PJ
 * Date: 3/16/2016
 * Time: 11:09 AM
*/
require("config.php");
$user = $_COOKIE['id'];
$rating = $_POST['optradio'];
$did = $_POST['did'];
$cid = $_POST['cid'];
$msg = $_POST['msg'];
$close = new consult();
$close->addrate($did,$rating,nl2br($msg));
$close->closeconsult($cid);
$newURL  = $webhost."acfiles/consult.php";
//setcookie("id", $uid, time() + (86400 * 30), "/");
header('Location: '.$newURL);
