<?php
require("dbsettings.php");
$username = $_POST["username"];
$uid = md5(uniqid($username, true));
$passwrd = $_POST["passwrd"];
$fname = $_POST["fname"];
$email = $_POST["email"];
$actype = $_POST["a_type"];

$regqry = "INSERT INTO `odcs`.`allusers` (`fname`, `email`, `username`, `pass`, `actp`, `uid`) VALUES ('".$fname."', '".$email."', '".$username."', '".$passwrd."', '".$actype."', '".$uid."')";
$pay = "INSERT INTO `odcs`.`bill` (`uid`, `balance`) VALUES ('$uid', '0')";
mysqli_select_db($dbhandle, $mysqlidb);
mysqli_query($dbhandle, $regqry) or die("<h2> Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
mysqli_query($dbhandle, $pay) or die("<h2> Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));

$newURL  = "http://localhost/ODCS/";
setcookie("id", $uid, time() + (86400 * 30), "/");
header('Location: '.$newURL);
?>
