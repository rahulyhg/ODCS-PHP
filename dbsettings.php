<?php
//enter your mysql details here
$mysqlihost = 'localhost'; //Mysql server address
$mysqliuser = 'root'; //Mysql username
$mysqlipass = '009'; //Mysql password
$mysqlidb   = 'ieee'; //Mysql db name
$dbhandle = mysqli_connect($mysqlihost, $mysqliuser, $mysqlipass) or die(mysqli_error($dbhandle)); //connecting to mysql
?>
