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
                                    <label>MOVIE TITLE</label>
                                    <input class="form-control" type="text" name="Titolo" required/>
                                    <p class="help-block">Type the name of the movie</p>
                                </div>
                                <div class="form-group">
                                    <label>FILM DIRECTOR</label>
                                    <input class="form-control" type="text" name="Regista" required/>
                                    <p class="help-block">Enter one or more film directors, separeted by a comma (,)</p>
                                </div>
                                <div class="form-group">
                                    <label>PRODUCTION COMPANY</label>
                                    <input class="form-control" type="text" name="CasaProduzione" required/>
                                    <p class="help-block">Enter one or more production companies, separeted by a comma (,)</p>
                                </div>
                                <div class="form-group">
                                    <label>DURATION</label>
                                    <input class="form-control" type="text" name="Durata" required/>
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
                                <div class="form-group">
                                    <label>ACTORS</label>
                                    <textarea class="form-control" rows="3" name="Attori"></textarea>
                                    <p class="help-block">Enter a list of the main actors, each item should be separated from the others by a comma (example: Mara Maionchi,Fabio Rovazzi,Elton John)</p>
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