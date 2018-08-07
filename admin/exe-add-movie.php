<?php

//start session
session_start();

//require connection configuration php file
require('../connect.php');

//create connection object
$conn = Connection::getConnection();

if($_POST['Titolo']=="" || $_POST['Regista']=="" || $_POST['CasaProduzione']=="" || $_POST['Durata']==""){
    //if, bypassed javascript, some fields are empty
    $_SESSION['empty_fields'] = TRUE;
    die();
    header('Location: add-movie.php');
}else{
    //insert query
    //movie information
    $insert_query = 'INSERT INTO Film (Titolo, Regista, CasaProduzione, Durata, Locandina, Descrizione, Collegamento) VALUES (?,?,?,?,?,?,?)';
    $result = $conn->prepare($insert_query);
    $result->execute([$_POST['Titolo'], $_POST['Regista'], $_POST['CasaProduzione'], $_POST['Durata'], $_POST['Locandina'], $_POST['Descrizione'], $_POST['Collegamento']]);

    //select query, in order to fetch film id
    $select = 'SELECT Id FROM Film WHERE Titolo = ? AND Regista = ? AND CasaProduzione = ? AND Durata = ? AND Locandina = ? AND Descrizione = ? AND Collegamento = ?';
    $result_select = $conn->prepare($select);
    $result_select->execute([$_POST['Titolo'], $_POST['Regista'], $_POST['CasaProduzione'], $_POST['Durata'], $_POST['Locandina'], $_POST['Descrizione'], $_POST['Collegamento']]);
    $movie = $result_select->fetch();

    //generating actors array
    $actors = explode(',', $_POST['Attori']);

    //actors query
    foreach ($actors as &$actor) {
        $insert_actors_query = 'INSERT INTO Attori (Nome, Film) VALUES (?,?)';
        $result_actors = $conn->prepare($insert_actors_query);
        $result_actors->execute([$actor, $movie['Id']]);
    }
    
    unset($actor);
    
    //redirect
    $_SESSION['add-movie-success'] = TRUE;
    header('Location: index.php');
}

?>