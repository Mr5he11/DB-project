<?php

//start session
session_start();

//define page
$_SESSION['page'] = 'add-room';

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
                    <h4 class="header-line">ADD ROOM</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info text-center">
                        <h3> HI, ADMIN! </h3> 
                        <p>
                            If your Cinema is gettin' bigger (did you build another room? ANOTHER ONE?!) here you have the possibility 
                            to add it to your database. Just remember to insert correct information. Have fun!
                        </p> 
                    </div>
                    <?php if(isset($_SESSION['empty_fields']) && $_SESSION['empty_fields']){ $_SESSION['empty_fields'] = FALSE; ?>
                    <div class="alert alert-danger" >
                            <strong>WARNING :</strong> You forgot to fill some fields. Be carefull next time!
                    </div>
                    <?php } ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            INSERT ROOM INFORMATION
                        </div>
                        <div class="panel-body">
                            <form role="form" action="exe-add-room.php" method="POST">
                                <div class="form-group">
                                    <label>ROOM NAME</label>
                                    <input class="form-control" type="text" name="Nome" required/>
                                    <p class="help-block">Type the name of the room (or a number? Whatever you want)</p>
                                </div>
                                <div class="form-group">
                                    <label>NUMBER OF SEATS</label>
                                    <input class="form-control" type="text" name="NumeroPosti" required/>
                                    <p class="help-block">Enter the number of seats of this room</p>
                                </div>
                                <button type="submit" class="btn btn-info">Add room</button>
                            </form>
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
</body>
</html>