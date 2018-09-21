<?php

//start session
session_start();

//define page
$_SESSION['page'] = 'add-schedule';

//call prelude file (db connection, etc)
require 'components/prelude.php' ;

//I need rooms and films, so lets go!
$query_rooms = 'SELECT * FROM Sale';
$result_rooms = $conn->query($query_rooms);
$query_movies = 'SELECT Titolo, Id FROM Film';
$result_movies = $conn->query($query_movies);

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
                    <h4 class="header-line">ADD SCHEDULE</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info text-center">
                        <h3> HI, ADMIN! </h3> 
                        <p>
                            Here, you have the possibility to add a schedule for the movies you already inserted in the database.
                            Please, pay attention to the date and time format.
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
                            <form role="form" action="exe-add-schedule.php" method="POST">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>MOVIE</label>
                                        <select class="form-control" name="Film" required>
                                            <option></option>
                                            <?php while($row = $result_movies->fetch()){ ?>
                                                <option value="<?php echo($row['Id']); ?>">
                                                    <?php echo($row['Titolo']); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <p class="help-block">Enter the interested movie</p>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>ROOM</label>
                                        <select class="form-control" name="Sala" required>
                                            <option></option>
                                            <?php while($row = $result_rooms->fetch()){ ?>
                                                <option value="<?php echo($row['Nome']); ?>">
                                                    <?php echo($row['Nome']); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <p class="help-block">Enter the room where the film will be projected</p>
                                </div>
                                <div class="form-group ">
                                    <label>DATE</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control" name="Giorno" type="date" required/>
                                    </div>
                                    <p class="help-block">Enter the desidered date (format: MM/DD/YYYY)</p>
                                </div>
                                <div class="form-group">
                                    <label>TIME</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="glyphicon glyphicon-time"></i>
                                        </div>
                                        <input class="form-control" name="Ora" type="time" required/>
                                    </div>
                                    <p class="help-block">Enter the time the film will be projected</p>
                                </div>
                                <div class="form-group ">
                                    <label>PRICE</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="glyphicon glyphicon-usd"></i>
                                        </div>
                                        <input class="form-control" name="Prezzo" type="number" min="1" step="any" required/>
                                    </div>
                                    <p class="help-block">Enter the price for this schedule (format: $$.$$)</p>
                                </div>
                                <button type="submit" class="btn btn-info">Add schedule</button>
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
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>

</body>
</html>