<?php

//start session
session_start();

//define page
$_SESSION['page'] = 'add-admin';

//call prelude file (db connection, etc)
require 'components/prelude.php' ;

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
    
    <?php include 'components/header.php'; ?>

    <!-- CONTENT-WRAPPER SECTION BEGIN-->
    <div class="content-wrapper">
         <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">ADD ADMIN</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-body">
                        <div class="alert alert-info text-center">
                            <h3> HI, ADMIN! </h3> 
                            <p>
                                Here, you are free to add any administrator account you like to set in your cinema.
                                Just be sure of the information you insert. 
                                Consider that not everyone should be an admin.
                                Have fun!
                            </p> 
                        </div>

                        <!-- PHP LOGIN ERROR MESSAGE BEGIN -->
                        <?php if(isset($_SESSION['wrong_mail']) && $_SESSION['wrong_mail'] == TRUE){ $_SESSION['wrong_mail'] = FALSE; ?>
                        <div class="alert alert-danger" >
                             <strong>WARNING :</strong> Wrong username or password.
                        </div>
                        <?php } ?>
                        <!-- PHP LOGIN ERROR MESSAGE END -->
                        
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                INSERT NEW ADMIN INFORMATION
                            </div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="exe-signup.php"> 
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
                                    <div id="psw_match">
                                        <?php if(isset($_SESSION['wrong_password_2']) && $_SESSION['wrong_password_2'] == TRUE){ $_SESSION['wrong_password_2'] = FALSE; ?>
                                        <div class="alert alert-danger" >
                                            <strong>WARNING :</strong> The passwords don't match.
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php $_SESSION['admin_flag']=1; ?>
                                    </br>
                                    <button type="submit" class="btn btn-success" id="submit" disabled>Add admin</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->

    <?php include 'components/footer.html'; ?>
    
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

    <!-- CUSTOM PASSWORDS CHECK SCRIPT -->
    <script>
        $('#password, #confirm_password').on('keyup', function () {
            if ($('#password').val() != '' && $('#password').val() != $('#confirm_password').val()) {
                $('#psw_match').html('<div class="alert alert-danger"> <strong>WARNING :</strong> Passwords not matching.</div>');
                $('#submit').prop("disabled",true);
            }else{
                $('#psw_match').html('<div class="alert alert-success"> <strong>OK :</strong> Passwords matching.</div>');
                $('#submit').prop("disabled",false);
            }
        });
    </script>

</body>
</html>