<?php
require("dbsettings.php");
$user = $_COOKIE["id"];
$prid = $_GET['pid'];
$qry = "SELECT * FROM `odcs`.`prescription` WHERE prid='$prid'";
mysqli_select_db($dbhandle, $mysqlidb);
$result = mysqli_query($dbhandle, $qry) or die("<h2>pr Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
$row = mysqli_fetch_assoc($result);
//print_r($row);
$pr = $row['pre'];
$did =$row['did'];
$pid =$row['pid'];
$chkacqry = "SELECT * FROM `odcs`.`allusers` WHERE uid='$pid'";
$result2 = mysqli_query($dbhandle, $chkacqry) or die('Error on name');
$row2 = mysqli_fetch_assoc($result2);
$name = $row2['fname'];
?>
<head>
    <title>Patient Prescription Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<div class="container">
    <div class="page-header">
        <h1 class="text-center">Prescription for <?php echo $name; ?></h1>
    </div>
    <div class="page-header">
        <small>ODCS Prescription SIGNATURE</small>
        <img src="barcode.php?text='<?php echo $prid; ?>'">
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Prescription
                </div>
                <div class="panel-body comments">
                    <div class="text-center">
                        <?php echo $pr; ?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="page-header">
        <small>ODCS Doctor SIGNATURE</small>
        <img src="barcode.php?text='<?php echo $did; ?>'">
    </div>




