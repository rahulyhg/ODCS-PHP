<?php
require("config.php");
$pid = $_GET['pid'];
$record = new conversation();
$pname = $record->getdataid($pid)['fname'];
$msg = $record->patientconsultdataid($pid)[0];
$sub = $record->patientconsultdataid($pid)[1];
$status = $record->patientconsultdataid($pid)[5];
$cid = $record->patientconsultdataid($pid)[3];
$did = $record->patientconsultdataid($pid)[2];
$dname = $record->patientconsultdataid($pid)[4];
?>
<head>
    <title>Patient Record Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
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
                    <p><a href="'.$webhost.'acfiles/file/'.$row11['fid'].'">'.$row11['fid'].'</a></p>

         ';
             }
             echo ' </div>  </div>
        </li>';
             //file query

             $pmsg1 = $chat->getpredata($cid)[0];
             $pno1 = $chat->getpredata($cid)[1];
             $time1 = $chat->getpredata($cid)[3];
             $did1 = $chat->getpredata($cid)[4];
             $dname1 = $chat->getpredata($cid)[5];
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
                    <p><a href="'.$webhost.'acfiles/file/'.$row11['fid'].'">'.$row11['fid'].'</a></p>

         ';
             }
             echo ' </div>  </div>
        </li>';
             //file query

             $pmsg1 = $chat->getpredata($cid)[0];
             $pno1 = $chat->getpredata($cid)[1];
             $time1 = $chat->getpredata($cid)[3];
             $did1 = $chat->getpredata($cid)[4];
             $dname1 = $chat->getpredata($cid)[5];

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
