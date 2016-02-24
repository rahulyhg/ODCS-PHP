<?php
/**
 * Created by PhpStorm.
 * User: Sebin PJ
 * Date: 2/25/2016
 * Time: 12:27 AM
 */
setcookie("id", "", time() + (86400 * 30), "/");
$newURL  = "http://localhost/ODCS/";
header('Location: '.$newURL);
?>