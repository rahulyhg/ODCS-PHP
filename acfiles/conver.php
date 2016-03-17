<?php
require("dbsettings.php");
mysqli_select_db($dbhandle, $mysqlidb);

$cid = $_POST['cid'];
$did = $_POST['did'];
$pid =$_POST['pid'];
$message = $_POST['con'];
$user = $_COOKIE["id"];
$type = $_POST['pres'];
//print_r($_POST);
if($type == 'Message') {
    if (isset($_FILES['file'])) {
        $errors = array();
        $resume_name = rand(0, 1000000);
        // print_r($resume_name);
        $file_size = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_type = $_FILES['file']['type'];
        $file_ext = strtolower(end(explode('.', $_FILES['file']['name'])));
        $file_name = 'file_' . $resume_name . '.' . $file_ext;
        $expensions = array(
            "docx",
            "doc",
            'pdf',
            'jpg',
            'mp4',
            'avi',
            'png',
            'DCM',
            'dcm'

        );
        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "<h1>Extension not allowed,</h1><br><h2> please choose a PDF,jpg,mp4,png,doc,docx file.</h2><br><div align='center' style =\"margin:0 auto\" class=\"sad\"><span></span></div>
";

        }
        if ($file_size > 2097152999) {
            $errors[] = '<h1>File size limit 2 MB </h1> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br>';

        }
        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "file/" . $file_name) or die("Please Upload Again");
            echo "<h1>You Have Successfully Updated Your Resume</h1><br>";
            $fileqry = "INSERT INTO `odcs`.`file` (`fid`, `cid`, `time`) VALUES ('$file_name', '$cid', CURRENT_TIMESTAMP)";
            $result2 = mysqli_query($dbhandle, $fileqry) or die("<h2>FL0 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
            $path = "http://localhost/ODCS/acfiles/file/" . $file_name;
            $msg = "<br><br><a href=" . $path . ">Download Attachment</a> ";
            $message = $message . $msg;
        } else {
            print_r($errors);
        }
    }

    $mnq = "SELECT MAX(no) AS no FROM conversation WHERE cid='$cid'";
    $result2 = mysqli_query($dbhandle, $mnq) or die("<h2>CR0 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
    $row2 = mysqli_fetch_assoc($result2);
    $n = $row2['no'];
    $mn = $n + 1;
    echo $cid . '---' . $user . '---' . $message;
    $addc = "INSERT INTO `odcs`.`conversation` (`cid`, `mid`, `msg`, `no`) VALUES ('$cid', '$user', '$message', '$mn')";
    mysqli_query($dbhandle, $addc) or die("<h2>CR1 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
}elseif($type == 'Presription'){
    $mnq = "SELECT MAX(pno) AS pno FROM prescription WHERE cid='$cid'";
    $result2 = mysqli_query($dbhandle, $mnq) or die("<h2>pCR0 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
    $row2 = mysqli_fetch_assoc($result2);
    $n = $row2['pno'];
    $mn = $n + 1;
    echo $cid . '---' . $user . '---' . $message;

    $preid = md5(uniqid(rand(0,100000)));
    $presqry = "INSERT INTO `odcs`.`prescription` (`prid`, `did`, `pid`, `pre`, `pno`, `time`, `cid`) VALUES ('$preid', '$did', '$pid', '$message', '$mn', CURRENT_TIMESTAMP, '$cid')";
    mysqli_query($dbhandle, $presqry) or die("<h2>pCR1 Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));

}
$newURL  = "http://localhost/ODCS/acfiles/conversation.php?cid=".$cid."&did=".$did;
//setcookie("id", $uid, time() + (86400 * 30), "/");
echo $message;
header('Location: '.$newURL);

?>