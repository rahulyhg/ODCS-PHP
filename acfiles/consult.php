
<?php
require("dbsettings.php");
$user = $_COOKIE["id"];
if($user != "") {
    $chkacqry = "SELECT * FROM `odcs`.`allusers` WHERE uid='$user'";
    $balqry = "SELECT * FROM `odcs`.`bill` WHERE uid='$user'";
    mysqli_select_db($dbhandle, $mysqlidb);
    $result = mysqli_query($dbhandle, $chkacqry) or die("<h2> Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $name = $row['fname'];
    $usern = $row["username"];
    $atype = $row["actp"];
    $result2 = mysqli_query($dbhandle, $balqry) or die("<h2> Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
    $row2 = mysqli_fetch_assoc($result2);
    $money = $row2['balance'];
    $result = mysqli_query($dbhandle,"SELECT speciality FROM doctor");
    $storeArray = Array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $storeArray[] =  $row['speciality'];
    }
    //print_r($storeArray);
    $sp = array_unique($storeArray);
    sort($sp);
    $sp_l = sizeof($sp);
    if ($count == 1){
        $flag =1;
    }else{
        $flag =0;
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


<div class="container" style="margin-top: 60px">
    <div class="panel panel-primary">
        <div class="panel-heading">Personal Consultation Page</div>
        <div class="panel-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th colspan="2">Questin</th>
                    <th>Asked Date</th>
                    <th>Status</th>
                    <th>Doctor Name</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><img src="http://lorempixel.com/40/40/food?afK5dD" class="img-thumbnail" alt="Item description" title="Some shop item">
                    </td>
                    <td>Fuk ass</td>
                    <td>12.12.12</td>
                    <td>unsolvesd</td>
                    <td>gokul</td>
                </tr>
                <tr>
                    <td><img src="http://lorempixel.com/40/40/food?L5EddA5" class="img-thumbnail" alt="Item description" title="Some shop item">
                    </td>
                    <td>Fuk pussy</td>
                    <td>12.12.12</td>
                    <td>unsolvesd</td>
                    <td>gokul</td>
                </tr>

                </tbody>
            </table>
            <a href="#" data-toggle="modal" data-target="#modalCompose" class="btn btn-primary btn-bg pull-right">Add Consult</a>
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
                                for($i=0;$i < $sp_l ; $i++){
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

