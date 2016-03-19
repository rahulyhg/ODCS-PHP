<?php
require("config.php");
$username = $_POST["username"];
$passwrd = $_POST["passwrd"];
$fname = $_POST["fname"];
$email = $_POST["email"];
$actype = $_POST["a_type"];
$ruser = new transaction();
$ruser->insertuser($fname,$email,$username,$passwrd,$actype);
$uid = $ruser->getuid($username);
$ruser->addwallet($uid);
$newURL  = "http://localhost/ODCS/profile.php";
setcookie("id", $uid, time() + (86400 * 30), "/");
header('Location: '.$newURL);
?>
