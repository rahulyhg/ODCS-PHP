<?php
require("dbsettings.php");
$user = $_COOKIE["id"];
if($user != "") {
    $chkacqry = "SELECT * FROM `odcs`.`allusers` WHERE uid='$user'";
    $balqry = "SELECT * FROM `odcs`.`bill` WHERE uid='$user'";
    mysqli_select_db($dbhandle, $mysqlidb);
    $result = mysqli_query($dbhandle, $chkacqry) or die("<h2>R1 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $name = $row['fname'];
    $usern = $row["username"];
    $atype = $row["actp"];
    $result2 = mysqli_query($dbhandle, $balqry) or die("<h2> R2 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
    $row2 = mysqli_fetch_assoc($result2);
    $money = $row2['balance'];

    /**
    $result = mysqli_query($dbhandle,"SELECT speciality FROM doctor");
    $storeArray = Array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $storeArray[] =  $row['speciality'];
    }
    //print_r($storeArray);

    $sp = array_unique($storeArray);
    sort($sp);
    $sp_l = sizeof($sp);
     * */
    $spe = $_POST['spl'];
    $sub = $_POST['sub'];
    $message = $_POST['msg'];
    $cid = $uid = md5(uniqid($spe, true));
    $addconverqry = "INSERT INTO `odcs`.`conversations` (`message`, `subject`, `cid`, `pid`, `did`, `status`, `adoc`) VALUES ('$message', '$sub', '$cid', '$user', 'Non', 'Asked', '0')";
    $result5 = mysqli_query($dbhandle,$addconverqry) or die('R5 fuk');
    $result3 = mysqli_query($dbhandle,"SELECT * FROM doctor WHERE speciality='$spe'") or die('R3 fuk');
    $storeArrayUid = Array();
    $storeArrayAddress = array();
    $storeArrayGender = array();
    $storeArrayH = array();
    $storeArrayEx = array();
    $storeArrayCo = array();
    $storeArrayQ = array();
    $storeArrayName = array();
    $storeArrayEmail = array();
    $avgrating = array();
    while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
        $storeArrayUid[] =  $row3['uid'];
        $storeArrayAddress[] = $row3['address'];
        $storeArrayGender[] = $row3['gender'];
        $storeArrayH[] = $row3['hospital'];
        $storeArrayEx[] = $row3['experiance'];
        $storeArrayCo[] = $row3['contact'];
        $storeArrayQ[] = $row3['Qualification'];
        $result4 = mysqli_query($dbhandle, "SELECT * FROM `odcs`.`allusers` WHERE uid='".$row3["uid"]."'") or die("<h2> R4 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
        $row4 = mysqli_fetch_assoc($result4);
        $storeArrayName[] = $row4['fname'];
        $storeArrayEmail[] = $row4['email'];
        $result5 = mysqli_query($dbhandle, "SELECT AVG(rate) AS rate FROM rating WHERE did='".$row3["uid"]."'") or die("<h2> R4 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
        $row5 = mysqli_fetch_assoc($result5);
        if($row5['rate'] == NULL){
            $rating[] = 'Not Rated Yet';
        }else{
            $rating[] = $row5['rate'];
        }


    }
    /**
    print_r($storeArrayUid);
    echo "<br>";
    print_r($storeArrayName);
    echo "<br>";
    print_r($storeArrayAddress);
    echo "<br>";
    print_r($storeArrayGender);
    echo "<br>";
    print_r($storeArrayH);
    echo "<br>";
    print_r($storeArrayEx);
    echo "<br>";
    print_r($storeArrayCo);
    echo "<br>";
    print_r($storeArrayQ);
*/

    if ($count == 1){
        $flag =1;
    }else{
        $flag =0;
    }
}
?>


<head>
    <title>Select Doctor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<div class="container">
    <div class="page-header">
        <h1 class="text-center"><?php echo $sub; ?></h1>
    </div>
    <p class="lead text-center"><?php echo $message; ?></p>
    <div class="container">
        <div class="page-header">
            <h2 class="text-center">Doctors who you can ask this</h2>
        </div>
        <div class="row stylish-panel">
        <?php
        for($i=0;$i<sizeof($storeArrayUid);$i++){
          echo '<div class="col-md-4">
                <div>
                    <img src="http://localhost/ODCS/acfiles/img/doctor.png" alt="Texto Alternativo" class="img-circle img-thumbnail">
                    <h2>'.$storeArrayName[$i].'</h2>
                    <strong><a class="btn btn-warning" href="http://localhost/ODCS/acfiles/review.php?did=\'.$storeArrayUid[$i].\'">Reviews</a></strong>
                    <br>
                    <strong>Rating: </strong>'.$rating[$i].'<br>
                    <strong>Gender: </strong>'.$storeArrayGender[$i].'<br>
                    <strong>Qualification: </strong>'.$storeArrayQ[$i].'<br>
                    <strong>Experience: </strong>'.$storeArrayEx[$i].'<br>
                    <strong>Contact: </strong>'.$storeArrayCo[$i].'<br>
                    <strong>Email: </strong>'.$storeArrayEmail[$i].'<br>
                    <br><strong>Address: </strong><br>
                    <p>'.$storeArrayAddress[$i].'
                    </p><br>
                    <br>
                    <form role="form" class="form-horizontal" method="get" action="conversation.php">
                    <input class="form-control" name="cid" id="inputSubject" value="'.$cid.'" type="hidden">
                    <input class="form-control" name="did" id="inputSubject" value="'.$storeArrayUid[$i].'" type="hidden">
                    <input type="submit" class="btn btn-primary" value="Ask »">
                    </form>
                </div>
            </div>';
            if(($i+1)%3 == 0){
            echo '</div><div class="row stylish-panel">';
            }
          }
         ?>
        </div>
    </div>
</div>
<!-- /container -->
<?php
/**
 * Created by PhpStorm.
 * User: Sebin PJ
 * Date: 3/14/2016
 * Time: 10:24 PM
 */