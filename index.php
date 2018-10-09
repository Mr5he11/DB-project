<?php

//start session
session_start();

//define page
$_SESSION['page'] = 'home';

//call prelude file (db connection, etc)
require 'connect.php';

//fetch movies
$movie_query = 'SELECT * FROM Film ORDER BY Id DESC LIMIT 3';
$conn = Connection::getConnection();
$movies = $conn->query($movie_query);


?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Favero Andrea - xxxxxx, Medana Carlotta - 863421, Sello Stefano - 864851" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>CINEMA - UTENTE</title>
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

    <?php include 'header.php'; ?>

    <!-- CONTENT WRAPPER BEGIN -->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">HOME CINEMA</h4>
                </div>
            </div>
            
            <?php if(isset($_SESSION['booking']) && $_SESSION['booking'] == true) { ?>
                <div class="alert alert-success" >
                        <strong>SUCCESS:</strong> Successful booking! :)
                </div>
            <?php $_SESSION['booking'] = false; } ?>

            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div id="carousel-example" class="carousel slide slide-bdr" data-ride="carousel" style="width: 60%; height: 50%; overflow: hidden;">
                        <div class="carousel-inner">
                            <?php $row = $movies->fetch();?>
                            <div class="item active">
                                <a href="update-movie.php?movie=<?php echo ($row['Id']); ?>">
                                    <img src="<?php echo ($row['Locandina']); ?>" alt="" />
                                </a>
                            </div>
                            <?php $row = $movies->fetch();?>
                            <div class="item">
                                <a href="update-movie.php?movie=<?php echo ($row['Id']); ?>">
                                    <img src="<?php echo ($row['Locandina']); ?>" alt="" />
                                </a>
                            </div>
                            <?php $row = $movies->fetch();?>
                            <div class="item">
                                <a href="update-movie.php?movie=<?php echo ($row['Id']); ?>">
                                    <img src="<?php echo ($row['Locandina']); ?>" alt="" />
                                </a>
                            </div>
                        </div>
                        <!--INDICATORS-->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example" data-slide-to="1"></li>
                            <li data-target="#carousel-example" data-slide-to="2"></li>
                        </ol>
                        <!--PREVIUS-NEXT BUTTONS-->
                        <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->

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