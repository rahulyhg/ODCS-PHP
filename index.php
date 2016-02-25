<?php
require("acfiles/dbsettings.php");
$user = $_COOKIE["id"];
if($user != "") {
    $chkacqry = "SELECT * FROM `odcs`.`allusers` WHERE uid='$user'";
    mysqli_select_db($dbhandle, $mysqlidb);
    $result = mysqli_query($dbhandle, $chkacqry) or die("<h2> Somethings Up </h2> <br> <div align=\"center\" style =\"margin:0 auto\" class=\"neutral\"><span></span></div> <br> <br>" . mysqli_error($dbhandle));
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $name = $row['fname'];
    $usern = $row["username"];
    $atype = $row["actp"];
    if ($count == 1){
        $flag =1;
    }else{
        $flag =0;
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
                    <li><a href="#intro">Intro</a></li>
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
                    <li><a href="#intro">Intro</a></li>
                    <li><a href="#services">Consult</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#Modal3" >Update Profile</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#modal2" class="btn btn-blue">PayUp </a></li>
                    <li><a href="acfiles/signout.php"  class="btn btn-red">Sign Out</a></li>
                </ul>
            </div>';}else{
                    echo '            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right main-nav">
                    <li><a href="#intro">Intro</a></li>
                    <li><a href="#services">Consult</a></li>
                    <li><a href="#team">Update Profile</a></li>

                    <li><a href="#" data-toggle="modal" data-target="#modal2" class="btn btn-blue">PayOuts </a></li>
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
                            <h1 class="white typed">It's the only place you have to live.</h1>
                            <span class="typed-cursor">|</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section>
        <div class="cut cut-top"></div>
        <div class="container">
            <div class="row intro-tables">
                <div class="col-md-4">
                    <div class="intro-table intro-table-first">
                        <h5 class="white heading">What we ffer</h5>
                        <div class="owl-carousel owl-schedule bottom">
                            <div class="item">
                                <div class="schedule-row row">
                                    <div class="col-xs-6">
                                        <h5 class="regular white">ghjjghj</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <h5 class="white">sada</h5>
                                    </div>
                                </div>
                                <div class="schedule-row row">
                                    <div class="col-xs-6">
                                        <h5 class="regular white">sdad</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <h5 class="white">sad</h5>
                                    </div>
                                </div>
                                <div class="schedule-row row">
                                    <div class="col-xs-6">
                                        <h5 class="regular white">sadasd</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <h5 class="white">sadasd</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="schedule-row row">
                                    <div class="col-xs-6">
                                        <h5 class="regular white">asdasd</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <h5 class="white">asdas</h5>
                                    </div>
                                </div>
                                <div class="schedule-row row">
                                    <div class="col-xs-6">
                                        <h5 class="regular white">asdasd</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <h5 class="white">asdasd</h5>
                                    </div>
                                </div>
                                <div class="schedule-row row">
                                    <div class="col-xs-6">
                                        <h5 class="regular white">asdasd</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <h5 class="white">sadasd</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="schedule-row row">
                                    <div class="col-xs-6">
                                        <h5 class="regular white">sadas</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <h5 class="white">sadasd</h5>
                                    </div>
                                </div>
                                <div class="schedule-row row">
                                    <div class="col-xs-6">
                                        <h5 class="regular white">asdasd</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <h5 class="white">asdasd</h5>
                                    </div>
                                </div>
                                <div class="schedule-row row">
                                    <div class="col-xs-6">
                                        <h5 class="regular white">Cardio</h5>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <h5 class="white">8:30 - 10:00</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="intro-table intro-table-hover">
                        <h5 class="white heading hide-hover">Premium Membership</h5>
                        <div class="bottom">
                            <h4 class="white heading small-heading no-margin regular">Register Today</h4>
                            <h4 class="white heading small-pt"></h4>
                            <a href="#" class="btn btn-white-fill expand">Register</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="intro-table intro-table-third">
                        <h5 class="white heading">Happy Clients</h5>
                        <div class="owl-testimonials bottom">
                            <div class="item">
                                <h4 class="white heading content">I couldn't be more happy with the results!</h4>
                                <h5 class="white heading light author">Adam Jordan</h5>
                            </div>
                            <div class="item">
                                <h4 class="white heading content">I can't believe how much better I feel!</h4>
                                <h5 class="white heading light author">Greg Pardon</h5>
                            </div>
                            <div class="item">
                                <h4 class="white heading content">Incredible transformation and I feel so healthy!</h4>
                                <h5 class="white heading light author">Christina Goldman</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                        <h4 class="heading">Cardio Training</h4>
                        <p class="description">A elementum ligula lacus ac quam ultrices a scelerisque praesent vel suspendisse scelerisque a aenean hac montes.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service">
                        <div class="icon-holder">
                            <img src="img/icons/guru-blue.png" alt="" class="icon">
                        </div>
                        <h4 class="heading">Yoga Pilates</h4>
                        <p class="description">A elementum ligula lacus ac quam ultrices a scelerisque praesent vel suspendisse scelerisque a aenean hac montes.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service">
                        <div class="icon-holder">
                            <img src="img/icons/weight-blue.png" alt="" class="icon">
                        </div>
                        <h4 class="heading">Power Training</h4>
                        <p class="description">A elementum ligula lacus ac quam ultrices a scelerisque praesent vel suspendisse scelerisque a aenean hac montes.</p>
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
                                <h3 class="white">$69.00</h3>
                                <h5 class="light light-white">1 - 5 sessions / month</h5>
                            </div>
                        </div>
                        <img src="img/team/team3.jpg" alt="Team Image" class="avatar">
                        <div class="title">
                            <h4>Ben Adamson</h4>
                            <h5 class="muted regular">Fitness Instructor</h5>
                        </div>
                        <button data-toggle="modal" data-target="#modal1" class="btn btn-blue-fill">Sign Up Now</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team text-center">
                        <div class="cover" style="background:url('img/team/team-cover2.jpg'); background-size:cover;">
                            <div class="overlay text-center">
                                <h3 class="white">$69.00</h3>
                                <h5 class="light light-white">1 - 5 sessions / month</h5>
                            </div>
                        </div>
                        <img src="img/team/team1.jpg" alt="Team Image" class="avatar">
                        <div class="title">
                            <h4>Eva Williams</h4>
                            <h5 class="muted regular">Personal Trainer</h5>
                        </div>
                        <a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-blue-fill ripple">Sign Up Now</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team text-center">
                        <div class="cover" style="background:url('img/team/team-cover3.jpg'); background-size:cover;">
                            <div class="overlay text-center">
                                <h3 class="white">$69.00</h3>
                                <h5 class="light light-white">1 - 5 sessions / month</h5>
                            </div>
                        </div>
                        <img src="img/team/team2.jpg" alt="Team Image" class="avatar">
                        <div class="title">
                            <h4>John Phillips</h4>
                            <h5 class="muted regular">Personal Trainer</h5>
                        </div>
                        <a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-blue-fill ripple">Sign Up Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="pricing" class="section">
        <div class="container">
            <div class="row title text-center">
                <h2 class="margin-top white">Pricing</h2>
                <h4 class="light white">Choose your favorite pricing plan and sign up today!</h4>
            </div>
            <div class="row no-margin">
                <div class="col-md-7 no-padding col-md-offset-5 pricings text-center">
                    <div class="pricing">
                        <div class="box-main active" data-img="img/pricing1.jpg">
                            <h4 class="white">Yoga Pilates</h4>
                            <h4 class="white regular light">$850.00 <span class="small-font">/ year</span></h4>
                            <a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-white-fill">Sign Up Now</a>
                            <i class="info-icon icon_question"></i>
                        </div>
                        <div class="box-second active">
                            <ul class="white-list text-left">
                                <li>One Personal Trainer</li>
                                <li>Big gym space for training</li>
                                <li>Free tools &amp; props</li>
                                <li>Free locker</li>
                                <li>Free before / after shower</li>
                            </ul>
                        </div>
                    </div>
                    <div class="pricing">
                        <div class="box-main" data-img="img/pricing2.jpg">
                            <h4 class="white">Cardio Training</h4>
                            <h4 class="white regular light">$100.00 <span class="small-font">/ year</span></h4>
                            <a href="#" data-toggle="modal" data-target="#modal1" class="btn btn-white-fill">Sign Up Now</a>
                            <i class="info-icon icon_question"></i>
                        </div>
                        <div class="box-second">
                            <ul class="white-list text-left">
                                <li>One Personal Trainer</li>
                                <li>Big gym space for training</li>
                                <li>Free tools &amp; props</li>
                                <li>Free locker</li>
                                <li>Free before / after shower</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-padded blue-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="owl-twitter owl-carousel">
                        <div class="item text-center">
                            <i class="icon fa fa-twitter"></i>
                            <h4 class="white light">To enjoy the glow of good health, you must exercise.</h4>
                            <h4 class="light-white light">#health #training #exercise</h4>
                        </div>
                        <div class="item text-center">
                            <i class="icon fa fa-twitter"></i>
                            <h4 class="white light">To enjoy the glow of good health, you must exercise.</h4>
                            <h4 class="light-white light">#health #training #exercise</h4>
                        </div>
                        <div class="item text-center">
                            <i class="icon fa fa-twitter"></i>
                            <h4 class="white light">To enjoy the glow of good health, you must exercise.</h4>
                            <h4 class="light-white light">#health #training #exercise</h4>
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
    <div class="modal fade" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-popup">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <iframe src="http://www.w3schools.com"></iframe>
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
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 text-center-mobile">
                    <h3 class="white">Reserve a Free Trial Class!</h3>
                    <h5 class="light regular light-white">Shape your body and improve your health.</h5>
                    <a href="#" class="btn btn-blue ripple trial-button">Start Free Trial</a>
                </div>
                <div class="col-sm-6 text-center-mobile">
                    <h3 class="white">Opening Hours <span class="open-blink"></span></h3>
                    <div class="row opening-hours">
                        <div class="col-sm-6 text-center-mobile">
                            <h5 class="light-white light">Mon - Fri</h5>
                            <h3 class="regular white">9:00 - 22:00</h3>
                        </div>
                        <div class="col-sm-6 text-center-mobile">
                            <h5 class="light-white light">Sat - Sun</h5>
                            <h3 class="regular white">10:00 - 18:00</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row bottom-footer text-center-mobile">
                <div class="col-sm-8">

                </div>
                <div class="col-sm-4 text-right text-center-mobile">
                    <ul class="social-footer">
                        <li><a href="http://www.facebook.com/pages/Codrops/159107397912"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="http://www.twitter.com/codrops"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://plus.google.com/101095823814290637419"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
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
