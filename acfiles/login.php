<?php
/**
 * Created by PhpStorm.
 * User: Sebin PJ
 * Date: 2/24/2016
 * Time: 11:38 PM
 */
require("config.php");
$user = $_POST["user"];
$pass = $_POST["pass"];
$luser = new allusers();
$count = $luser->chkuser($user,$pass);
if ($count != NULL){
    $uid = $count['uid'];
    $newURL  = "http://localhost/ODCS/";
    setcookie("id", $uid, time() + (86400 * 30), "/");
    header('Location: '.$newURL);
}else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
    echo '<head>
    <title>Invalid Credentials</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<div class="container">
    <div class="page-header">
        <h1 class="text-center">Invalid Credentials</h1>
    </div>';
}

