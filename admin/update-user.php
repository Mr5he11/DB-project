<?php

//start session
session_start();

//define page
$_SESSION['page'] = 'update-user';

//call prelude file (db connection, etc)
require 'components/prelude.php' ;

//select user to update
$user = $conn->prepare('SELECT * FROM Utenti WHERE Mail=?');
$user->execute([$_GET['mail']]);
$info = $user->fetch();
$name = $info['Nome'];
$surname = $info['Cognome'];
$mail = $info['Mail'];

if($info['Amministratore'] === 1){
    $_SESSION['user_not_updatable'] = true;
    header('Location: manage-users.php');
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
    
    <?php include 'components/header.php'; ?>

    <!-- CONTENT-WRAPPER SECTION BEGIN-->
    <div class="content-wrapper">
         <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">USER PROFILE</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-body">
                        <div class="alert alert-info text-center">
                            <h3> HI, ADMIN! </h3> 
                            <p>
                                Here you can find all account information of <?php echo($name.' '.$surname) ?>.
                                You are free to change them whenever you want.
                                Have fun!
                            </p> 
                        </div>

                        <!-- PHP LOGIN ERROR MESSAGE BEGIN -->
                        <?php if(isset($_SESSION['wrong_password']) && $_SESSION['wrong_password'] == TRUE){ $_SESSION['wrong_password'] = FALSE; ?>
                        <div class="alert alert-danger" >
                             <strong>WARNING :</strong> Your 'old password' is wrong. Be careful next time!
                        </div>
                        <?php } ?>
                        <!-- PHP LOGIN ERROR MESSAGE END -->
                        
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <?php echo(strtoupper($name.' '.$surname)) ?>'S ACCOUNT INFORMATION
                            </div>
                            <div class="panel-body">
                                <form role="form" method="POST" action="exe-update-profile.php"> 
                                    <div class="form-group">
                                        <label>Current name :</label> <?php echo($name); ?>
                                        <input class="form-control" type="text" name="Nome"/>
                                        <p class="help-block">Feed the input above to change current name</p>
                                    </div> 
                                    <div class="form-group">
                                        <label>Current surname :</label> <?php echo($surname); ?>
                                        <input class="form-control" type="text" name="Cognome"/>
                                        <p class="help-block">Feed the input above to change current surname</p>
                                    </div>                             
                                    <div class="form-group">
                                        <label>Current e-mail :</label> <?php echo($mail); ?>
                                        <input class="form-control" type="text" name="Mail"/>
                                        <p class="help-block">Feed the input above to change current e-mail</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Change Password</label>
                                        <input class="form-control" type="password" name="Password" id="password"/>
                                        <p class="help-block">Feed the input above to change current password. Remember that a weak password (less then eight characters) is easier to guess.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Re-enter new Password</label>
                                        <input class="form-control" type="password" name="ConfirmPassword" id="confirm_password"/>
                                        <p class="help-block">Re-type new password, so we will know that you are shure of it.</p>
                                    </div>
                                    <div id="psw_match">
                                        <?php if(isset($_SESSION['wrong_password_2']) && $_SESSION['wrong_password_2'] == TRUE){ $_SESSION['wrong_password_2'] = FALSE; ?>
                                        <div class="alert alert-danger" >
                                            <strong>WARNING :</strong> The passwords don't match.
                                        </div>
                                        <?php } ?>
                                    </div>
                                    </br>
                                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Save changes</button>
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Confirm</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Enter your old password </label>
                                                        <input class="form-control" type="password" name="OldPassword"/>
                                                        <p class="help-block">In order to grant you no intrusions</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
            }else{
                $('#psw_match').html('<div class="alert alert-success"> <strong>OK :</strong> Passwords matching.</div>');
            }
        });
    </script>

</body>
</html>