<?php
require("dbsettings.php");
$user = $_COOKIE["id"];
if($user != "") {
    $chkacqry = "SELECT * FROM `odcs`.`allusers` WHERE uid='$user'";
    $balqry = "SELECT * FROM `odcs`.`bill` WHERE uid='$user'";
    mysqli_select_db($dbhandle, $mysqlidb);
    $result = mysqli_query($dbhandle, $chkacqry) or die("<h2> Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $name = $row['fname'];
    $usern = $row["username"];
    $atype = $row["actp"];
    $result2 = mysqli_query($dbhandle, $balqry) or die("<h2> Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
    $row2 = mysqli_fetch_assoc($result2);
    $money = $row2['balance'];
    if($atype == "Patient"){
        $money += $_POST['money'];
    }elseif($atype == 'Doctor'){
        $money -= $_POST['money'];
    }
    //echo $money;
    $qry = "UPDATE `odcs`.`bill` SET `balance` = '$money' WHERE `bill`.`uid` = '$user'";
    $result2 = mysqli_query($dbhandle, $qry) or die("<h2> Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
    $newURL  = "http://localhost/ODCS/";

    header('Location: '.$newURL);
    if ($count == 1){
        $flag =1;
    }else{
        $flag =0;
    }
}
?>