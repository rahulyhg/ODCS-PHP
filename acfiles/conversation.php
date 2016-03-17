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
    if($status == 'Asked') {
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
            $qry = "UPDATE `odcs`.`conversations` SET `status` = 'Active' WHERE `conversations`.`cid` = '$cid'";
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
    $jqry1 = "SELECT * FROM `odcs`.`prescription` WHERE cid='$cid'";
    $result101 = mysqli_query($dbhandle,$jqry1) or die("pconv errr");
    $pmsg = Array();
    $pno = Array();
    $prep = Array();
    $time = array();
    while ($row10 = mysqli_fetch_array($result101, MYSQLI_ASSOC)) {
       $pmsg[] = $row10['pre'];
        $pno[] = $row10['pno'];
        $prep[] = $row10['prid'];
        $time[] = $row10['time'];
    }
}

?>
<head>
    <title>Consultation Page</title>
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
                                <h2><a href="http://localhost/ODCS/acfiles/pr.php?pid=<?php echo $pid; ?>" target="_blank"><?php echo $name; ?></a></h2>
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
    <?php

    for($i=0;$i<sizeof($pmsg);$i++) {
        echo '
        <div class="container" >
    <div class="row" >
    <div class="col-md-12" >
    <div class="panel panel-default" >
        <div class="panel-heading" >Prescription #'.$pno[$i].' Given on : '.$time[$i].'</div >
        <div class="panel-body" >'.$pmsg[$i].'</div >
        <div class="panel-footer" ><a href="http://localhost/ODCS/acfiles/print.php?pid='.$prep[$i].'" target="_blank">Print</a></div >
    </div >
    </div >
    </div >
    </div >';
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Conversation
                    </div>
                    <div class="panel-body comments">
                        <form role="form" class="form-horizontal" method="post" action="conver.php" enctype="multipart/form-data">
                            <input class="form-control" name="did" id="inputSubject" value="<?php echo $did; ?>" type="hidden">
                            <input class="form-control" name="pid" id="inputSubject" value="<?php echo $pid; ?>" type="hidden">

                            <input class="form-control" name="cid" id="inputSubject" value="<?php echo $cid; ?>" type="hidden">
                        <textarea class="form-control" name="con" placeholder="Write your comment add <br> for line break" rows="5"></textarea>


                        <?php
                        if($atypec == "Patient"){
                            echo '
                            <label class="control-label">Select File</label>
                            <input id="input-1" type="file" name="file" class="file">
                        <br>
                            <a class="small pull-left" href="http://localhost/ODCS">Home </a><br>
                            <a href="#" data-toggle="modal" data-target="#modalCompose" class="btn btn-danger btn-bg pull-left">Close this and review</a>\';


                        <input type="hidden" value="Message" name="pres">
                        <input type="submit" class="btn btn-info pull-right" value="send">

                            </form>
                        <div class="clearfix"></div>
                        <hr>';
                        }elseif($atypec == "Doctor"){
                            echo '
  <label for="sel1">Select Type Of input:</label>
  <select class="form-control" name="pres" id="sel1">
    <option>Message</option>
    <option>Presription</option>
  </select>
  <br>
<a class="small pull-left" href="#"></a>
<a class=" pull-left" href="http://localhost/ODCS">Home</a>
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
                                        <strong class="text-success">Dr. ' . $cname[$i] . '</strong>
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
    <div class="modal fade" id="modalCompose" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Review Box</h4>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-horizontal" method="post" action="close.php">
                        <div class="form-group">
                            <label class="col-sm-2" for="inputTo">Rate</label>
                            <label class="radio-inline"><input type="radio" value="1" name="optradio">1</label>
                            <label class="radio-inline"><input type="radio" value="2" name="optradio">2</label>
                            <label class="radio-inline"><input type="radio" value="3" name="optradio">3</label>
                            <label class="radio-inline"><input type="radio" value="4" name="optradio">4</label>
                            <label class="radio-inline"><input type="radio" value="5" name="optradio">5</label>
                        </div>
                        <input type="hidden" name="cid" value="<?php echo $cid; ?>">
                         <input type="hidden" name="did" value="<?php echo $did; ?>">
                        <div class="form-group">
                            <label class="col-sm-12" for="inputBody">Review</label>
                            <div class="col-sm-12"><textarea name="msg" class="form-control" id="inputBody" rows="8"></textarea></div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>

                    <input type="submit" class="btn btn-primary " value="Send" >
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal compose message -->

<?php
/**
 * Created by PhpStorm.
 * User: Sebin PJ
 * Date: 3/14/2016
 * Time: 10:38 PM
 */