<?php
/**
 * Created by PhpStorm.
 * User: Sebin PJ
 * Date: 2/24/2016
 * Time: 11:38 PM
 */
require("dbsettings.php");
$user = $_POST["user"];
$pass = $_POST["pass"];
$loginqry = "SELECT * FROM `odcs`.`allusers` WHERE username='$user' and pass='$pass'";
mysqli_select_db($dbhandle, $mysqlidb);
$result = mysqli_query($dbhandle, $loginqry) or die("<h2> Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
$count = mysqli_num_rows($result);
if ($count == 1){
    $row = mysqli_fetch_assoc($result);
    $newURL  = "http://localhost/ODCS/";
    setcookie("id", $row["uid"], time() + (86400 * 30), "/");
    header('Location: '.$newURL);
}else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
    echo "Invalid Login Credentials.";
}

