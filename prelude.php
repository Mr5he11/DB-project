<?php 
    session_start();
    require 'connect.php';
    $conn = Connection::getConnection();

    if(isset($_SESSION['user'])){ 
        //user query in order to take name/surname
        //user selection query
        $user_query = 'SELECT * FROM Utenti where Mail=?';

        //fetch user
        $result = $conn->prepare($user_query);
        $result->execute([$_SESSION['user']]);
        $user = $result->fetch();
        $user_name = $user['Nome'];
        $user_surname = $user['Cognome'];
        $user_mail = $user['Mail'];
        $user_psw = $user['Password'];
        $user_salt = $user['Salt'];
        $admin = $user['Amministratore'];

        //if not admin, redirect to login
        if ($admin) {
            header('Location: admin/index.php');
        }
    }else{
        session_destroy();
        header("Location: index.php");
    }
?>