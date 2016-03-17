<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>AdminPanel - ODCS'16</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="blurBg-false" style="background-color:#EBEBEB">



<!-- Start form-->
<link rel="stylesheet" href="signin_files/formoid1/formoid-metro-cyan.css" type="text/css"  />
<script type="text/javascript" src="signin_files/formoid1/jquery.min.js"></script>
<?php
if ($_POST['input'] == 'admin' && $_POST['password'] == 'admin') {
    require("acfiles/dbsettings.php");
    $db_host  = $mysqlihost;
    $db_user  = $mysqliuser;
    $db_pwd   = $mysqlipass;
    //$resume   = $_POST['resume'];
    $tabl     = $_POST['workshop'];
    $database = $mysqlidb;
    //$table    = 'patient';
    $xl = $tabl;

    $query = 'SELECT * FROM '.$tabl ;
    echo '<form class="formoid-metro-cyan" style="background-color:#FFFFFF;font-size:14px;font-family:\'Open Sans\',\'Helvetica Neue\',\'Helvetica\',Arial,Verdana,sans-serif;color:#666666;max-width:100%;min-width:150px" method="post" action="xls.php?download=' . $resume . $tabl . '"><div class="title"><h2>AdminPanel</h2></div>';
    if (!$dbhandle)
        die("Can't connect to database");
    if (!mysqli_select_db($dbhandle, $mysqlidb))
        die("Can't select database");
    $result = mysqli_query($dbhandle,$query);
    if (!$result) {
        die("Query to show fields from table failed".mysqli_error($dbhandle));
    }
    $fields_num = mysqli_num_fields($result);
    echo "<h2> </h2>";
    echo "<table class='flat-table'><tr>";
    for ($i = 0; $i < $fields_num; $i++) {
        $field = mysqli_fetch_field($result);
        echo "<th>{$field->name}</th>";
    }
    echo "</tr>\n";
    while ($row = mysqli_fetch_row($result)) {
        echo "<tr>";
        foreach ($row as $cell)
            echo "<td>$cell</td>";
        echo "</tr>\n";
    }
    echo "<div class=\"submit\"><input type=\"submit\" value=\"Download xls\"/>";
    mysqli_free_result($result);
    echo "</table>";
} else {
    echo "<h1> Loginfail </h1>";
}
?>
<div class="submit"></form><p class="frmd"><a href="http://formoid.com/v29.php">jquery form</a> Formoid.com 2.9</p><script type="text/javascript" src="signin_files/formoid1/formoid-metro-cyan.js"></script>
    <!-- Stop form-->



</body>
</html>
