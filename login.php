<?php

session_start();

$host = 'localhost';
$dbname = 'netland';
$username = 'bit_academy';
$password = 'bit_academy';

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $pdo->prepare("SELECT * FROM fighters WHERE email = :email");
    $stmt->execute(['email' => $_POST['email']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("Email bestaat niet.");
    }

    if (!password_verify($_POST['password'], $user['password'])) {
        die("Wachtwoord klopt niet.");
    }

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['logged_in'] = true;

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <style>
        header {
            background: #A0A0A0;
            color: #FFFFFF;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid black;
            font-size: 15px;
        }

        body {
            background-color: #FFFFFF;
            align-items: center;
            text-align: center;
            font-size: 35px;
            color: #A0A0A0;
        }

        h1 {
            color: #A0A0A0;
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
            background: #A0A0A0;
            color: #FFFFFF;
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


            <h2>Welcome to Team Select — first login to your account.</h2>

            <a href="login.php"
                style="background-color: #A0A0A0; padding: 10px 20px; border-radius: 5px;">
                
            </a>

        </div>
    </header>

    <h1>Inloggen</h1>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required> <br>
        <input type="password" name="password" placeholder="Password" required> <br>
        <button type="submit">Inloggen</button>
    </form>

    <h2>Nog geen account?</h2>
    <button><a href="register.php" style="background-color:#A0A0A0; color:#FFFFFF; padding: 10px 20px; border-radius: 5px;">
        Account maken
    </a></button>

</body>

</html>