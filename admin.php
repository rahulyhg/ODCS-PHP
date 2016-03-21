<?php
require('acfiles/config.php');
$admin = new conversation();
$transaction = $admin->sendtransationadmin();
$flag =1;
$adminmmoney = $admin->balance('admin');
?>
<head>
    <title>Admin Panel ODCS'16</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.12.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/w3.css">
    <script type="text/javascript">
        $(function() {
            $('#sel1').change(function(){
                $('.tabl').hide();
                $('#' + $(this).val()).show();
            });
        });
    </script>
</head>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                Current Profit : <?php echo $adminmmoney; ?>Rs
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown " hidden>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Admin
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu" hidden>

                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container-fluid main-container">
    <div class="col-md-12 content">
        <div class="panel panel-default">
            <div class="panel-heading">
                Dashboard
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="sel1">Select Table:</label>
                    <select class="form-control" id="sel1">
                        <option>Select Option</option>
                        <option value="Doctor" >1. Doctor</option>
                        <option value="Patient">2. Patient</option>
                        <option value="Consult">3. Consult Data</option>
                        <option value="Transactions">4. Transcations</option>
                    </select>
                </div>
                <div id="Doctor" class="tabl" hidden>
                Table for doctor
                </div>
                <div id="Patient" class="tabl" hidden>
                   Table for patient
                </div>
                <div id="Consult" class="tabl" hidden>
                    <table class="w3-table w3-striped w3-bordered w3-card-4">
                        <thead>
                        <tr class="w3-blue">
                            <th>User</th>
                            <th>Subject</th>
                            <th>Doctor</th>
                            <th>Status</th>
                            <th>Link</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <?php

                        for ($i = 0; $i < sizeof($admin->adminconsultdata()['subject']); $i++){
                            echo '<tr>
                        <td>'.$admin->adminconsultdata()['pname'][$i].'</td>
                        <td>' . $admin->adminconsultdata()['subject'][$i] . '</td>
                        <td>' . $admin->adminconsultdata()['dname'][$i] . '</td>
                        <td>' . $admin->adminconsultdata()['status'][$i] . '</td>
                        <td>' . $admin->adminconsultdata()['links'][$i] . '</td>

                    </tr>';
                        }
                        ?>
                    </table>
                </div>
                <div id="Transactions" class="tabl" hidden>
                    <table class="w3-table w3-striped w3-bordered w3-card-4">
                        <thead>
                        <tr class="w3-blue">
                            <th>User</th>
                            <th>Transaction ID</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>By</th>
                        </tr>
                        </thead>
                    <?php
                    if($flag !=0 ) {
                        $tid = $transaction['tid'];
                        $typ = $transaction['type'];
                        $amnt = $transaction['amount'];
                        $user = $transaction['user'];
                        $name = $transaction['name'];
                        for ($i = 0; $i < sizeof($tid); $i++) {
                            echo '<tr>
                        <td>'.$user[$i].'</td>
                        <td>' . $tid[$i] . '</td>
                        <td>' . $typ[$i] . '</td>
                        <td>' . $amnt[$i] . '</td>
                        <td>' . $name[$i] . '</td>

                    </tr>';
                        }
                    }
                    ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <footer class="pull-left footer">
        <p class="col-md-12">
        <hr class="divider">
        Copyright &COPY; 2016 <a href="#">ODCS</a>
        </p>
    </footer>
</div>