<?php
require("config.php");
if($user != "") {
    $puser = new profile();
    $row = $puser->currentuserdata();
    $name = $row['fname'];
    $newURL  = "http://localhost/ODCS/";
    $usern = $row["username"];
    $atype = $row["actp"];
    if($atype == 'Patient') {
        $address = $_POST['adr'];
        $gender = $_POST['g'];
        $height = $_POST['h'];
        $weight = $_POST['w'];
        $dob = $_POST['d'];
        $puser->deletepatient();
        $puser->insertprofilepatient($address,$gender,$height,$weight,$dob);
        header('Location: '.$newURL);
    }else if($atype == 'Doctor') {
        $address = $_POST['adr'];
        $gender = $_POST['g'];
        $experience = $_POST['ex'];
        $contact = $_POST['cn'];
        $hospital = $_POST['hn'];
        $qualification = $_POST['qn'];
        $special = $_POST['sp'];
        $speciality = explode(",",$special);
        $max = sizeof($speciality);
        $puser->deletedoctor();
        for($i = 0; $i < $max;$i++)
        {
          $puser->insertprofiledoctor($address,$gender,$experience,$contact,$hospital,$qualification,$speciality[$i]);
        }
        header('Location: '.$newURL);
    }
}
?>