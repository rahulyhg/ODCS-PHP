<?php
require("dbsettings.php");
$user = $_COOKIE["id"];
$cid = $_GET['cid'];
$did = $_GET['did'];
if($user != "") {
    $conqry = "SELECT * FROM `odcs`.`conversations` WHERE cid='$cid'";
    mysqli_select_db($dbhandle, $mysqlidb);
    $cresult = mysqli_query($dbhandle, $conqry) or die("<h2>C1 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
    $row = mysqli_fetch_assoc($cresult);
    $sub = $row['subject'];
    $message = $row['message'];
    $status = $row['status'];
    $pid = $row['pid'];
    if($status == 'no') {
        $addoqry = "UPDATE `odcs`.`conversations` SET `did` = '$did' WHERE `conversations`.`cid` = '$cid'";
        $cresult2 = mysqli_query($dbhandle, $addoqry) or die("<h2>C2 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
        $balqry1 = "SELECT * FROM `odcs`.`bill` WHERE uid='$user'";
        $balqry2 = "SELECT * FROM `odcs`.`bill` WHERE uid='$did'";
        $cresult3 = mysqli_query($dbhandle, $balqry1) or die("<h2>C3 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
        $row3 = mysqli_fetch_assoc($cresult3);
        $pmoney = $row3['balance'];
        $cresult4 = mysqli_query($dbhandle, $balqry2) or die("<h2>C4 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
        $row4 = mysqli_fetch_assoc($cresult4);
        $dmoney = $row4['balance'];
        if($pmoney == 0) {
            die("<h1>insufficient funds<h1> <a href='/ODCS/index.php'>return home to add funds</a> ");

        }else{
            $pmoney -= 100;
            $dmoney =$dmoney + 100;
            $qry1 = "UPDATE `odcs`.`bill` SET `balance` = '$pmoney' WHERE `bill`.`uid` = '$user'";
            $qry2 = "UPDATE `odcs`.`bill` SET `balance` = '$dmoney' WHERE `bill`.`uid` = '$did'";
            $qry = "UPDATE `odcs`.`conversations` SET `status` = '1' WHERE `conversations`.`cid` = '$cid'";
            $cresult5 = mysqli_query($dbhandle, $qry1) or die("<h2>C5 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
            $cresult6 = mysqli_query($dbhandle, $qry2) or die("<h2>C6 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
            $cresult6 = mysqli_query($dbhandle, $qry) or die("<h2>C7 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));

        }

    }
}
if($user != "") {
    $chkacqry12 = "SELECT * FROM `odcs`.`allusers` WHERE uid='$user'";
   // $balqry = "SELECT * FROM `odcs`.`patient` WHERE uid='$pid'";
    mysqli_select_db($dbhandle, $mysqlidb);
    $result12 = mysqli_query($dbhandle, $chkacqry12) or die("<h2> Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
    $count12 = mysqli_num_rows($result12);
    $row12 = mysqli_fetch_assoc($result12);
    $atypec = $row12["actp"];
    $chkacqry = "SELECT * FROM `odcs`.`allusers` WHERE uid='$pid'";
    $balqry = "SELECT * FROM `odcs`.`patient` WHERE uid='$pid'";
    //mysqli_select_db($dbhandle, $mysqlidb);
    $result = mysqli_query($dbhandle, $chkacqry) or die("<h2> Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $name = $row['fname'];
    $usern = $row["username"];
    $atype = $row["actp"];
    $result2 = mysqli_query($dbhandle, $balqry) or die("<h2> Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
    $row2 = mysqli_fetch_assoc($result2);
    $weight = $row2['weight'];
    $gender = $row2['gender'];
    $height = $row2['height'];
    $address = $row2['address'];
    $dob = $row2['dob'];
    $a = explode('/',$dob);
    $age =0;
    if ($a[1]<3){
        $age = 2016-$a[2];}
    elseif ($a[1]>3){
        $age=2015-$a[2];}
    else {
        if($a[0]<=16)
            $age=2016-$a[2];
        else $age = 2015-$a[2];

        }
    if ($count == 1){
        $flag =1;
    }else{
        $flag =0;
    }
    $jqry = "SELECT * FROM conversation WHERE cid='$cid'";
    $result10 = mysqli_query($dbhandle,$jqry) or die("conv errr");
    $msge = Array();
    $cname = Array();
    $noe = Array();
    $atypep = array();
    while ($row10 = mysqli_fetch_array($result10, MYSQLI_ASSOC)) {
        $msge[] =  $row10['msg'];
        $noe[] =  $row10['no'];
        $result40 = mysqli_query($dbhandle, "SELECT * FROM `odcs`.`allusers` WHERE uid='".$row10["mid"]."'") or die("<h2> CoR4 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
        $row40 = mysqli_fetch_assoc($result40);
        $cname[] = $row40['fname'];
        $atypep[] = $row40['actp'];

    }
}

?>
<head>
    <title>Bootstrap Example</title>
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
    <p class="lead text-center"><?php echo $message; ?>.</p>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-xs-10">
                <div class="well panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 text-center">
                                <img src="http://localhost/ODCS/acfiles/img/patient.png" alt="" class="center-block img-circle img-thumbnail img-responsive">
                                <ul class="list-inline ratings text-center" title="Ratings">
                                    <li><a href="#"><span class="fa fa-star fa-lg"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star fa-lg"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star fa-lg"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star fa-lg"></span></a></li>
                                    <li><a href="#"><span class="fa fa-star fa-lg"></span></a></li>
                                </ul>
                            </div>
                            <!--/col-->
                            <div class="col-xs-12 col-sm-8">
                                <h2><?php echo $name; ?></h2>
                                <p><strong>Gender: </strong><?php echo $gender; ?>. </p>
                                <p><strong>Address: </strong> <?php echo $address; ?> </p>

                            </div>
                            <!--/col-->
                            <div class="clearfix"></div>
                            <div class="col-xs-12 col-sm-4">
                                <h2><strong> <?php echo $height; ?> </strong></h2>
                                <p><small>Height</small></p>

                            </div>
                            <!--/col-->
                            <div class="col-xs-12 col-sm-4">
                                <h2><strong><?php echo $weight; ?></strong></h2>
                                <p><small>Weight</small></p>

                            </div>
                            <!--/col-->
                            <div class="col-xs-12 col-sm-4">
                                <h2><strong><?php echo $age; ?></strong></h2>
                                <p><small>Age</small></p>

                            </div>
                            <!--/col-->
                        </div>
                        <!--/row-->
                    </div>
                    <!--/panel-body-->
                </div>
                <!--/panel-->
            </div>
            <!--/col-->
        </div>
        <!--/row-->
    </div>
    <!--/container-->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Conversation
                    </div>
                    <div class="panel-body comments">
                        <form role="form" class="form-horizontal" method="post" action="conver.php">
                            <input class="form-control" name="did" id="inputSubject" value="<?php echo $did; ?>" type="hidden">
                            <input class="form-control" name="cid" id="inputSubject" value="<?php echo $cid; ?>" type="hidden">
                        <textarea class="form-control" name="con" placeholder="Write your comment" rows="5"></textarea>
                        <br>

                        <?php
                        if($atypec == "Patient"){
                            echo '<a class="small pull-left" href="#">Close This Case</a>
                        <input type="submit" class="btn btn-info pull-right" value="send">
                            </form>
                        <div class="clearfix"></div>
                        <hr>';
                        }elseif($atypec == "Doctor"){
                            echo '<a class="small pull-left" href="#"></a>
                        <input type="submit" class="btn btn-info pull-right" value="send">
                            </form>
                        <div class="clearfix"></div>
                        <hr>';
                        }
                        for($i=(sizeof($cname)-1);$i>=0;$i--){
                            if($atypep[$i] == "Patient") {
                                echo '  <ul class="media-list">
                            <li class="media">
                                <div class="comment">
                                    <a href="#" class="pull-left">
                                        <img src="http://localhost/ODCS/acfiles/img/rsz_patient.png" alt="" class="img-circle">
                                    </a>
                                    <div class="media-body">
                                        <strong class="text-success">' . $cname[$i] . '</strong>
                  <span class="text-muted">
                  <small class="text-muted"> #' . $noe[$i] . ' </small>
                  </span>
                                        <p>' . $msge[$i] . '
                                          </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>';
                            }else{
                                echo '  <ul class="media-list">
                            <li class="media">
                                <div class="comment">
                                    <a href="#" class="pull-left">
                                        <img src="http://localhost/ODCS/acfiles/img/rsz_doctor.png" alt="" class="img-circle">
                                    </a>
                                    <div class="media-body">
                                        <strong class="text-success">' . $cname[$i] . '</strong>
                  <span class="text-muted">
                  <small class="text-muted"> #' . $noe[$i] . ' </small>
                  </span>
                                        <p>' . $msge[$i] . '
                                          </p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>';
                            }
                        }
                        $i--
                        ?>
                           </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
/**
 * Created by PhpStorm.
 * User: Sebin PJ
 * Date: 3/14/2016
 * Time: 10:38 PM
 */