<?php 
include '../includes/auth.php';

if(!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

include '../includes/db.php';

//ottenere le attività dell'utente loggato 
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM attivita WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute(); 
$result = $stmt->get_result();
$attivita = $result->fetch_all(MYSQLI_ASSOC)
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le tue attività</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-purple-400">
    <div class="container mx-auto p-4 flex flex-col items-center">
        <h1 class="text-3xl font-bold my-6">Le tue attività</h1>
        <a href="aggiungi_task.php" class="bg-green-500 text-white px-4 py-2 rounded my-2">Aggiungi Attività</a>
        <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded my-2">Logout</a>

        <h2 class="text-xl my-2 font-semibold">Dashboard</h2>
        <ul class="mt-4">
            <?php foreach($attivita as $task): ?>
                <li class="border mb-2 p-4 bg-white rounded-2xl flex flex-col items-center">
                    <h3 class="font-bold">
                        <?= htmlspecialchars($task['titolo']) ?>
                    </h3>
                    <p class="p-2">
                        <?= htmlspecialchars($task['descrizione']) ?>
                    </p>
                    <a href="edit_task.php?id=<?=$task['id'] ?>" class="bg-blue-500  text-white rounded-xl text-sm my-1">Modifica</a>
                    <a href="delete_task.php?id=<?=$task['id'] ?>" class="bg-red-500  text-white rounded-xl text-sm my-1">Elimina</a>
                </li>
                <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>