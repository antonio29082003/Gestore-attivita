<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$db = "gestore_attivita";

$conn = new mysqli($host, $user, $password, $db);

if($conn->connect_error){
    die('Connessione fallita: ' . $conn->connect_error);
}
?>