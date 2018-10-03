<?php

//start session
session_start();

//define page
$_SESSION['page'] = 'manage-users';

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
                    <h4 class="header-line">MANAGE MOVIES</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info text-center">
                        <h3> HI, ADMIN! </h3> 
                        <p>
                            Here you can delete or modify informations about every movie.
                            Remember that great power leads to great responsability.
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
                            MOVIES :
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <input type="text" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Search for movies...">
                            </div>
                            <br>
                            <ul class="list-group list-group-flush" id="myUL">
                                <?php
                                $movies = $conn->query('SELECT * FROM Film ORDER BY Titolo');
                                while($row = $movies->fetch()){
                                    $title = strtoupper($row['Titolo']);
                                    $id = $row['Id'];
                                    echo('<li class="list-group-item "><a href="update-movie.php?movie='.$id.'">'.$title.'</a></li>');                                }
                                ?>
                            </ul> 
                        </div>

                        <script>
                        function myFunction() {
                            // Declare variables
                            var input, filter, ul, li, a, i;
                            input = document.getElementById('myInput');
                            filter = input.value.toUpperCase();
                            ul = document.getElementById("myUL");
                            li = ul.getElementsByTagName('li');

                            // Loop through all list items, and hide those who don't match the search query
                            for (i = 0; i < li.length; i++) {
                                a = li[i].getElementsByTagName("a")[0];
                                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                    li[i].style.display = "";
                                } else {
                                    li[i].style.display = "none";
                                }
                            }
                        }
                        </script>
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