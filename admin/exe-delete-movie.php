<?php
session_start();
require 'components/prelude.php';
//get movie-to-delete id
$movie_id = $_GET['movie'];
//delete movie production companies
$delete_prd = 'DELETE FROM Produzioni WHERE Film=?';
$result_prd = $conn->prepare($delete_prd);
$result_prd->execute([$movie_id]);
//delete movie main actors
$delete_act = 'DELETE FROM attori WHERE Film=?';
$result_act = $conn->prepare($delete_act);
$result_act->execute([$movie_id]);
//delete reservation
$delete_rs = 'DELETE FROM prenotazioni WHERE ProgrammazioneScelta in (SELECT id FROM programmazione WHERE Film=?)';
$result_rs = $conn->prepare($delete_rs);
$result_rs->execute([$movie_id]);
//delete movie schedules
$delete_pr = 'DELETE FROM programmazione WHERE Film=?';
$result_pr = $conn->prepare($delete_pr);
$result_pr->execute([$movie_id]);
//delete movie
$delete_mv = 'DELETE FROM film WHERE Id=?';
$result_mv = $conn->prepare($delete_mv);
$result_mv->execute([$movie_id]);

//if success, redirect
if(!$result_pr || !$result_mv){
    die('<h1><b>error:</b> records with movie id = '.$movie_id.' cannot be delated (don\'t ask me why)');
}else{
    $_SESSION['update-movie-success'] = TRUE;
    header('Location: index.php');
}
?>