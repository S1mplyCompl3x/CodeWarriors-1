<?php
session_start();
 // Includes Login Script
if(!isset($_SESSION['login_user']) || $_SESSION['login_user_role'] != 2) {
    header("location: ../Portal/index.php");
}
if (isset($_POST["sendmail"])){
include('mailinglist.php');
$email = $_POST["email"];
$message = $_POST["message"];
$title = $_POST["title"];
$result = massmail($email, $message, $title);
if ($result == 1){
echo "Message Sent";
}
else{
echo "try again in a minute";
}
}
?>
    <!DOCTYPE html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Residency Form</title>
        <link rel="icon" href="../../Content/images/FAU_Favicon 1.png">
        <link rel="stylesheet" type="text/css" href="../../Content/ResidencyBundle.css">
        <link rel="stylesheet" href="../../Content/Steps/jquery.steps.css">
        <link rel="stylesheet" href="../../Content/Steps/main.css">
        <link rel="stylesheet" href="../../Content/Steps/normalize.css">
        <script src="../../Scripts/jquery-2.2.3.min.js" type="text/javascript"></script>
        <script src="../../Scripts/ResidencyBundle.js"></script>
        <script src="http://malsup.github.com/jquery.form.js"></script>
        <link rel="stylesheet" type="text/css" href="../../Content/residency-custom-bootstrap.css">
        <!-- The import below does not seem to work 100% unless you include
        the integrity and crossorigin tag -->
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker3.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"> </head>

    <body>
        <!-- BEGINNING Leave this in every page -->
        <header class="banner">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-3">
                        <a href="/" class="header-logo" title="Florida Atlantic University"> <img id="fau-header" class="img-responsive pull-left" src="../../Content/Images/fau-home-logo.png" /> </a>
                    </div>
                </div>
            </div>
        </header>
        <!-- Navigation -->
        <nav id="mainNav" class="navbar navbar-default  navbar-custom">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> Menu<i></i> </button> <a class="navbar-brand" id="navtext" href="#page-top">FAU</a> </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="hidden">
                            <a href="#home"></a>
                        </li>
                        <li class="page-scroll"> <a href="http://fauresidencyapp.byethost9.com">Home</a> </li>
                        <li class="page-scroll">
                            <button type="button" class="btn btn-lg btn-default dropdown-toggle glyphicon glyphicon-user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item">
                                    <?php
                                echo $_SESSION["login_user_email"];
                                ?>
                                </a>
                                <div class="dropdown-divider"></div> <a class="dropdown-item" href="../../Controllers/logout.php">Logout</a> </li>
                    </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
        </nav>
        <!--BEGINNNING OF PAGE-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-0 col-md-offset-2 col-lg-offset-2 toppad">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Admin</strong></h3> </div>
                        <div class="panel-body">
                            <table id="results-table" data-request-url="" data-table-onload-url="../../Controllers/adminData.php" data-modal-header="Edit AIA" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th> Student Name </th>
                                        <th> Z Number </th>
                                        <th> Application Year </th>
                                        <th> Status </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <form method="post">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <input class="form-control" name="email" id="emails" type="text" placeholder="Enter email addresses with space" required>
                            <input class="form-control" name="title" id="title" type="text" placeholder="Enter Subject " required>
                            <h4><center> Write the message you want to be sent to all users below</center></h4>
                            <label for="message">Message:</label>
                            <textarea class="form-control" rows="5" id="message" name="message" required></textarea>
                            <button type="submit" name="sendmail" class="btn btn-primary btn-block btn-large">Send Mail</button>
                        </div>
                    </form>
                </div>
            </div>
            <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript">
                debugger;
                var table = $('#results-table').DataTable({
                    "sAjaxSource": "../../Controllers/adminData.php"
                    , "aoColumns": [{
                        "mData": "STUDENT_NAME"
                    }, {
                        "mData": "Z_NUMBER"
                    }, {
                        "mData": "YEAR"
                    }, {
                        "mData": "STATUS"
                    }]
                });
            </script>
            <script>
                $('#emails').focus().keyup(function () {
                    var str = this.value.replace(/(\w)[\s,]+(\w?)/g, '$1, $2');
                    if (str != this.value) this.value = str;
                });
            </script>
    </body>
