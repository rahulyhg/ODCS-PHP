<?php
require("config.php");
$cid = $_GET['cid'];
$did = $_GET['did'];
$chat = new conversation();
$row = $chat->consultdata($cid);
$pid = $row['pid'];
if($user != "") {

    $sub = $row['subject'];
    $message = $row['message'];
    $status = $row['status'];
    if($status == 'Asked') {
        $pmoney = $chat->balance($pid);
        $dmoney = $chat->balance($did);
        if($pmoney == 0) {
            die("<h1>insufficient funds<h1> <a href='/ODCS/index.php'>return home to add funds</a> ");

        }else{
           $chat->addmoneywallet($did,$pid,100);
            $chat->removemoneywallet($pid,$did,100);
            $chat->changestatus($did,$cid);
        }

    }
}
if($user != "") {

    $atypec = $chat->currentuserdata()['actp'];
    $name = $chat->getdataid($pid)['fname'];
    $atype = $chat->getdataid($pid)['actp'];
    $weight = $chat->viewprofilepatient($pid)['weight'];
    $gender = $chat->viewprofilepatient($pid)['gender'];
    $height = $chat->viewprofilepatient($pid)['height'];
    $address = $chat->viewprofilepatient($pid)['address'];
    $dob = $chat->viewprofilepatient($pid)['dob'];
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

    $msge = $chat->getconvdata($cid)[0];
    $cname = $chat->getconvdata($cid)[1];
    $noe = $chat->getconvdata($cid)[2];
    $atypep = $chat->getconvdata($cid)[3];
    $pmsg = $chat->getpredata($cid)[0];
    $pno = $chat->getpredata($cid)[1];
    $prep = $chat->getpredata($cid)[2];
    $time = $chat->getpredata($cid)[3];
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
                <div class="well panel panel-success">
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