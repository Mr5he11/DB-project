<?php

//start session
session_start();

if (isset($_POST['schedule'])) {
    //call prelude file (db connection, etc)
    require 'connect.php';
    $conn = Connection::getConnection();
    
    // $data[0] -> Id, $data[1] -> Sala 
    $data = $_POST["schedule"];
    $data = explode(".",$data);
    $id_pren = $data[0];
    $room = $data[1];

    echo($id_pren);

    //query seats not available
    $query_seats_booked = "SELECT sum(NumeroPostiPrenotati) as postiPrenotati FROM Prenotazioni JOIN Programmazione ON (ProgrammazioneScelta = Id) WHERE ProgrammazioneScelta = ?";
    $seats_booked = $conn->prepare($query_seats_booked);
    if ($seats_booked->execute([$id_pren])) {
        $row_seats_book = $seats_booked->fetch();
    }

    //query seats
    $query_seats = "SELECT NumeroPosti FROM Sale WHERE Nome=?";
    $seats = $conn->prepare($query_seats);
    $seats->execute([$room]);
    $row_seats = $seats->fetch();

    echo("<br>".$row_seats_book["postiPrenotati"]);

    //seats available
    $seats_available = $row_seats["NumeroPosti"] - $row_seats_book["postiPrenotati"];

    echo("<br>".$row_seats["NumeroPosti"]." ".$seats_available."<br>");

    if ( $seats_available > 0 ) {
        $query_insert("INSERT INTO `Prenotazioni` (`Utente`, `ProgrammazioneScelta`, `NumeroPostiPrenotati`) VALUES ('?', '?', '?');")
    } 



    $film = $_GET['film'];
    echo("prova");


} else {
    $_SESSION['schedule_not_selected'] = true;
    header("Location: programmation.php");
}
?>