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
    $insert_query = 'INSERT INTO Film (Titolo, Regista, CasaProduzione, Durata, Locandina, Descrizione, Collegamento) VALUES (?,?,?,?,?,?,?)';
    $result = $conn->prepare($insert_query);
    $result->execute([$_POST['Titolo'], $_POST['Regista'], $_POST['CasaProduzione'], $_POST['Durata'], $_POST['Locandina'], $_POST['Descrizione'], $_POST['Collegamento']]);
    $_SESSION['add-movie-success'] = TRUE;
    header('Location: index.php');
}

?>