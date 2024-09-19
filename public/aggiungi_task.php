<?php
include '../includes/auth.php';

if(!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

include '../includes/db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $titolo = $_POST['titolo'];
    $descrizione = $_POST['descrizione'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO attivita (titolo, descrizione, user_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $titolo, $descrizione, $user_id);

    if($stmt->execute()){
        header('Location: index.php');
        exit();
    } else {
        echo "Errore nell'aggiunta dell'attività.";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Attività</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-purple-400">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Aggiungi Attività</h1>
        <form method="POST">
            <label class="block mb-2">Titolo:</label>
            <input type="text" name="titolo" class="border px-2 py-1 w-full mb-4" required>
            <label class="block mb-2">Descrizione:</label>
            <textarea name="descrizione" class="border px-2 py-1 w-full mb-4" required></textarea>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Aggiungi</button>
        </form>
        <a href="index.php" class="bg-lime-500 mt-4 text-white rounded inline-block">Torna alla dashboard</a>
    </div>
</body>
</html>