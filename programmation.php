<?php

    //start session
    session_start();

?>
<head>
    <title> Cinema - Programmation</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Dynamic website for database Ca' Foscari course." />
    <meta name="author" content="Favero Andrea - xxxxxx, Medana Carlotta - 863421, Sello Stefano - 864851" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Programmation</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="admin/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="admin/assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>

<?php 
//call prelude file (db connection, etc)
require 'connect.php';

//movie query
$movie_query = "SELECT f.* FROM Film f JOIN Programmazione p ON f.Id = p.Film;";
$conne = Connection::getConnection();
$movies = $conne->query($movie_query);

?>

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
                    <h4 class="header-line">PROGRAMMATION</h4>
                </div>
            </div>
        </div>
        <!--$movies runs the films-->
        <?php while ($row_film = $movies->fetch()) { ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <img src=" <?php echo($row_film['Locandina']); ?>" alt="" width="300">
                    </div>
                    <div class="col-md-5">
                        <!--description of film-->
                        <h2> <?php echo($row_film['Titolo']); ?> <br></h2>
                        <h4> Regia di: <?php echo($row_film['Regista']); ?> <br></h4>
                        <h5> <?php echo($row_film['Descrizione']); ?><br><br><br> </h5>

                        <div id="myModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Book your seat</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p> ou </p>
                                        <?php
                                        $days_query = "SELECT DISTINCT Giorno FROM Programmazione WHERE Film = ?";
                                        $days = $pdo->prepare($days_query);
                                        $days->execute([$row_film['Id']]); ?>
                                        <p> ou </p>
                                        <!--$days runs the days-->
                                        <?php while($row_day = $days->fetch()) { ?>
                                            <p> <?php echo($row_day['Giorno']); ?> </p>


                                        <?php } ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                                        <button type="button" class="btn btn-primary">Invia</button>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        
                        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Show schedule</button>
                    

                        <!--schedule of the film-->
                        
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <h1><!--lascio una riga vuota--></h1>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php include 'footer.html'; ?> 

    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="admin/assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="admin/assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="admin/assets/js/custom.js"></script>
</body>
</html>
            