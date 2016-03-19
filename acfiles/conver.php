<?php
require("config.php");
$cid = $_POST['cid'];
$did = $_POST['did'];
$pid =$_POST['pid'];
$message = $_POST['con'];
$type = $_POST['pres'];
$conv = new conversation();
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
            $conv->addfile($file_name,$cid);
            $path = "http://localhost/ODCS/acfiles/file/" . $file_name;
            $msg = "<br><br><a href=" . $path . ">Download Attachment</a> ";
            $message = $message . $msg;
        } else {
            print_r($errors);
        }
    }

    $conv->addconversation($cid,$message);
}elseif($type == 'Presription'){
    $conv->addprescription($did,$pid,$cid,$message);
}
$newURL  = "http://localhost/ODCS/acfiles/conversation.php?cid=".$cid."&did=".$did;
//setcookie("id", $uid, time() + (86400 * 30), "/");
echo $message;
header('Location: '.$newURL);

?>