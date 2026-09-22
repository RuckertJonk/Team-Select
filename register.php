<?php

session_start();

$host = 'localhost';
$dbname = 'netland';
$username = 'bit_academy';
$password = 'bit_academy';

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $check = $pdo->prepare("SELECT id FROM fighters WHERE email = :email");
    $check->execute(['email' => $_POST['email']]);

    if ($check->fetch()) {
        die("Email bestaat al.");
    }

    $stmt = $pdo->prepare("
        INSERT INTO fighters (username, email, password)
        VALUES (:username, :email, :password)
    ");

    $stmt->execute([
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
    ]);

    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account aanmaken</title>
    <style>
        header {
            background: #B31312;
            color: white;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid black;
            font-size: 15px;
        }

        body {
            align-items: center;
            text-align: center;
            font-size: 35px;
            color: #B31312;
        }

        h1 {
            color: #B31312;
            font-weight: 900;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 30px;
            text-shadow: 0 0 10px rgba(179, 19, 18, 0.6);
        }

        input {
            font-size: 20px;
            padding: 10px;
            margin: 10px;
        }

        button {
            font-size: 20px;
            padding: 10px 20px;
            background: #B31312;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        h2 {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <header>
        <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">

            <a href="index.php" style="display: inline-block;">
                <img src="images/Team_Select_logo2.png"
                    alt="Team Select Logo"
                    style="width: 180px; height: auto; border-radius: 8px; cursor: pointer;">
            </a>


            <h2>Welcome to Team Select — first make your account.</h2>


            <a href="login.php"
                style="background-color: #B31312; color: blue; padding: 10px 20px; border-radius: 5px;">
                
            </a>

        </div>
    </header>

    <h1>Account aanmaken</h1>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required> <br>
        <input type="email" name="email" placeholder="Email" required> <br>
        <input type="password" name="password" placeholder="Password" required> <br>
        <button type="submit">Account aanmaken</button>
    </form>
    
    <h2>Toch wel een account?</h2>
    <button><a href="login.php" style="background-color:#B31312; color: white; padding: 10px 20px; border-radius: 5px;">
        Toch Inloggen
    </a></button>
    <br>


</body>
</html>
