
<?php
require("config.php");
if($user != "") {
    $conslt = new consult();
    $atype = $conslt->currentuserdata()['actp'];
    $sp = array_unique($conslt->speciality());
    sort($sp);
}
?>
<head>
    <title>Consltation Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>


<div class="container" style="margin-top: 60px">
    <div class="panel panel-primary">
        <div class="panel-heading">Personal Consultation Page</div>
        <div class="panel-body">
            <table class="table table-striped table-hover">

                <?php
                if($atype == "Patient"){
                    $subject = $conslt->patientconsultdata()[1];
                    $dname = $conslt->patientconsultdata()[4];
                    $did = $conslt->patientconsultdata()[2];
                    $cid = $conslt->patientconsultdata()[3];
                    $status = $conslt->patientconsultdata()[5];

                    echo '<thead>
                <tr>
                    <th colspan="2">Question</th>
                    <th>Doctor Name</th>
                    <th>Status</th>
                    <th>Link</th>
                </tr>
                </thead><tbody>';
                    for($i=0;$i<sizeof($subject);$i++){
                    if($status[$i] == 'Asked'){}else
                        echo '   <tr>
                    <td><img src="img/question.png" class="img-thumbnail" alt="Item description" title="Some shop item">
                    </td>
                    <td>'.$subject[$i].'</td>
                    <td>Dr. '.$dname[$i].'</td>
                    <td>'.$status[$i].'</td>
                    <td><a href="http://localhost/ODCS/acfiles/conversation.php?cid='.$cid[$i].'&did='.$did[$i].'">View this</a></td>
                </tr>';
                    }
                    echo'
                </tbody>
            </table><a class="small pull-left" href="http://localhost/ODCS">back</a>
            <a href="#" data-toggle="modal" data-target="#modalCompose" class="btn btn-primary btn-bg pull-right">Add Consult</a>';



                }elseif($atype == 'Doctor'){
                    $subject = $conslt->doctorconsultdata()[1];
                    $dname = $conslt->doctorconsultdata()[4];
                    $pid = $conslt->doctorconsultdata()[2];
                    $cid = $conslt->doctorconsultdata()[3];
                    $status = $conslt->doctorconsultdata()[5];
                   echo '<thead>
                <tr>
                    <th colspan="2">Question</th>
                    <th>Patient Name</th>
                    <th>Status</th>
                    <th>Link</th>
                </tr>
                </thead><tbody>';
                    for($i=0;$i<sizeof($subject);$i++){
                        echo '   <tr>
                    <td><img src="img/question.png" class="img-thumbnail" alt="Item description" title="Some shop item">
                    </td>
                    <td>'.$subject[$i].'</td>
                    <td>'.$dname[$i].'</td>
                    <td>'.$status[$i].'</td>
                    <td><a href="http://localhost/ODCS/acfiles/conversation.php?cid='.$cid[$i].'&did='.$user.'">View this</a></td>
                </tr>';
                    }
                    echo'
                </tbody>
            </table><a class="small pull-left" href="http://localhost/ODCS">Back</a>
           ';



                }
                ?>



        </div>
    </div>
</div>
<!-- /.modal compose message -->
<div class="modal fade" id="modalCompose" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Compose Message</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal" method="post" action="doctorselect.php">
                    <div class="form-group">
                        <label class="col-sm-2" for="inputTo">Speiality</label>
                        <div class="col-sm-10"><select class="form-control" id="spl" name="spl">
                                <?php
                                for($i=0;$i < sizeof($sp) ; $i++){
                                    echo "<option>".$sp[$i]."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2" for="inputSubject">Subject</label>
                        <div class="col-sm-10"><input class="form-control" name="sub" id="inputSubject" placeholder="Subject" type="text"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12" for="inputBody">Message</label>
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

