<?php
require("dbsettings.php");
$user = $_COOKIE["id"];
if($user != "") {
    $chkacqry = "SELECT * FROM `odcs`.`allusers` WHERE uid='$user'";
    mysqli_select_db($dbhandle, $mysqlidb);
    $result = mysqli_query($dbhandle, $chkacqry) or die("<h2> Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $name = $row['fname'];
    $newURL  = "http://localhost/ODCS/";
    $usern = $row["username"];
    $atype = $row["actp"];
    if ($count == 1){
        $flag =1;
    }else{
        $flag =0;
    }
    if($atype == 'Patient') {
        echo "<br> Patient <br>";
        $address = $_POST['adr'];
        $gender = $_POST['g'];
        $uid = $user;
        $height = $_POST['h'];
        $weight = $_POST['w'];
        $dob = $_POST['d'];
        $insertq = "INSERT INTO `odcs`.`patient` (`address`, `gender`, `height`, `weight`, `dob`, `uid`) VALUES ('$address', '$gender', '$height', '$weight', '$dob', '$uid')";
        $result = mysqli_query($dbhandle, $insertq) or die("<h2> Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
        setcookie("id", $uid, time() + (86400 * 30), "/");
        header('Location: '.$newURL);
    }else if($atype == 'Doctor') {
        //echo "<br> Doctor <br>";
        $address = $_POST['adr'];
        $gender = $_POST['g'];
        $experience = $_POST['ex'];
        $contact = $_POST['cn'];
        $hospital = $_POST['hn'];
        $qualification = $_POST['qn'];
        $special = $_POST['sp'];
        $uid = $user;
        $speciality = explode(",",$special);
        $max = sizeof($speciality);
        for($i = 0; $i < $max;$i++)
        {
          $insertq = "INSERT INTO `odcs`.`doctor` (`uid`, `address`, `gender`, `experiance`, `contact`, `hospital`, `Qualification`, `speciality`) VALUES ('$uid', '$address', '$gender', '$experience', '$contact', '$hospital', '$qualification', '".$speciality[$i]."')";
            $result = mysqli_query($dbhandle, $insertq) or die("<h2> Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
           echo $speciality[$i];
        }

        setcookie("id", $uid, time() + (86400 * 30), "/");
        header('Location: '.$newURL);
    }
}
?>