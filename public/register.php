<?php
include '../includes/auth.php';

if(isLoggedIn()){
    header('Location: index.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (register($nome, $email, $password)){
        header('Location: login.php');
        exit();
    } else {
        $error = "Errore durante la registrazione.";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-purple-400">
    <div class="container mx-autp p-4 flex flex-col items-center">
        <h1 class="text-2xl font-bold">Registrati</h1>
        <?php if(isset($error)) echo "<p class='text-red-500'>$error</p>"; ?>
        <form method="POST" class="mt-4 flex flex-col items-center">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" class="border w-full p-2 rounded-xl" required>

            <label for="email" class="mt-4">Email:</label>
            <input type="email" name="email" class="border w-full p-2 rounded-xl" required>

            <label for="password" class="mt-4">Password:</label>
            <input type="password" name="password" class="border w-full p-2 rounded-xl" required>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-4 rounded">Registrati</button>
        </form>
        <p class="mt-4">Hai già un account? <a href="login.php" class="text-blue-500">Accedi qui</a></p>
    </div>
</body>
</html>