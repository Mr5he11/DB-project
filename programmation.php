<?php

    //start session
    session_start();
    $_SESSION['programmation'] = true;
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

    <style>
    

    td {
        padding: 10px;

    }
    </style>
</head>

<?php 
//call prelude file (db connection, etc)
require 'connect.php';

//movie query
$movie_query = "SELECT Distinct f.* FROM Film f JOIN Programmazione p ON f.Id = p.Film;";
$conne = Connection::getConnection();
$movies = $conne->query($movie_query);

//days query
$days_query = "SELECT DISTINCT Giorno FROM Programmazione WHERE Film = ?";
$days = $conne->prepare($days_query);

//hours query
$hours_query = "SELECT Id, Ora, Sala FROM Programmazione WHERE Film = ? AND Giorno = ?";
$hours = $conne->prepare($hours_query);
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

                        <form action="booking.php?film=<?php echo($row_film['Id'])?>" method="post">
                            <!--$days runs the days-->
                            <table>
                            <?php $days->execute([$row_film['Id']]);
                            while($row_day = $days->fetch()) { ?>
                                <tr>
                                <td><b> <?php echo($row_day['Giorno']); ?> </b></td>
                                
                                <!--$hours runs the hours-->
                                <?php $hours->execute([$row_film['Id'], $row_day['Giorno']]); 
                                while($row_hours = $hours->fetch()) { ?>
                                    <td> 
                                    <input type="radio" name="schedule" value="<?php echo($row_hours["Id"].".".$row_hours["Sala"]) ?>" > <?php echo($row_hours['Ora']); ?> </td>
                                <?php } ?>
                                </tr>
                            <?php } ?>                    
                            </table>
                            
                            <div class="form-group">
                                <label>How many seats?</label>
                                <input type="number" name="people" class="form-control">
                            </div>
                            <br>
                            <!-- if you are logged -->
                            <?php if (isset($_SESSION['user'])) { ?>
                                <button type="submit" id="submit" class="btn btn-success">Booking</button>
                            <?php } else { ?>
                            <!-- if you're not logged -->   
                                <div class="col-md-2">
                                    <input type="button" name="login" class="btn btn-success" onclick="window.location.href='admin/login.php'" value="Log In">
                                </div> 
                                <div class="col-md-2">
                                    <input type="button" name="login" class="btn btn-success" onclick="window.location.href='signup.php'" value="Sing Up">
                                </div>
                            <?php } ?>
                        </form>
                        
                        
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

    <script> 

</body>
</html>
            