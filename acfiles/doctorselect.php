<?php
require("config.php");
if($user != "") {
    $conslt = new consult();
    $row = $conslt->currentuserdata();
    $spe = $_POST['spl'];
    $cid = $uid = md5(uniqid($spe, true));
    $sub = $_POST['sub'];
    $message = $_POST['msg'];
    $conslt->addconsult($spe,$message,$cid,$sub);
    $storeArrayUid = $conslt->displaydoctors($spe)[9];
    $storeArrayAddress = $conslt->displaydoctors($spe)[0];
    $storeArrayGender = $conslt->displaydoctors($spe)[1];
    $storeArrayH = $conslt->displaydoctors($spe)[2];
    $storeArrayEx = $conslt->displaydoctors($spe)[3];
    $storeArrayCo = $conslt->displaydoctors($spe)[4];
    $storeArrayQ = $conslt->displaydoctors($spe)[5];
    $storeArrayName = $conslt->displaydoctors($spe)[6];
    $storeArrayEmail = $conslt->displaydoctors($spe)[7];
    $avgrating = $conslt->displaydoctors($spe)[8];
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
                    <strong><a class="btn btn-warning" href="http://localhost/ODCS/acfiles/review.php?did='.$storeArrayUid[$i].'" target="_blank">Reviews</a></strong>
                    <br>
                    <strong>Rating: </strong>'.$avgrating[$i].'<br>
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