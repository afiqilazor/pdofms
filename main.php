<?php 
    session_start(); 
    include "./connection/check_session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Family</title>
    <link rel="shortcut icon" href="images/fish.ico">

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/general.css" rel="stylesheet">


    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">PDOFMS</a>
            </div>

            <?php

                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }

                $dashboard = "";
                $fish = "";
                $vessel = "";
                $crew = "";
                $path = "";
                $trip = "";
                $catch = "";
                $purchase = "";
                $user = "";
                $payroll = "";
                $parameter = "";
                $profile = "";
                $help = "";
                $active = 'class=active';

                if (strpos($page, 'dashboard') !== false){
                    $dashboard = $active;
                } else if (strpos($page, 'fish') !== false){
                    $fish = $active;
                } else if (strpos($page, 'vessel') !== false){
                    $vessel = $active;
                } else if (strpos($page, 'crew') !== false){
                    $crew = $active;
                } else if (strpos($page, 'path') !== false) {
                    $path = $active;
                } else if (strpos($page, 'trip') !== false){
                    $trip = $active;
                } else if (strpos($page, 'catch') !== false){
                    $catch = $active;
                } else if (strpos($page, 'purchase') !== false){
                    $purchase = $active;
                } else if (strpos($page, 'user') !== false){
                    $user = $active;
                } else if (strpos($page, 'payroll') !== false){
                    $payroll = $active;
                } else if (strpos($page, 'parameter') !== false){
                    $parameter = $active;
                } else if (strpos($page, 'profile') !== false){
                    $profile = $active;
                } else if (strpos($page, 'help') !== false){
                    $help = $active;
                }

            ?>

            <ul class="nav navbar-nav">

                <?php

                    if($_SESSION['user_pd_value']=="1"){
                        echo "
                        <li $dashboard> <a href=\"main.php?page=dashboard\"><b>HOME - Dashboard</b></a></li>
                        <li $user> <a href=\"main.php?page=user_view\">Users</a> </li>
                        <li $fish> <a href=\"main.php?page=fish_view\">Fish Price</a> </li>
                        <li $vessel> <a href=\"main.php?page=vessel_view\">Vessels</a> </li>
                        <li $crew> <a href=\"main.php?page=crew_view\">Crews</a> </li>
                        <li $path> <a href=\"main.php?page=path_view\">Path</a> </li>
                        <li $trip> <a href=\"main.php?page=trip_view\">Trips</a> </li>
                        <li $catch> <a href=\"main.php?page=catch_view\">Catch</a> </li>
                        <li $purchase> <a href=\"main.php?page=purchase_view\">Purchases</a> </li>
                        <li $payroll> <a href=\"main.php?page=payroll_view\">Payroll</a> </li>";
                    } else if ($_SESSION['user_pd_value']=="2") {
                        echo "";
                    } else if ($_SESSION['user_pd_value']=="3"){
                        echo "
                        <li $fish> <a href=\"main.php?page=fish_view\">Fish Price</a> </li>
                        <li $trip> <a href=\"main.php?page=trip_view\">Trips</a> </li>
                        <li $purchase> <a href=\"main.php?page=purchase_view\">Purchases</a> </li>";
                    }

                    
                ?>

            </ul>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li <?php echo $profile ?> ><a href="main.php?page=profile_edit">User: <?php echo $_SESSION['user_fullname']; ?> </a></li>

                    <?php
                        if($_SESSION['user_pd_value']!=3){
                            echo "<li ".$parameter."><a href=\"main.php?page=parameter_view\"><span class=\"glyphicon glyphicon-cog\" aria-hidden=\"true\"></span></a></li>";
                            echo "<li ".$help."><a href=\"main.php?page=help_view\"><span class=\"glyphicon glyphicon-question-sign\" aria-hidden=\"true\"></span></a></li>";
                        }
                    ?>

                    <li><a href="./connection/logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
                </ul>
            </div>

        </div><!-- /.container-fluid -->
    </nav>

</head>

<body>

    <?php

        if(isset($page) && file_exists("./parts/".$page.".php")){
            include "./parts/".$page.".php";
        } else {
            echo "Error 404, page ".$page." not found";
        }

    ?>

    

</body>

</html>
