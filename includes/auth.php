<?php
session_start();
include 'db.php';

//funzione per controllare se l'utente è loggato
function isLoggedIn() {
    return 
    isset($_SESSION['user_id']);
}

//funzione per registrare un nuovo utente
function register($nome, $email, $password){
    global $conn;
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO utenti (nome, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $passwordHash);
    return $stmt->execute();
}

//funzione per il login
function login($email, $password){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM utenti WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($user = $result->fetch_assoc()) {
        if(password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            return true;
        }
    }
    return false;
}

//funzione per il logout
function logout() {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>