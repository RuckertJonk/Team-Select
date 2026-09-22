<?php

session_start();

$host = 'localhost';
$dbname = 'netland';
$username = 'bit_academy';
$password = 'bit_academy';

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Geen ID opgegeven.");
}

$stmt = $pdo->prepare("SELECT * FROM teams WHERE id = :id");
$stmt->execute(['id' => $_GET['id']]);
$team = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$team) {
    die("Team niet gevonden.");
}

?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($team['title']) ?></title>
    <style>
        header {
            background: #C6C6C6;
            color: #B02025;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid black;
            font-size: 15px;
        }

        body {
            background-image: ;
            text-align: center;
            font-size: larger;
            background-color: #B02025;
            color: #C6C6C6;
        }

        h1 {
            text-align: center;
            font-size: 50px;
            color: #C6C6C6;
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

            <a href=".php"
                style="background-color: #C6C6C6; padding: 10px 20px; border-radius: 5px;">
                
            </a>

        </div>
    </header>
    <h1><?= htmlspecialchars($team['title']) ?></h1>

    <p><strong>Afkomst:</strong> <?= htmlspecialchars($team['afkomst']) ?></p>
    <p><strong>Leiders:</strong> <?= nl2br(htmlspecialchars($team['leaders'])) ?></p>
    <p><strong>Bekende leden:</strong> <?= nl2br(htmlspecialchars($team['famous_members'])) ?></p>
    <p><strong>Samenvatting:</strong> <?= nl2br(htmlspecialchars($team['summary'])) ?></p>

    <form action="join_team.php" method="POST">
    <input type="hidden" name="team_id" value="<?= $team['id'] ?>">
    <button type="submit" style="padding:15px 40px; font-size:30px;">Join</button>
</form>


</body>

</html>