<?php

//start session
session_start();

//require admin information
require 'components/prelude.php';

if ($_POST['Film'] == "" || $_POST['Sala'] == "" || $_POST['Giorno'] == "" || $_POST['Ora'] == "" || $_POST['Prezzo'] == "") {

    //if, bypassed javascript, some fields are empty
    $_SESSION['empty_fields'] = true;
    die();
    header('Location: add-schedule.php');

} else {

    //insert query
    //schedule information
    $insert_query = 'INSERT INTO Programmazione (Film,Sala,Giorno,Ora,Prezzo) VALUES (?,?,?,?,?)';
    $result = $conn->prepare($insert_query);
    $result->execute([$_POST['Film'], $_POST['Sala'], $_POST['Giorno'], $_POST['Ora'], $_POST['Prezzo']]);

    //redirect
    $_SESSION['add-schedule-success'] = true;
    header('Location: index.php');
}

?>