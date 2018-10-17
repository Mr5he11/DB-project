<?php

    //start session
    session_start();

    //call prelude file (db connection, etc)
    require 'connect.php';

    //set useful variables
    $_SESSION['booked-shows'] = true;

    //prenotaiton query
    $conn = Connection::getConnection();

    $booked_query = "SELECT f.Titolo, f.Locandina, p.ProgrammazioneScelta, pr.Giorno, pr.Ora, 
                         p.NumeroPostiPrenotati
                         From Film f JOIN Programmazione pr on pr.film=f.id 
                                     JOIN Prenotazioni p on p.ProgrammazioneScelta=pr.id
                         WHERE p.Utente=?";
    $booked = $conn->prepare($booked_query);

    $booked->execute([$_SESSION['user']]);


?>
<html>
<head>
    <title> Cinema - Booked shows</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Dynamic website for database Ca' Foscari course." />
    <meta name="author" content="Favero Andrea - xxxxxx, Medana Carlotta - 863421, Sello Stefano - 864851" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="admin/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="admin/assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <style>
    td {
        padding: 10px;
    }

    .movie-img {
        border: 2px solid black;    }

    </style>
</head>

<body>

    <?php include 'header.php'; ?>

    <!-- CONTENT-WRAPPER SECTION BEGIN-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">YOUR PRENOTATION</h4>
                </div>
            </div>

            <?php if (isset($_SESSION['show-already-booked']) && $_SESSION['show-already-booked']) {$_SESSION['show-already-booked'] = false;?>
                <div class="alert alert-danger" >
                        <strong>WARNING :</strong> You have already booked for this show! :( 
                </div>
            <?php }?>

            <?php if (isset($_SESSION['busy-room']) && $_SESSION['busy-room']) {$_SESSION['busy-room'] = false;?>
                <div class="alert alert-danger" >
                        <strong>WARNING :</strong> This show is full :( Try another one!
                </div>
            <?php }?>

        </div>

        <!--$movies runs the films-->
        <?php while ($row = $booked->fetch()) { ?>
            <div class="container">
                <div class="row">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <?php echo($row['Titolo']); ?> <br>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-5">
                                <img class="movie-img" src=" <?php echo($row['Locandina']); ?>" alt="" width="150">
                            </div>
                            <div class="col-md-5">

                                <!--description of film-->
                                
                                <h4> Spettacolo delle <?php echo($row['Ora']." del giorno ".$row['Giorno']);?></h4>
                                <h6> Posti prenotati: <?php echo($row['NumeroPostiPrenotati']);?></h6>
                                
                                <a role='button' class='btn btn-danger' href="delete-booking.php?programmazione=<?php echo($row['ProgrammazioneScelta']);?>" >Delete booking</a>

                            </div>
                        </div>
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
            