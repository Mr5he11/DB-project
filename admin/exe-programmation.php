<?
//start session
session_start();

//require connection configuration php file
require('../connect.php');

//create connection object
$conn = Connection::getConnection();

//user selection query
$prog_query = 'SELECT DISTINCT f.Titolo, f.Locandina, f.Collegamento FROM Programmazione p JOIN Film f ON p.Film = f.Id';

?>