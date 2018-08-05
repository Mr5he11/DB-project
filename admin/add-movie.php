<?php
    //start session
    session_start();

    //if no user is already logged, redirect to login page
    if(!isset($_SESSION['user'])){
        header('Location: login.php');
    }

    //user query in order to take name/surname
    //require connection configuration php file
    require('../connect.php');

    //create connection object
    $conn = Connection::getConnection();

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

?>

<html>
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
                            <li><a href="index.php">OVERVIEW</a></li>                           
                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">ADD <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="add-admin.php">ADMIN</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" class="menu-top-active" href="#">MOVIE</a></li>
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

    <!-- CONTENT-WRAPPER SECTION BEGIN-->
    <div class="content-wrapper">
         <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">ADD MOVIE</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info text-center">
                        <h3> HI, ADMIN! </h3> 
                        <p>
                            Here, you are free to add any movie you like to project in your cinema.
                            Just be sure of the information you insert. 
                            It should be great if you add this film in a schedule now or ever.
                            Have fun!
                        </p> 
                    </div>
                    <?php if(isset($_SESSION['empty_fields']) && $_SESSION['empty_fields']){ $_SESSION['empty_fields'] = FALSE; ?>
                    <div class="alert alert-danger" >
                            <strong>WARNING :</strong> You forgot to fill some fields. Be carefull next time!
                    </div>
                    <?php } ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            INSERT MOVIE INFORMATION
                        </div>
                        <div class="panel-body">
                            <form role="form" action="exe-add-movie.php" method="POST">
                                <div class="form-group">
                                    <label>MOVIE NAME</label>
                                    <input class="form-control" type="text" name="Titolo"/>
                                    <p class="help-block">Type the name of the movie</p>
                                </div>
                                <div class="form-group">
                                    <label>FILM DIRECTOR</label>
                                    <input class="form-control" type="text" name="Regista"/>
                                    <p class="help-block">Enter one or more film directors, separeted by a comma (,)</p>
                                </div>
                                <div class="form-group">
                                    <label>PRODUCTION COMPANY</label>
                                    <input class="form-control" type="text" name="CasaProduzione"/>
                                    <p class="help-block">Enter one or more production companies, separeted by a comma (,)</p>
                                </div>
                                <div class="form-group">
                                    <label>DURATION</label>
                                    <input class="form-control" type="text" name="Durata"/>
                                    <p class="help-block">Enter the duration of the movie, expressed in minutes</p>
                                </div>
                                <div class="form-group">
                                    <label>IMAGE LINK</label>
                                    <input class="form-control" type="text" name="Locandina"/>
                                    <p class="help-block">Enter, if you want, the link of an image representing the movie</p>
                                </div>
                                <div class="form-group">
                                    <label>INFO LINK</label>
                                    <input class="form-control" type="text" name="Collegamento"/>
                                    <p class="help-block">Enter, if you want, the link of a webpage talking about this movie</p>
                                </div>
                                <div class="form-group">
                                    <label>DESCRIPTION</label>
                                    <textarea class="form-control" rows="3" name="Descrizione"></textarea>
                                    <p class="help-block">Enter a short description of the movie</p>
                                </div>
                                <button type="submit" class="btn btn-info">Add movie</button>
                            </form>
                        </div>
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