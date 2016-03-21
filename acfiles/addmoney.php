<?php
require("config.php");
if($user != "") {
    $trans = new transaction();
    $user = $trans->currentuserdata()['username'];
    $uid = $trans->currentuserdata()['uid'];
    $atype = $trans->currentuserdata()['actp'];
    if($atype == 'Patient') {
        $trans->addmoneywallet($uid, $uid, $_POST['money']);
    }else{
        $trans->removemoneywallet($uid,$uid,$_POST['money']);
    }
    $newURL  = $webhost;
    header('Location: '.$newURL);
}
?>