<?php

    //start session
    session_start();

?>
<head>
    <title> Cinema - Sign Up Form </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Dynamic website for database Ca' Foscari course." />
    <meta name="author" content="Favero Andrea - xxxxxx, Medana Carlotta - xxxxxx, Sello Stefano - 864851" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>FREE RESPONSIVE HORIZONTAL ADMIN</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="admin/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="admin/assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>

    <!-- LOGO HEADER BEGIN -->
    <div class="navbar navbar-inverse set-radius-zero" >
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">
                    <img src="admin/assets/img/logo.png" class="logo"/>
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
                    <h4 class="header-line">SIGN UP PAGE</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-body">
                        <!-- PHP LOGIN ERROR MESSAGE BEGIN -->
                        <?php if(isset($_SESSION['wrong_mail']) && $_SESSION['wrong_mail'] == TRUE ) { ?>
                             <strong>WARNING :</strong> Wrong username or password.
                        </div>
                        <?php } ?>
                        <!-- PHP LOGIN ERROR MESSAGE END -->
                    
                        <form role="form" method="POST" action="admin/exe-signup.php"> 
                            <div class="form-group">
                                <label>Enter Name</label>
                                <input class="form-control" type="text" name="Nome"/>
                                <p class="help-block">Enter your first name.</p>
                            </div> 
                            <div class="form-group">
                                <label>Enter Surname</label>
                                <input class="form-control" type="text" name="Cognome"/>
                                <p class="help-block">Enter you surname.</p>
                            </div>                             
                            <div class="form-group">
                                <label>Enter Email</label>
                                <input class="form-control" type="text" name="Mail"/>
                                <p class="help-block">Enter the email you'll use to log into your account.</p>
                            </div>
                            <div class="form-group">
                                <label>Enter Password</label>
                                <input class="form-control" type="password" name="Password" id="password"/>
                                <p class="help-block">Enter your password. Remember that a weak password (less then eight characters) is easier to guess.</p>
                            </div>
                            <div class="form-group">
                                <label>Re-enter Password</label>
                                <input class="form-control" type="password" name="ConfirmPassword" id="confirm_password"/>
                                <p class="help-block">Re-type your password, so we will know that you are shure of it.</p>
                            </div>
                            <?php $_SESSION['admin_flag']=0; ?>
                            <div id="psw_match">
                                <?php if(isset($_SESSION['wrong_password']) && $_SESSION['wrong_password'] == TRUE){ $_SESSION['wrong_password'] = FALSE; ?>
                                <div class="alert alert-danger" >
                                    <strong>WARNING :</strong> The passwords don't match.
                                </div>
                                <?php } ?>
                            </div>
                            </br>
                            <button type="submit" class="btn btn-success">Sign Up</button>
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
    <script src="admin/assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="admin/assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="admin/assets/js/custom.js"></script>

    <!-- CUSTOM PASSWORDS CHECK SCRIPT -->
    <script>
    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() != '' && $('#password').val() != $('#confirm_password').val()) {
            $('#psw_match').html('<div class="alert alert-danger"> <strong>WARNING :</strong> Passwords not matching.</div>');
        }else{
            $('#psw_match').html('<div class="alert alert-success"> <strong>OK :</strong> Passwords matching.</div>');
        }
    });
    </script>

</body>
</html>