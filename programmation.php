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
$movie_query = "SELECT * FROM Film f JOIN Programmazione p ON f.Id = p.Id;";
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
        <?php while ($row = $movies->fetch()) { ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <img src=" <?php echo($row['Locandina']); ?>" alt="" width="300">
                    </div>
                    <div class="col-md-5">
                        <!--description of film-->
                        <h2> <?php echo($row['Titolo']); ?> <br></h2>
                        <h4> Regia di: <?php echo($row['Regista']); ?> <br></h4>
                        <h5> <?php echo($row['Descrizione']); ?> </h5>

                        <!--schedule of the film-->
                        <h3><br><br>Orari</h3>
                        <h5><br> <?php echo($row['Giorno']); ?>, <?php echo($row['Ora']); ?> </h5>
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
</body>
            