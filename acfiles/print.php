<?php
require("config.php");
$print = new conversation();
$prid = $_GET['pid'];
$row = $print->getpre($prid);
$pr = $row['pre'];
$did =$row['did'];
$pid =$row['pid'];
$name = $print->getdataid($pid)['fname'];
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




