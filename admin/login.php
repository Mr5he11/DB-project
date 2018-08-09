<?php

    //start session
    session_start();

    //if user already logged, redirect to homepage
    if(isset($_SESSION['user'])){
        header('Location: index.php');
    }
?>
<head>
    <title> Cinema - Login Form </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Dynamic website for database Ca' Foscari course." />
    <meta name="author" content="Favero Andrea - xxxxxx, Medana Carlotta - xxxxxx, Sello Stefano - 864851" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>FREE RESPONSIVE HORIZONTAL ADMIN</title>
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
                <a class="navbar-brand" href="index.php">
                    <img src="assets/img/logo.png" class="logo"/>
                </a>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->

    <!-- CONTENT-WRAPPER SECTION BEGIN-->
    <div class="content-wrapper">
         <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">LOGIN PAGE</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-body">
                        <!-- PHP LOGIN ERROR MESSAGE BEGIN -->
                        <?php if(isset($_SESSION['wrong_login']) && $_SESSION['wrong_login']){ $_SESSION['wrong_login'] = FALSE; ?>
                        <div class="alert alert-danger" >
                             <strong>WARNING :</strong> Wrong username or password.
                        </div>
                        <?php } ?>
                        <!-- PHP LOGIN ERROR MESSAGE END -->
                        <form role="form" method="POST" action="exe-login.php">                                
                            <div class="form-group">
                                <label>Enter Email</label>
                                <input class="form-control" type="text" name="Mail"/>
                                <p class="help-block">Enter the email you use to log into your account</p>
                            </div>
                            <div class="form-group">
                                <label>Enter Password</label>
                                <input class="form-control" type="password" name="Password"/>
                                <p class="help-block">Enter the password you use to log into your account</p>
                            </div>
                            </br>
                            <button type="submit" class="btn btn-success">Log In</button>
                        </form>
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
