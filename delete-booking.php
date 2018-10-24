<?php

    //start session
    session_start();

    //call prelude file (db connection, etc)
    require 'connect.php';


    //set useful variables
    $pr = $_GET['programmazione'];
    $_SESSION['delete-booking']=TRUE;

    //prenotaiton query
    $conn = Connection::getConnection();

    $delete_query = "DELETE from prenotazioni where ProgrammazioneScelta = ? and utente = ?";
    $delete = $conn->prepare($delete_query);
    $delete->execute([$pr,$_SESSION['user']]);
    
    //redirect to the booking-recap page
    header("location: index.php");

?>            