<?php
include '../includes/auth.php';

if(isLoggedIn()){
    header('Location: index.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(login($email, $password)){
        header('Location: index.php');
        exit();
    } else {
        $error = "Credenziali non valide.";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-purple-400">
    <div class="container mx-auto p-4 flex flex-col items-center">
        <h1 class="text-2xl font-bold">Accedi</h1>
        <?php if (isset($error)) echo "<p class='text-red-500'>$error</p>"; ?>

        <form method="POST" class="mt-4 flex flex-col items-center">
            <label for="email">Email:</label>
            <input type="email" name="email" class="border .w-auto p-2 rounded-xl" required>

            <label for="password" class="mt-4">Password:</label>
            <input type="password" name="password" class="border w-auto p-2 rounded-xl" required>

            <button type="submit" class="bg-red-500 text-white block mt-6 p-2">Accedi</button>
        </form>
        <p class="mt-4">Non hai un account? <a href="register.php" class="text-blue-500">Registrati qui</a></p>
    </div>
</body>
</html>