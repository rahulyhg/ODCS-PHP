<?php
include("acfiles/config.php");
if($user != "") {

    $cuser = new transaction();
    $usern = $cuser->currentuserdata()['fname'];
    $atype = $cuser->currentuserdata()['actp'];
    $user = $cuser->currentuserdata()['username'];
    $uid = $cuser->currentuserdata()['uid'];
    $money = $cuser->balance($uid);
    if ($usern == NULL){
        $flag =0;
    }else{
        $flag =1;
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="js/dist/css/bootstrap-select.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="css/w3.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->

    <script src="js/jquery-1.12.0.min.js"></script>
    <script>
        $(".cl").click(function() {
            var val = $(this).html();
            $.post("test.php", {
                v: val
            }, function(data) {
                alert(data);
            });
        });

    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OCDS: Online Doctor Consultancy Service</title>
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
    <link rel="stylesheet" type="text/css" href="css/cardio.css">
</head>

<body>
    <div class="preloader">
        <img src="img/loader.gif" alt="Preloader image">
    </div>
    <nav class="navbar">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img src="img/logo.png" data-active-url="img/logo-active.png" alt=""></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <?php
            if($flag ==  0){
                echo '            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right main-nav">

                    <li><a href="#services">Services</a></li>
                    <li><a href="#team">Top Doctors</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#modal2" class="btn btn-blue">Login</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-green">Sign Up</a></li>
                </ul>
            </div>';
            }else{
                if($atype == "Patient"){
                echo '            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right main-nav">

                    <li><a href="/ODCS/acfiles/consult.php">Consult</a></li>
                    <li><a href="/ODCS/profile.php">Edit Profile</a></li>
                    <li><a href="#header-text" onclick="document.getElementById(\'id01\').style.display=\'block\'">Open Wallet</a>
</li>

                    <li><a href="#" data-toggle="modal" data-target="#modal23" class="btn btn-blue">PayUp Your Balance '.$money.' </a></li>
                    <li><a href="acfiles/signout.php"  class="btn btn-red">Sign Out</a></li>
                </ul>
            </div>';}else{
                    echo '            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right main-nav">

                    <li><a href="/ODCS/acfiles/consult.php">Consult</a></li>
                    <li><a href="/ODCS/profile.php">Edit Profile</a></li>
<li><a href="#header-text" onclick="document.getElementById(\'id01\').style.display=\'block\'">Open Wallet</a>
</li>

                    <li><a href="#" data-toggle="modal" data-target="#modal23" class="btn btn-blue">PayOuts You Got '.$money.' </a></li>
                    <li><a href="acfiles/signout.php"  class="btn btn-red">Sign Out</a></li>
                </ul>
            </div>';

                }
            }
            ?>

            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <header id="intro">
        <div class="container">
            <div class="table">
                <div class="header-text">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3 class="light white">Take care of your body. <?php echo $usern; ?></h3>
                            <h1 class="white typed">Healthy Isn't A Goal. Its a way of living.</h1>
                            <span class="typed-cursor">|</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section id="services" class="section section-padded">
        <div class="container">
            <div class="row text-center title">
                <h2>Services</h2>
                <h4 class="light muted">Achieve the best results with our wide variety of training options!</h4>
            </div>
            <div class="row services">
                <div class="col-md-4">
                    <div class="service">
                        <div class="icon-holder">
                            <img src="img/icons/heart-blue.png" alt="" class="icon">
                        </div>
                        <h4 class="heading">Physiotherapy</h4>
                        <p class="description">Online Physiotherapy training headed By Dr Sankara Acharya MBBS MD Physiotherapy USA</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service">
                        <div class="icon-holder">
                            <img src="img/icons/guru-blue.png" alt="" class="icon">
                        </div>
                        <h4 class="heading">Yoga pilates</h4>
                        <p class="description">Yoga has gained world wide acceptance.Our free yoga pilates will guide  through the enitre process</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service">
                        <div class="icon-holder">
                            <img src="img/icons/weight-blue.png" alt="" class="icon">
                        </div>
                        <h4 class="heading">Power Training</h4>
                        <p class="description">Power gives you vital energy for your daily needs.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="cut cut-bottom"></div>
    </section>
    <section id="team" class="section gray-bg">
        <div class="container">
            <div class="row title text-center">
                <h2 class="margin-top">Top Doctors</h2>
                <h4 class="light muted">Our Top Specialists</h4>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="team text-center">
                        <div class="cover" style="background:url('img/team/team-cover1.jpg'); background-size:cover;">
                            <div class="overlay text-center">
                                <h3 class="white"></h3>
                                <h5 class="light light-white"></h5>
                            </div>
                        </div>
                        <img src="img/team/team3.jpg" alt="Team Image" class="avatar">
                        <div class="title">
                            <h4>Dr. Aswin Augustine</h4>
                            <h5 class="muted regular">Yoga Instructor</h5>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team text-center">
                        <div class="cover" style="background:url('img/team/team-cover2.jpg'); background-size:cover;">
                            <div class="overlay text-center">
                                <h3 class="white"></h3>
                                <h5 class="light light-white"></h5>
                            </div>
                        </div>
                        <img src="img/team/team1.jpg" alt="Team Image" class="avatar">
                        <div class="title">
                            <h4>Dr. Amesh S</h4>
                            <h5 class="muted regular">Physiotherapy</h5>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team text-center">
                        <div class="cover" style="background:url('img/team/team-cover3.jpg'); background-size:cover;">
                            <div class="overlay text-center">
                                <h3 class="white"></h3>
                                <h5 class="light light-white"></h5>
                            </div>
                        </div>
                        <img src="img/team/team2.jpg" alt="Team Image" class="avatar">
                        <div class="title">
                            <h4>Dr. Sebin P Johnson</h4>
                            <h5 class="muted regular">Personal Trainer</h5>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-popup">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <h3 class="white">Sign Up</h3>
                <form action="acfiles/register.php" class="popup-form" method="post">
                    <input type="text" name="fname" class="form-control form-white" placeholder="Full Name">
                    <input type="text" name="email" class="form-control form-white" placeholder="Email Address">
                    <input type="text" name="username" class="form-control form-white" placeholder="User Name">
                    <input type="password" name="passwrd" class="form-control form-white" placeholder="Password">
                    <input class="span2" id="a_type" name="a_type" type="hidden">
                    <div class="dropdown">
                        <button id="dLabel" class="form-control form-white dropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Account Type
                        </button>
                        <ul class="dropdown-menu animated fadeIn" role="menu" aria-labelledby="dLabel">
                            <li onclick="$('#a_type').val('Doctor'); $('#searchForm').submit()" class="animated lightSpeedIn"><a class="cl" href="#">Doctor</a></li>
                            <li onclick="$('#a_type').val('Patient'); $('#searchForm').submit()" class="animated lightSpeedIn"><a class="cl" href="#">Patient</a></li>
                        </ul>
                    </div>

                    <input type="submit" class="btn btn-submit"></input>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-popup">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <h3 class="white">Login</h3>
                <form action="acfiles/login.php" class="popup-form" method="post">
                    <input type="text" name="user" class="form-control form-white" placeholder="User Name">
                    <input type="password" name="pass" class="form-control form-white" placeholder="Password">

                    <button type="submit" class="btn btn-submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal23" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-popup">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <h3 class="white">Amount</h3>
                <form action="acfiles/addmoney.php" class="popup-form" method="post">
                    <input type="text" name="money" class="form-control form-white" placeholder="Enter Amnt">
                    <button type="submit" class="btn btn-submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div id="id01" class="w3-modal w3-card-8">
        <div class="w3-modal-content">
            <div class="w3-container">
                <span onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn">×</span>
                <table class="w3-table w3-striped w3-bordered w3-card-4">
                    <thead>
                    <tr class="w3-blue">
                        <th>Transaction ID</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>By</th>
                    </tr>
                    </thead>

                    <?php
                    if($flag !=0 ) {
                        $tid = $cuser->sendtransation($uid)['tid'];
                        $typ = $cuser->sendtransation($uid)['type'];
                        $amnt = $cuser->sendtransation($uid)['amount'];
                        $name = $cuser->sendtransation($uid)['name'];
                        for ($i = 0; $i < sizeof($tid); $i++) {
                            echo '<tr>
                        <td>' . $tid[$i] . '</td>
                        <td>' . $typ[$i] . '</td>
                        <td>' . $amnt[$i] . '</td>
                        <td>' . $name[$i] . '</td>

                    </tr>';
                        }
                    }
                    ?>

                </table>
            <br>

            </div>

        </div>

    </div>
    <!-- Holder for mobile navigation -->
    <div class="mobile-nav">
        <ul>
        </ul>
        <a href="#" class="close-link"><i class="arrow_up"></i></a>
    </div>

    <!-- Scripts -->

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/typewriter.js"></script>
    <script src="js/jquery.onepagenav.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
