<?php
/**
 * Created by PhpStorm.
 * User: Sebin PJ
 * Date: 2/25/2016
 * Time: 12:27 AM
 */
require('config.php');
setcookie("id", "", time() + (86400 * 30), "/");
$newURL  = $webhost;
header('Location: '.$newURL);
?>