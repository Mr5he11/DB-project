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
    //modify query
    $update_query = 'UPDATE Film 
                     SET Titolo = ?, Regista = ?, CasaProduzione = ?, Durata = ?, Locandina = ?, Descrizione = ?, Collegamento = ?
                     WHERE Id = ?';
    $result = $conn->prepare($update_query);
    $result->execute([$_POST['Titolo'], $_POST['Regista'], $_POST['CasaProduzione'], $_POST['Durata'], $_POST['Locandina'], $_POST['Descrizione'], $_POST['Collegamento'], $_GET['movie']]);
    
    //generating actors array
    $actors = explode(',', $_POST['Attori']);

    //searching for existing actors records
    $select_actors_query = 'SELECT * FROM Attori WHERE Film=?';
    $result_select_actors = $conn->prepare($select_actors_query);
    $result_select_actors->execute([$_GET['movie']]);

    //generating old actors array
    $actors_old = array();
    while($row = $result_select_actors->fetch()){
        array_push($actors_old, $row['Nome']);
    }

    foreach ($actors as &$actor) {       
        //check presence and insert
        if(!in_array($actor,$actors_old)){
            $insert_actors_query = 'INSERT INTO Attori (Nome, Film) VALUES (?,?)';
            $result_actors = $conn->prepare($insert_actors_query);
            $result_actors->execute([$actor, $_GET['movie']]);
        }
    }

    foreach ($actors_old as &$actor_old){
        //check presence and delete
        if(!in_array($actor_old,$actors)){
            $delete_actors_query = 'DELETE FROM Attori WHERE Nome=? AND Film = ?';
            $result_delete_actors = $conn->prepare($delete_actors_query);
            $result_delete_actors->execute([$actor_old, $_GET['movie']]);
            //die('Hi! I\'m deleting something (I hope)... ;)[DELETED ACTOR] => '.$actor_old);
        }
    }

    unset($actor);
    unset($actor_old);

    $_SESSION['update-movie-success'] = TRUE;
    header('Location: index.php');
}

?>