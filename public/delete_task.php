<?php
include '../includes/auth.php';

if(!isLoggedIn()){
    header('Location: login.php');
    exit();
}

include '../includes/db.php';

$task_id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM attivita WHERE id = ?");
$stmt->bind_param("i", $task_id);

if($stmt->execute()){
    header('Location: index.php');
    exit();
} else {
    echo "Errore nell'eliminazione dell'attività.";
}
?>