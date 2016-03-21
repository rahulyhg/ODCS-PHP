<?php
require("config.php");

$did = $_GET['did'];
if($user != "") {

    $cuser = new transaction();
    $usern = $cuser->currentuserdata()['fname'];
    $atype = $cuser->currentuserdata()['actp'];
    $user = $cuser->currentuserdata()['username'];
    $uid = $cuser->currentuserdata()['uid'];
    $money = $cuser->balance($uid);
    if ($usern == NULL){
        $flag =0;
    }else{
        $flag =1;
    }
   $row3 = $cuser->viewprofiledoctor($did);
        $storeArrayUid =  $row3['uid'];
        $storeArrayAddress = $row3['address'];
        $storeArrayGender = $row3['gender'];
        $storeArrayH = $row3['hospital'];
        $storeArrayEx = $row3['experiance'];
        $storeArrayCo = $row3['contact'];
        $storeArrayQ = $row3['Qualification'];
        $storeArrayS = $cuser->specialitiesdoctor($did);
        $speciality = implode(',',$storeArrayS);
        $storeArrayName = $cuser->getdataid($did)['fname'];
        $storeArrayEmail = $cuser->getdataid($did)['email'];
        $rating = $cuser->crating($did);


}
?>
<head>
    <title>Review Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<div class="container">
    <div class="page-header">
        <h1 class="text-center"><?php echo $storeArrayName; ?></h1>
    </div>

    <img src="<?php echo $webhost; ?>acfiles/img/patient.png" alt="" class="center-block img-circle img-thumbnail img-responsive">

    <p class="lead text-center"><?php echo 'Details : '; ?>.</p>
    <?php

    echo'
<div class="text-center">
    <strong>Rating: </strong>'.$rating.'<br>
    <strong>Gender: </strong>'.$storeArrayGender.'<br>
    <strong>Qualification: </strong>'.$storeArrayQ.'<br>
    <strong>Experience: </strong>'.$storeArrayEx.'<br>
    <strong>Contact: </strong>'.$storeArrayCo.'<br>
    <strong>Email: </strong>'.$storeArrayEmail.'<br>
    <br><strong>Speciality: </strong><br>
    <p>'.$speciality.'
    </p>
    <br><strong>Address: </strong><br>
    <p>'.$storeArrayAddress.'
    </p></div>
    <div class="container" style="margin-top: 60px">
    <div class="panel panel-primary">
        <div class="panel-heading">Reviews</div>
        <div class="panel-body">
            <table class="table table-striped table-hover">
    ';

$seletqry = "SELECT * FROM `rating` WHERE did='$did'";
$result65 = mysqli_query($dbhandle, $seletqry) or die("<h2> Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
$subject = array();
$dname = array();
$pid = array();
$cid = array();
$status = array();
//$link = array();
while ($row = mysqli_fetch_array($result65, MYSQLI_ASSOC)) {
    $subject[] = $row['msg'];
    $status[] = $row['rate'];
    $pid[] = $row['pid'];
    $cid[] = $row['cid'];
    $result40 = mysqli_query($dbhandle, "SELECT * FROM `odcs`.`allusers` WHERE uid='".$row["pid"]."'") or die("<h2> CoR4 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
    $row40 = mysqli_fetch_assoc($result40);
    $dname[] = $row40['fname'];

}
echo '<thead>
                <tr>
                    <th colspan="2">Review</th>
                    <th>Patient Name</th>
                    <th>Rating</th>

                </tr>
                </thead><tbody>';
for($i=0;$i<sizeof($subject);$i++){

    echo '   <tr>
                    <td><img src="img/question.png" class="img-thumbnail" alt="Item description" title="Some shop item">
                    </td>
                    <td>'.$subject[$i].'</td>
                    <td>'.$dname[$i].'</td>
                    <td>'.$status[$i].'</td>
                </tr>';
}
echo'
                </tbody>
            </table><a class="small pull-left" href="'.$webhost.'">Back</a>
           ';


?>