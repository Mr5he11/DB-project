<?php
    //start session
    session_start();

    //require connection configuration php file
    require('../connect.php');

    //create connection object
    $conn = Connection::getConnection();

    //if no user is already logged, redirect to login page
    if(!isset($_SESSION['user'])){
        header('Location: login.php');
    }else{
        //user query in order to take name/surname
        //user selection query
        $user_query = 'SELECT Nome, Cognome, Mail, Amministratore FROM Utenti where Mail=?';

        //fetch user
        $result = $conn->prepare($user_query);
        $result->execute([$_SESSION['user']]);
        $user = $result->fetch();
        $user_name = $user['Nome'];
        $user_surname = $user['Cognome'];
        $admin = $user['Amministratore'];

        //if not admin, redirect to login
        if(!$admin){
            header('Location: ../index.php');
        }

        //fetch movies
        $movie_query = 'SELECT Locandina, Collegamento FROM Film ORDER BY Id DESC LIMIT 3';
        $movies = $conn->query($movie_query);  
    }  
?>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Favero Andrea - xxxxxx, Medana Carlotta - xxxxxx, Sello Stefano - 864851" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>CINEMA - ADMIN</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <!-- LOGO HEADER BEGIN -->
    <div class="navbar navbar-inverse set-radius-zero" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                    <img class="logo" src="assets/img/logo.png" />
                </a>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <!-- MENU SECTION BEGIN -->
    <section class="menu-section">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="index.php" class="menu-top-active">OVERVIEW</a></li>                           
                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">ADD <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="add-admin.php">ADMIN</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="add-movie.php">MOVIE</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">SCHEDULE</a></li>
                                </ul>
                            </li>
                            <li><a href="tab.html">MANAGE USERS</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <?php echo(strtoupper($user_name.' '.$user_surname.' ')); ?> <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="profile.php">USER PROFILE</a></li>
                                    <li class="divider"></li>
                                    <li><a href="exe-logout.php"></i>LOGOUT</a></li>
                                </ul>
                                <!-- /.dropdown-user -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MENU SECTION END-->

    <!-- CONTENT WRAPPER BEGIN -->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">ADMIN DASHBOARD</h4>
                </div>
            </div> 
            <div class="row">

                 <!-- SUCCESSS MESSAGES BEGIN -->

                <?php if(isset($_SESSION['add-movie-success']) && $_SESSION['add-movie-success']){ $_SESSION['add-movie-success'] = FALSE; ?>
                <div class="alert alert-success" >
                        <strong>SUCCESS :</strong> Movie added successfully! :)
                </div>
                <?php } ?>

                <?php if(isset($_SESSION['add-admin-success']) && $_SESSION['add-admin-success']){ $_SESSION['add-admin-success'] = FALSE; ?>
                <div class="alert alert-success" >
                        <strong>SUCCESS :</strong> New admin added successfully! :)
                </div>
                <?php } ?>

                <!-- SUCCESS MESSAGES END -->

            </div>              
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div id="carousel-example" class="carousel slide slide-bdr" data-ride="carousel" style="width: 60%; height: 50%; overflow: hidden;">
                        <div class="carousel-inner">
                            <?php $row = $movies->fetch(); ?>
                            <div class="item active">
                                <a href="<?php echo($row['Collegamento']); ?>" target="_blank">
                                    <img src="<?php echo($row['Locandina']); ?>" alt="" />
                                </a>
                            </div>
                            <?php $row = $movies->fetch(); ?>
                            <div class="item">
                                <a href="<?php echo($row['Collegamento']); ?>" target="_blank">
                                    <img src="<?php echo($row['Locandina']); ?>" alt="" />
                                </a>
                            </div>
                            <?php $row = $movies->fetch(); ?>
                            <div class="item">
                                <a href="<?php echo($row['Collegamento']); ?>" target="_blank">
                                    <img src="<?php echo($row['Locandina']); ?>" alt="" />
                                </a>
                            </div>
                        </div>
                        <!--INDICATORS-->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example" data-slide-to="1"></li>
                            <li data-target="#carousel-example" data-slide-to="2"></li>
                        </ol>
                        <!--PREVIUS-NEXT BUTTONS-->
                        <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->

    <!-- FOOTER SECTION BEGIN -->
    <section class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   &copy; 2018 Cinema Website |<a href="https://sortof430.github.io/" target="_blank"  > Designed by : Stefano Sello </a> 
                </div>
            </div>
        </div>
    </section>
    <!-- FOOTER SECTION END-->
    
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
  
</body>
</html>