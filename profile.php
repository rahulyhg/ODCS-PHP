<?php
require("acfiles/config.php");
if($user != "") {
    $puser = new profile();
    $row = $puser->currentuserdata();
    $name = $row['fname'];
    $usern = $row["username"];
    $atype = $row["actp"];
    if($atype == 'Doctor') {
        $profiledata = $puser->viewprofiledoctor($user);

    }elseif($atype == 'Patient'){
        $profiledata = $puser->viewprofilepatient($user);
    }
   // print_r($profiledata);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="js/dist/css/bootstrap-select.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->

    <script src="js/jquery-1.12.0.min.js"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile : OCDS: Online Doctor Consultancy Service</title>
    <meta name="description" content="Cardio is a free one page template made exclusively for Codrops by Luka Cvetinovic" />
    <meta name="keywords" content="html template, css, free, one page, gym, fitness, web design" />
    <meta name="author" content="Luka Cvetinovic for Codrops" />
    <!-- Favicons (created with http://realfavicongenerator.net/)-->
    <link rel="apple-touch-icon" sizes="57x57" href="img/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/favicons/apple-touch-icon-60x60.png">
    <link rel="icon" type="image/png" href="img/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="img/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="img/favicons/manifest.json">
    <link rel="shortcut icon" href="img/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#00a8ff">
    <meta name="msapplication-config" content="img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- Normalize -->
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <!-- Owl -->
    <link rel="stylesheet" type="text/css" href="css/owl.css">
    <!-- Animate.css -->
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.1.0/css/font-awesome.min.css">
    <!-- Elegant Icons -->
    <link rel="stylesheet" type="text/css" href="fonts/eleganticons/et-icons.css">
    <!-- Main style -->
    <script>
        $(function()
        {
            $(document).on('click', '.btn-add', function(e)
            {
                e.preventDefault();

                var controlForm = $('.controls form:first'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(controlForm);

                newEntry.find('input').val('');
                controlForm.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<span class="glyphicon glyphicon-minus"></span>');
            }).on('click', '.btn-remove', function(e)
            {
                $(this).parents('.entry:first').remove();

                e.preventDefault();
                return false;
            });
        });
    </script>
</head>

<div class="container" style="padding-top: 60px;">
    <h1 class="page-header">Edit Profile <?php echo $usern; ?></h1>
    <div class="row">

        <!-- left column -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="text-center">
                <form class="form-horizontal" role="form" action="acfiles/file.php" method="post">
                    <?php
                    if($atype == 'Patient') {
                       echo' <img src = "http://localhost/ODCS/acfiles/img/patient.png" class="avatar img-responsive img-circle img-thumbnail" alt = "avatar" >
                ';}else{
                        echo' <img src = "http://localhost/ODCS/acfiles/img/doctor.png" class="avatar img-responsive img-circle img-thumbnail" alt = "avatar" >
                ';
                    }
                    ?>

                </form>
            </div>
        </div>
        <!-- edit form column -->
        <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
            <div hidden class="alert alert-info">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <strong>Info!</strong> Indicates a neutral informative change or action.
             </div>
            <h3>Personal info</h3>
            <?php
            if($atype == 'Patient') {

                echo '
                <input class="form-control" name = "atype" value = "P" type = "hidden" >
                <form class="form-horizontal" role = "form" action = "acfiles/account.php" method = "post" >
                <div class="form-group" >
                    <label class="col-lg-3 control-label" for="comment" > Address:</label >
                    <div class="col-lg-8" >
                    <textarea class="form-control" rows = "5" name = "adr" id = "comment" ></textarea >
                    </div >
                </div >
                <div class="form-group" >
                    <label  class="col-lg-3 control-label"  for="sel1" > Gender:</label >
                    <div class="col-lg-8" >
                    <select class="form-control" name = "g" id = "sel1" >
                        <option > Male</option >
                        <option > Female</option >

                    </select >
                        </div >
                </div >
                <div class="form-group" >
                    <label class="col-lg-3 control-label" > Height:</label >
                    <div class="col-lg-8" >
                        <input class="form-control" value = "" name = "h" type = "text" >
                    </div >
                </div >

                <div class="form-group" >
                    <label class="col-lg-3 control-label" > Weight:</label >
                    <div class="col-lg-8" >
                        <input class="form-control" name = "w" value = "" type = "text" >
                    </div >
                </div >

                <div class="form-group" >
                    <label class="col-lg-3 control-label" > DOB:</label >
                    <div class="col-lg-8" >
                        <input class="form-control" name = "d" value = "dd/mm/yyy" id = "dob" type = "text" >
                    </div >
                </div >

                <div class="form-group" >
                    <label class="col-md-3 control-label" ></label >
                    <div class="col-md-8" >
                        <input type = "submit" class="btn btn-primary" value = "Save Changes" >
                        <span ></span >
                       <a href="http://localhost/ODCS/" class="btn btn-default"  >Cancel</a>

                    </div >
                </div >
            </form >';
            }
                else{

                    echo '
                 <input class="form-control" name = "atype" value = "D" type = "hidden" >
                <form class="form-horizontal" role = "form" action = "acfiles/account.php" method = "post" >
                <div class="form-group" >
                    <label class="col-lg-3 control-label" for="comment" > Address:</label >
                    <div class="col-lg-8" >
                    <textarea class="form-control" rows = "5" name = "adr" id = "comment" ></textarea >
                    </div >
                </div >
                <div class="form-group" >
                    <label  class="col-lg-3 control-label"  for="sel1" > Gender:</label >
                    <div class="col-lg-8" >
                    <select class="form-control" name = "g" id = "sel1" >
                        <option > Male</option >
                        <option > Female</option >

                    </select >
                        </div >
                </div >

 <div class="form-group" >
                    <label class="col-lg-3 control-label" > Experiance:</label >
                    <div class="col-lg-8" >
                        <input class="form-control" name = "ex" value = "" type = "text" >
                    </div >
                </div >
                 <div class="form-group" >
                    <label class="col-lg-3 control-label" > Contact Nor:</label >
                    <div class="col-lg-8" >
                        <input class="form-control" name = "cn" value = "" type = "text" >
                    </div >
                </div >
                 <div class="form-group" >
                    <label class="col-lg-3 control-label" > Hospital Name:</label >
                    <div class="col-lg-8" >
                        <input class="form-control" name = "hn" value = "" type = "text" >
                    </div >
                </div >
                 <div class="form-group" >
                    <label class="col-lg-3 control-label" > Qualification:</label >
                    <div class="col-lg-8" >
                        <input class="form-control" name = "qn" value = "" type = "text" >
                    </div >
                </div >
                <div class="form-group" >
                    <label class="col-lg-3 control-label" for="comment" > Speciality:</label >
                    <div class="col-lg-8" >
                    <textarea class="form-control" rows = "4" name = "sp" id = "comment" ></textarea >
                    <small> Seperates by commas</small>
                    </div >
                </div >

                <div class="form-group" >
                    <label class="col-md-3 control-label" ></label >
                    <div class="col-md-8" >
                        <input type = "submit" class="btn btn-primary" value = "Save Changes" >
                        <span ></span >
                        <a href="http://localhost/ODCS/" class="btn btn-default"  >Cancel</a>
                    </div >
                </div >
            </form ><br>';

            }
            ?>
            <br>
        </div>
    </div>
</div>
<link rel="stylesheet" href="js/datepicker/css/datepicker.css">

<script src="js/datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    // When the document is ready
    $(document).ready(function() {

        $('#dob').datepicker({
            format: "dd/mm/yyyy"
        });

    });

</script>
