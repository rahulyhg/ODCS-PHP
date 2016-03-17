<?php
require("dbsettings.php");
$user = $_COOKIE["id"];
$pid = $_GET['pid'];
$result4 = mysqli_query($dbhandle, "SELECT * FROM `odcs`.`allusers` WHERE uid='".$pid."'") or die("<h2> pCoR4 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
$row9 = mysqli_fetch_array($result4, MYSQLI_ASSOC);
$pname = $row9['fname'];
$qry = "SELECT * FROM `odcs`.`prescription` WHERE cid='$pid'";
mysqli_select_db($dbhandle, $mysqlidb);
$result = mysqli_query($dbhandle, $qry) or die("<h2>pr Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
$row = mysqli_fetch_assoc($result);
//print_r($row);
//$pr = $row['pre'];
//$did =$row['did'];
$jqry1 = "SELECT * FROM `odcs`.`conversations` WHERE pid='$pid'";
$result101 = mysqli_query($dbhandle,$jqry1) or die("pconv errr". mysqli_error($dbhandle));
$msg = Array();
//$pno = Array();
$sub = Array();
$status = array();
$cid = array();
$did = array();
$dname = array();
while ($row10 = mysqli_fetch_array($result101, MYSQLI_ASSOC)) {
    $msg[] = $row10['message'];
    //$pno[] = $row10['pno'];
    //$prep[] = $row10['prid'];
    $sub[] = $row10['subject'];
    $did[] = $row10['did'];
    $cid[] = $row10['cid'];
    $result40 = mysqli_query($dbhandle, "SELECT * FROM `odcs`.`allusers` WHERE uid='".$row10["did"]."'") or die("<h2> pCoR4 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
    $row40 = mysqli_fetch_assoc($result40);
    $dname[] = $row40['fname'];

}
?>
<head>
    <title>Patient Record Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<div class="container">
    <div class="page-header">
        <h1 id="timeline">Record Of <?php echo $pname;?></h1>
    </div>
    <ul class="timeline">
    <?php
     for($i=0;$i<sizeof($msg);$i++){
         if($i%2 == 0) {
             echo '<li>
            <div class="timeline-badge danger"><i class=""></i></div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                    <h4 class="timeline-title">' . $sub[$i] . '</h4>
                    <p><small class="text-muted">Asked ' . $dname[$i] . ' </small></p>
                </div>
                <div class="timeline-body">
                    <p>' . $msg[$i] . '.</p>
                </div>
            </div>
        </li>
        ';
             // file Query
             echo '<li>

            <div class="timeline-panel">
                <div class="timeline-heading">
                    <h4 class="timeline-title">Files Upload For this</h4>
                    <p><small class="text-muted">File List</small></p>
                </div><div class="timeline-body">
                ';
             $fqry = "SELECT * FROM `odcs`.`file` WHERE cid='".$cid[$i]."'";
             $result1011 = mysqli_query($dbhandle, $fqry) or die("pconv errr" . mysqli_error($dbhandle));
             while ($row11 = mysqli_fetch_array($result1011, MYSQLI_ASSOC)){
                 echo '
                    <p><a href="http://localhost/ODCS/acfiles/file/'.$row11['fid'].'">'.$row11['fid'].'</a></p>

         ';
             }
             echo ' </div>  </div>
        </li>';
             //file query

             $jqry1 = "SELECT * FROM `odcs`.`prescription` WHERE cid='" . $cid[$i] . "'";
             $result101 = mysqli_query($dbhandle, $jqry1) or die("pconv errr" . mysqli_error($dbhandle));
             $pmsg1 = Array();
             $pno1 = Array();
             $sub1 = Array();
             $time1 = array();
             $cid1 = array();
             $did1 = array();
             $dname1 = array();
             while ($row10 = mysqli_fetch_array($result101, MYSQLI_ASSOC)) {
                 $pmsg1[] = $row10['pre'];
                 $pno1[] = $row10['pno'];
                 $prep1[] = $row10['prid'];
                 $time1[] = $row10['time'];
                 $did1[] = $row10['did'];
                 //$cid[] = $row10['cid'];
                 $result40 = mysqli_query($dbhandle, "SELECT * FROM `odcs`.`allusers` WHERE uid='" . $row10["did"] . "'") or die("<h2> pCoR4 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
                 $row40 = mysqli_fetch_assoc($result40);
                 $dname1[] = $row40['fname'];

             }
             for ($j = 0; $j < sizeof($pmsg1); $j++) {
                 echo '<li>

            <div class="timeline-panel">
                <div class="timeline-heading">
                    <h4 class="timeline-title">Prescription #' . $pno1[$j] . '</h4>
                    <p><small class="text-muted">By ' . $dname1[$j] . ' in ' . $time1[$j] . ' </small></p>
                </div>
                <div class="timeline-body">
                    <p>' . $pmsg1[$j] . '.</p>
                </div>
            </div>
        </li>';
             }
         }else{
             echo '<li class="timeline-inverted">
            <div class="timeline-badge warning"><i class=""></i></div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                    <h4 class="timeline-title">' . $sub[$i] . '</h4>
                    <p><small class="text-muted">Asked ' . $dname[$i] . ' </small></p>
                </div>
                <div class="timeline-body">
                    <p>' . $msg[$i] . '.</p>
                </div>
            </div>
        </li>
        ';
             // file Query
             echo '<li class="timeline-inverted">

            <div class="timeline-panel">
                <div class="timeline-heading">
                    <h4 class="timeline-title">Files Upload For this</h4>
                    <p><small class="text-muted">File List</small></p>
                </div><div class="timeline-body">
                ';
             $fqry = "SELECT * FROM `odcs`.`file` WHERE cid='".$cid[$i]."'";
             $result1011 = mysqli_query($dbhandle, $fqry) or die("pconv errr" . mysqli_error($dbhandle));
             while ($row11 = mysqli_fetch_array($result1011, MYSQLI_ASSOC)){
                 echo '
                    <p><a href="http://localhost/ODCS/acfiles/file/'.$row11['fid'].'">'.$row11['fid'].'</a></p>

         ';
             }
             echo ' </div>  </div>
        </li>';
             //file query

             $jqry1 = "SELECT * FROM `odcs`.`prescription` WHERE cid='" . $cid[$i] . "'";
             $result101 = mysqli_query($dbhandle, $jqry1) or die("pconv errr" . mysqli_error($dbhandle));
             $pmsg1 = Array();
             $pno1 = Array();
             $sub1 = Array();
             $time1 = array();
             $cid1 = array();
             $did1 = array();
             $dname1 = array();
             while ($row10 = mysqli_fetch_array($result101, MYSQLI_ASSOC)) {
                 $pmsg1[] = $row10['pre'];
                 $pno1[] = $row10['pno'];
                 $prep1[] = $row10['prid'];
                 $time1[] = $row10['time'];
                 $did1[] = $row10['did'];
                 //$cid[] = $row10['cid'];
                 $result40 = mysqli_query($dbhandle, "SELECT * FROM `odcs`.`allusers` WHERE uid='" . $row10["did"] . "'") or die("<h2> pCoR4 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
                 $row40 = mysqli_fetch_assoc($result40);
                 $dname1[] = $row40['fname'];

             }

             for ($j = 0; $j < sizeof($pmsg1); $j++) {
                 echo '<li class="timeline-inverted">

            <div class="timeline-panel">
                <div class="timeline-heading">
                    <h4 class="timeline-title">Prescription #' . $pno1[$j] . '</h4>
                    <p><small class="text-muted">By ' . $dname1[$j] . ' in ' . $time1[$j] . ' </small></p>
                </div>
                <div class="timeline-body">
                    <p>' . $pmsg1[$j] . '.</p>
                </div>
            </div>
        </li>';
             }
         }

     }
    ?>

    </ul>
</div>
<style>
    .timeline {
        list-style: none;
        padding: 20px 0 20px;
        position: relative;
    }

    .timeline:before {
        top: 0;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 3px;
        background-color: #eeeeee;
        left: 50%;
        margin-left: -1.5px;
    }

    .timeline > li {
        margin-bottom: 20px;
        position: relative;
    }

    .timeline > li:before,
    .timeline > li:after {
        content: " ";
        display: table;
    }

    .timeline > li:after {
        clear: both;
    }

    .timeline > li:before,
    .timeline > li:after {
        content: " ";
        display: table;
    }

    .timeline > li:after {
        clear: both;
    }

    .timeline > li > .timeline-panel {
        width: 46%;
        float: left;
        border: 1px solid #d4d4d4;
        border-radius: 2px;
        padding: 20px;
        position: relative;
        -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
        box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
    }

    .timeline > li > .timeline-panel:before {
        position: absolute;
        top: 26px;
        right: -15px;
        display: inline-block;
        border-top: 15px solid transparent;
        border-left: 15px solid #ccc;
        border-right: 0 solid #ccc;
        border-bottom: 15px solid transparent;
        content: " ";
    }

    .timeline > li > .timeline-panel:after {
        position: absolute;
        top: 27px;
        right: -14px;
        display: inline-block;
        border-top: 14px solid transparent;
        border-left: 14px solid #fff;
        border-right: 0 solid #fff;
        border-bottom: 14px solid transparent;
        content: " ";
    }

    .timeline > li > .timeline-badge {
        color: #fff;
        width: 50px;
        height: 50px;
        line-height: 50px;
        font-size: 1.4em;
        text-align: center;
        position: absolute;
        top: 16px;
        left: 50%;
        margin-left: -25px;
        background-color: #999999;
        z-index: 100;
        border-top-right-radius: 50%;
        border-top-left-radius: 50%;
        border-bottom-right-radius: 50%;
        border-bottom-left-radius: 50%;
    }

    .timeline > li.timeline-inverted > .timeline-panel {
        float: right;
    }

    .timeline > li.timeline-inverted > .timeline-panel:before {
        border-left-width: 0;
        border-right-width: 15px;
        left: -15px;
        right: auto;
    }

    .timeline > li.timeline-inverted > .timeline-panel:after {
        border-left-width: 0;
        border-right-width: 14px;
        left: -14px;
        right: auto;
    }

    .timeline-badge.primary {
        background-color: #2e6da4 !important;
    }

    .timeline-badge.success {
        background-color: #3f903f !important;
    }

    .timeline-badge.warning {
        background-color: #f0ad4e !important;
    }

    .timeline-badge.danger {
        background-color: #d9534f !important;
    }

    .timeline-badge.info {
        background-color: #5bc0de !important;
    }

    .timeline-title {
        margin-top: 0;
        color: inherit;
    }

    .timeline-body > p,
    .timeline-body > ul {
        margin-bottom: 0;
    }

    .timeline-body > p + p {
        margin-top: 5px;
    }

    @media (max-width: 767px) {
        ul.timeline:before {
            left: 40px;
        }

        ul.timeline > li > .timeline-panel {
            width: calc(100% - 90px);
            width: -moz-calc(100% - 90px);
            width: -webkit-calc(100% - 90px);
        }

        ul.timeline > li > .timeline-badge {
            left: 15px;
            margin-left: 0;
            top: 16px;
        }

        ul.timeline > li > .timeline-panel {
            float: right;
        }

        ul.timeline > li > .timeline-panel:before {
            border-left-width: 0;
            border-right-width: 15px;
            left: -15px;
            right: auto;
        }

        ul.timeline > li > .timeline-panel:after {
            border-left-width: 0;
            border-right-width: 14px;
            left: -14px;
            right: auto;
        }
    }
</style>