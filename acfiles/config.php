<?php
/**
 * Created by PhpStorm.
 * User: Sebin PJ
 * Date: 3/18/2016
 * Time: 6:56 PM
 * This File Contains All Major Classes Functions etc of ODCS service
 * Concept of code reusability
 * [
 */
require('dbsettings.php');
$user = $_COOKIE["id"];
function error($msg,$description){
    die('<head>
    <title>ERROR Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
<div class="container">
    <div class="page-header">
        <h1 class="text-center">'.$msg.'</h1>
    </div>

    <p class="lead text-center">' .$description.'</p>');
}
function runqry($qry,$errormsg,$bool){
    global $dbhandle;
    if($bool == true){
        $result = mysqli_query($dbhandle, $qry) or die('<head>
    <title>Mysql ERROR Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
<div class="container">
    <div class="page-header">
        <h1 class="text-center">'.$errormsg.'</h1>
    </div>

    <p class="lead text-center">' . mysqli_error($dbhandle).'</p>');
        $row = mysqli_fetch_assoc($result);
        return $row;
    }else{
        $result = mysqli_query($dbhandle, $qry) or die('<head>
    <title>Mysql ERROR Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
<div class="container">
    <div class="page-header">
        <h1 class="text-center">'.$errormsg.'</h1>
    </div>

    <p class="lead text-center">' . mysqli_error($dbhandle).'</p>');
    }
}
function returncolumn($qry,$clmnm,$errormsg){
    global $dbhandle;
    $result = mysqli_query($dbhandle,$qry) or die('<head>
    <title>Mysql ERROR Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
<div class="container">
    <div class="page-header">
        <h1 class="text-center">'.$errormsg.'</h1>
    </div>

    <p class="lead text-center">' . mysqli_error($dbhandle).'</p>');;
    $storeArray = Array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $storeArray[] =  $row[$clmnm];
    }
    return $storeArray;
}


//print_r(returncolumn('SELECT * FROM allusers','email','jjjd'));

class allusers{
     function __construct()
     {
         global $user;
         $this->currentuser = $user;
     }
    public function insertuser($fname,$email,$username,$password,$atype){
        $uid = $uid = md5(uniqid($username, true));
        $qry = "INSERT INTO `odcs`.`allusers` (`fname`, `email`, `username`, `pass`, `actp`, `uid`) VALUES ('$fname', '$email', '$username', '$password', '$atype', '$uid')";
        runqry($qry,'Error Adding User '.$username,false);
    }
    public function chkuser($user,$pass){
        $qry = "SELECT * FROM `odcs`.`allusers` WHERE username='$user' and pass='$pass'";
        return runqry($qry,'Error Invalid User Data '.$user,true);
    }
    public function currentuserdata(){
        $uid = $this->currentuser;
        $qry= "SELECT * FROM `odcs`.`allusers` WHERE uid='$uid'";
        return runqry($qry,'Error Reading Current User',true);
    }
    public function getdataid($id){
        $qry= "SELECT * FROM `odcs`.`allusers` WHERE uid='$id'";
        return runqry($qry,'Error Reading User Data',true);
    }
    public function getuid($user){
        $qry= "SELECT * FROM `odcs`.`allusers` WHERE uid='$user'";
        return runqry($qry,'Error Reading User Data',true)['uid'];
    }
    public function getuidn(){
        $user = $this->currentuser;
        $qry= "SELECT * FROM `odcs`.`allusers` WHERE uid='$user'";
        return runqry($qry,'Error Reading User Data',true)['uid'];
    }
    public function getname($array){
        $names =array();
        $name =array();
        for($i=0;$i<sizeof($array);$i++){
            $name[$i] = $this->getdataid($array[$i]);
            $names[$i]= $name[$i]['fname'];
        }
        return $names;
    }
    public function getatyp($array){
        $names =array();
        $name =array();
        for($i=0;$i<sizeof($array);$i++){
            $name[$i] = $this->getdataid($array[$i]);
            $names[$i]= $name[$i]['actp'];
        }
        return $names;
    }
    public function getemail($array){
        $names =array();
        $name =array();
        for($i=0;$i<sizeof($array);$i++){
            $name[$i] = $this->getdataid($array[$i]);
            $names[$i]= $name[$i]['email'];
        }
        return $names;
    }

    public function edituser($field,$data,$uid){
        $qry = "UPDATE `allusers` SET `".$field."`='".$data."' WHERE uid='$uid'";
        runqry($qry,'Error Editing User Data',false);
    }
    public function addrate($did,$rate,$review){
        $user = $this->currentuser;
        $qry = "INSERT INTO `odcs`.`rating` (`did`, `pid`, `rate`, `msg`) VALUES ('$did', '$user', '$rate', '$review')";
        runqry($qry,'Adding Review Failed',false);
    }
    public function crating($did){
        $qry = "SELECT AVG(rate) AS rate FROM rating WHERE did='".$did."'";
        return runqry($qry,'Getting Rating Failed',true)['rate'];
    }
    public function arating($array){
        $rating =array();
        for($i=0;$i<sizeof($array);$i++){
            $rating[$i]= $this->crating($array[$i]);
            if($this->crating($array[$i]) == NULL){
                $rating[$i] = 'Not Rated Yet';
            }else{
                $rating[$i] = $this->crating($array[$i]);
            }
        }
        return $rating;
    }

}
class profile extends allusers
{
    public function insertprofiledoctor($address, $gender, $experiance, $contact, $hospital, $qualifiation, $speciality)
    {
        $uid = $this->currentuser;
       // echo $uid;
        $qry = "INSERT INTO `odcs`.`doctor` (`uid`, `address`, `gender`, `experiance`, `contact`, `hospital`, `Qualification`, `speciality`) VALUES ('$uid', '$address', '$gender', '$experiance', '$contact', '$hospital', '$qualifiation', '" . $speciality . "')";
        runqry($qry, 'Error Inserting User Profile Data', false);
    }

    public function insertprofilepatient($address, $gender, $height, $weight, $dob)
    {
        $uid = $this->currentuser;
        $qry = "INSERT INTO `odcs`.`patient` (`address`, `gender`, `height`, `weight`, `dob`, `uid`) VALUES ('$address', '$gender', '$height', '$weight', '$dob', '$uid')";
        runqry($qry, 'Error Inserting User Profile Data', false);
    }

    public function viewprofiledoctor($uid)
    {
        $qry = "SELECT * FROM `odcs`.`doctor` WHERE uid='$uid'";
        return runqry($qry, 'Error Getting Doctor Profile Data', true);
    }
    public function displaydoctors($spe){
        $qry = "SELECT * FROM doctor WHERE speciality='$spe'";
        $uid = returncolumn($qry,'uid','Getting UID failed');
        $adr = returncolumn($qry,'address','Getting Address failed');
        $gen = returncolumn($qry,'gender','Getting Gender failed');
        $hos = returncolumn($qry,'hospital','Getting Hospital failed');
        $exp = returncolumn($qry,'experiance','Getting Experiance failed');
        $con = returncolumn($qry,'contact','Getting Contact failed');
        $qua = returncolumn($qry,'Qualification','Getting Qualification failed');
        $nam = $this->getname($uid);
        $ema = $this->getemail($uid);
        $rat = $this->arating($uid);
      return array($adr,$gen,$hos,$exp,$con,$qua,$nam,$ema,$rat,$uid);
    }

    public function viewprofilepatient($uid)
    {
        $qry = "SELECT * FROM `odcs`.`patient` WHERE uid='$uid'";
        return runqry($qry, 'Error Getting Patient Profile Data', true);
    }

    public function specialitiesdoctor($uid)
    {
        $qry = "SELECT * FROM `odcs`.`doctor` WHERE uid='$uid'";
        return returncolumn($qry, 'speciality', 'Error Getting Speciality Of Doctor');
    }
    public function speciality(){
        $qry = "SELECT * FROM `odcs`.`doctor`";
        return returncolumn($qry, 'speciality', 'Error Getting Speciality Of Doctor');
    }
    public function deletedoctor(){
        $uid =$this->currentuser;
        $qry = "DELETE FROM `doctor` WHERE uid='$uid'";
        runqry($qry, 'Error Inserting User Profile Data MOD!', false);
    }
    public function deletepatient(){
        $uid =$this->currentuser;
        $qry = "DELETE FROM `patient` WHERE uid='$uid'";
        runqry($qry, 'Error Inserting User Profile Data MOD!', false);
    }
    public function specialdoctor($spe){
        $qry ="SELECT * FROM doctor WHERE speciality='$spe'";
        return returncolumn($qry, 'uid', 'Error Getting Speciality Of Doctor');
    }
}
class consult extends profile{
    public function addconsult($spe,$message,$cid,$sub){
        $user = $this->currentuser;
        $qry = "INSERT INTO `odcs`.`conversations` (`message`, `subject`, `cid`, `pid`, `did`, `status`, `adoc`) VALUES ('$message', '$sub', '$cid', '$user', 'Non', 'Asked', '0')";
        runqry($qry, 'Error Adding Consult Data ', false);
    }
    public function consultdata($cid){
        $qry = "SELECT * FROM `conversations` WHERE cid='$cid'";
        return runqry($qry, 'Error Getting Consult Data', true);
    }
    public function patientconsultdata(){
        $cid =$this->currentuser;
        $qry = "SELECT * FROM `conversations` WHERE pid='$cid'";
        $msg = returncolumn($qry, 'message', 'Error Getting Message');
        $sub = returncolumn($qry, 'subject', 'Error Getting Subject');
        $did = returncolumn($qry, 'did', 'Error Getting Doctor');
        $hid = returncolumn($qry, 'cid', 'Error Getting Doctor');
        $name=$this->getname($did);
       // print_r($name);

        $status = returncolumn($qry, 'status', 'Error Getting Status');
        return array($msg,$sub,$did,$hid,$name,$status);
    }
    public function adminconsultdata(){
        global $webhost;
        $qry = "SELECT * FROM `conversations`";
        $arr['subject'] = returncolumn($qry, 'subject', 'Error Getting Subject');
        $arr['did'] = returncolumn($qry, 'did', 'Error Getting Doctor');
        $arr['cid'] = returncolumn($qry, 'cid', 'Error Getting Doctor');
        $arr['pid'] = returncolumn($qry, 'pid', 'Error Getting Doctor');
        $arr['dname']=$this->getname($arr['did']);
        $arr['pname']=$this->getname($arr['pid']);
        $arr['links'] = array();
        for($i=0;$i<sizeof($arr['subject']);$i++){
            $arr['links'][$i] = '<a target="_blank" href = "'.$webhost.'acfiles/conversation.php?cid='.$arr['cid'][$i].'&did='.$arr['did'][$i].'">Link</a>';
        }
        $arr['status'] = returncolumn($qry, 'status', 'Error Getting Status');
        return $arr;
    }
    public function patientconsultdataid($cid){
        $qry = "SELECT * FROM `conversations` WHERE pid='$cid'";
        $msg = returncolumn($qry, 'message', 'Error Getting Message');
        $sub = returncolumn($qry, 'subject', 'Error Getting Subject');
        $did = returncolumn($qry, 'did', 'Error Getting Doctor');
        $hid = returncolumn($qry, 'cid', 'Error Getting Doctor');
        $name=$this->getname($did);
        // print_r($name);

        $status = returncolumn($qry, 'status', 'Error Getting Status');
        return array($msg,$sub,$did,$hid,$name,$status);
    }
    public function doctorconsultdata(){
        $cid =$this->currentuser;
        $qry = "SELECT * FROM `conversations` WHERE did='$cid'";
        $msg = returncolumn($qry, 'message', 'Error Getting Message');
        $sub = returncolumn($qry, 'subject', 'Error Getting Subject');
        $did = returncolumn($qry, 'pid', 'Error Getting Patient');
        $hid = returncolumn($qry, 'cid', 'Error Getting Doctor');
        $name=$this->getname($did);
        $status = returncolumn($qry, 'status', 'Error Getting Status');
        return array($msg,$sub,$did,$hid,$name,$status);
    }
    public function closeconsult($cid){
        $qry = "UPDATE `odcs`.`conversations` SET `status` = 'Closed' WHERE `conversations`.`cid` = '$cid'";
        return runqry($qry, 'Error Closing Consult Data', true);
    }


}
class transaction extends consult{
    public function balance($pid){
        $qry = "SELECT sum(balance) as balance FROM `bill` WHERE gid='$pid'";
        $bal = runqry($qry,'Cant Get Wallet Balance',true);
        return $bal['balance'];
    }
    public function addwallet($uid){
        $tid = md5(uniqid(rand(0,190909090),true));
        $qry = "INSERT INTO `odcs`.`bill` (`tid`, `gid`, `balance`, `pid`) VALUES ('$tid', '$uid', '0', 'Administrator')";
        runqry($qry,'Cant Create Wallet',false);
    }
    public function addmoneywallet($pid,$did,$amount){
        $tid = md5(uniqid(rand(0,190909090),true));
        $qry = "INSERT INTO `odcs`.`bill` (`tid`, `gid`, `balance`, `pid`) VALUES ('$tid', '$pid', '$amount', '$did')";
        runqry($qry,'Cant Add Money to Wallet',false);
    }
    public function removemoneywallet($did,$pid,$amount){
        $tid = md5(uniqid(rand(0,190909090),true));
        if(($this->balance($did)-$amount)<0){
            error('Remove Balance Failed','remove balance from '.$did.' failed');
        }else {
            $amount *= -1;
            $qry = "INSERT INTO `odcs`.`bill` (`tid`, `gid`, `balance`, `pid`) VALUES ('$tid', '$did', '$amount', '$pid')";
            runqry($qry, 'Cant Remove Money From Wallet', false);
        }
    }
    public function sendtransation($uid){
        $qry = "SELECT * FROM `bill` WHERE gid='$uid'";
        $arr['tid'] = returncolumn($qry,'tid','Error Getting TID');
        $amount = returncolumn($qry,'balance','Error Getting Balance');
        $arr['amount'] = array();
        $arr['type'] = array();
        for($i=0;$i<sizeof($amount);$i++){
            if($amount[$i]<0){
                $arr['amount'][$i] = -1*$amount[$i];
                $arr['type'][$i] = 'Withdrawn';
            }else{
                $arr['type'][$i] = 'Added';
                $arr['amount'][$i] = $amount[$i];
            }
        }
        $arr['name'] = $this->getname(returncolumn($qry,'pid','Error Getting PID'));
       return $arr;
    }
    public function sendtransationadmin(){
        $qry = "SELECT * FROM `bill`";
        $arr['tid'] = returncolumn($qry,'tid','Error Getting TID');
        $amount = returncolumn($qry,'balance','Error Getting Balance');
        $arr['amount'] = array();
        $arr['type'] = array();
        for($i=0;$i<sizeof($amount);$i++){
            if($amount[$i]<0){
                $arr['amount'][$i] = -1*$amount[$i];
                $arr['type'][$i] = 'Withdrawn';
            }else{
                $arr['type'][$i] = 'Added';
                $arr['amount'][$i] = $amount[$i];
            }
        }
        $arr['user'] = $this->getname(returncolumn($qry,'gid','Error Getting GID'));
        $arr['name'] = $this->getname(returncolumn($qry,'pid','Error Getting PID'));
        return $arr;
    }
}
class conversation extends transaction{
    public function changestatus($did,$cid){
        $qry = "UPDATE `odcs`.`conversations` SET `did` = '$did' WHERE `conversations`.`cid` = '$cid'";
        runqry($qry,'Change Status Failes',false);
        $qry = "UPDATE `odcs`.`conversations` SET `status` = 'Active' WHERE `conversations`.`cid` = '$cid'";
        runqry($qry,'Change Status Failed',false);
    }
    public function addconversation($cid,$msg){
        $mid = $this->currentuser;
        $mnq = "SELECT MAX(no) AS no FROM conversation WHERE cid='$cid'";
        $messageno = runqry($mnq,'Cant Select Msg Nr',true)['no'] + 1;
        $qry = "INSERT INTO `odcs`.`conversation` (`cid`, `mid`, `msg`, `no`) VALUES ('$cid', '$mid', '$msg', '$messageno')";
        runqry($qry,'Cant Add Conversation Message',false);
    }
    public function addfile($fid,$cid){
        $qry = "INSERT INTO `odcs`.`file` (`fid`, `cid`, `time`) VALUES ('$fid', '$cid', CURRENT_TIMESTAMP)";
        runqry($qry,'Adding File Name to DB failed',false);
    }
    public function addprescription($did,$pid,$cid,$msg){
        $mnq = "SELECT MAX(pno) AS pno FROM prescription WHERE cid='$cid'";
        $pno = runqry($mnq,'Failed To Get Prescriptin Nor')['pno'] + 1;
        $preid = md5(uniqid(rand(0,100000)));
        $qry = "INSERT INTO `odcs`.`prescription` (`prid`, `did`, `pid`, `pre`, `pno`, `time`, `cid`) VALUES ('$preid', '$did', '$pid', '$msg', '$pno', CURRENT_TIMESTAMP, '$cid')";
        runqry($qry,'Failed To Add Prescription',false);
    }
    public function getconvdata($cid){
        $qry = "SELECT * FROM conversation WHERE cid='$cid'";
        $msg = returncolumn($qry,'msg','Couldnt Get Message');
        $msn = returncolumn($qry,'no','Couldnt Get Message No');
        $mid = returncolumn($qry,'mid','Couldnt get Messenger Id');
        $nam = $this->getname($mid);
        $aty = $this->getatyp($mid);
        return array($msg,$nam,$msn,$aty);
    }
    public function getpredata($cid){
        $qry = "SELECT * FROM `odcs`.`prescription` WHERE cid='$cid'";
        $pre = returncolumn($qry,'pre','Couldnt Get Presription Message');
        $pno = returncolumn($qry,'pno','Couldnt Get Presriptin No');
        $pid = returncolumn($qry,'prid','Couldnt Get Prescription Id');
        $tim = returncolumn($qry,'time','Couldnt Get Prescriptin Time');
        $did = returncolumn($qry,'did','');
        $drn = $this->getname($did);
        return array($pre,$pno,$pid,$tim,$did,$drn);

    }
    public function getpre($pid){
        $qry = "SELECT * FROM `odcs`.`prescription` WHERE prid='$pid'";
        return runqry($qry,'Get Prid Failed',true);
    }
}
//$b = new consult();

//($b->patientconsultdata('ebda36bbf1c66c3d2905a5254d56ea79'));


//$a = new profile();
//$a->insertprofiledoctor('fname','Gokul G','3a7587dba3700d51d0d2ec8b2b1e383d','fff','fff','ffff','fff');
//$a->insertprofilepatient('address','trans','44','55',55);
//print_r($a->getdataid('3a7587dba3700d51d0d2ec8b2b1e383d'));

