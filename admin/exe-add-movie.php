<?php

//start session
session_start();

//require admin information
require 'components/prelude.php';

if ($_POST['Titolo'] == "" || $_POST['Regista'] == "" || $_POST['CasaProduzione'] == "" || $_POST['Durata'] == "") {

    //if, bypassed javascript, some fields are empty
    $_SESSION['empty_fields'] = true;
    die();
    header('Location: add-movie.php');

} else {

    //insert query
    //movie information
    $insert_query = 'INSERT INTO Film (Titolo, Regista, Durata, Locandina, Descrizione, Collegamento) VALUES (?,?,?,?,?,?)';
    $result = $conn->prepare($insert_query);
    $result->execute([$_POST['Titolo'], $_POST['Regista'], $_POST['Durata'], $_POST['Locandina'], $_POST['Descrizione'], $_POST['Collegamento']]);

    //select query, in order to fetch film id
    $select = 'SELECT Id FROM Film WHERE Titolo = ? AND Regista = ? AND Durata = ? AND Locandina = ? AND Descrizione = ? AND Collegamento = ?';
    $result_select = $conn->prepare($select);
    $result_select->execute([$_POST['Titolo'], $_POST['Regista'], $_POST['Durata'], $_POST['Locandina'], $_POST['Descrizione'], $_POST['Collegamento']]);
    $movie = $result_select->fetch();

    //generating actors array
    $actors = explode(',', $_POST['Attori']);

    //generating productions array
    $productions = explode(',', $_POST['CasaProduzione']);

    //actors query
    foreach ($actors as &$actor) {
        $insert_actors_query = 'INSERT INTO Attori (Nome, Film) VALUES (?,?)';
        $result_actors = $conn->prepare($insert_actors_query);
        $result_actors->execute([$actor, $movie['Id']]);
    }

    //actors query
    foreach ($productions as &$production) {
        $insert_productions_query = 'INSERT INTO Produzioni (Nome, Film) VALUES (?,?)';
        $result_productions = $conn->prepare($insert_productions_query);
        $result_productions->execute([$production, $movie['Id']]);
    }

    unset($actor);

    //redirect
    $_SESSION['add-movie-success'] = true;
    header('Location: index.php');
}

?>