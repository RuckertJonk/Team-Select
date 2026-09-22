<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$pdo = new PDO("mysql:host=localhost;dbname=netland;charset=utf8mb4", "bit_academy", "bit_academy");

$stmt = $pdo->prepare("SELECT * FROM fighters WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (!$user) {
    session_destroy();
    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("
    SELECT teams.* 
    FROM team_members
    JOIN teams ON teams.id = team_members.team_id
    WHERE team_members.fighter_id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$teams = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Mijn Account</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #B31A1D;
            color: white;
        }

        header {
            background: #F2F2F2;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid black;
            font-size: 15px;
        }

        header img {
            width: 180px;
        }

        .account-box {
            max-width: 500px;
            margin: 40px auto;
            background: #C4C4C4;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .account-box h2 {
            margin-bottom: 5px;
        }

        .team-section-title {
            text-align: center;
            margin-top: 40px;
            font-size: 32px;
        }

        .team-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 25px;
            padding: 20px 40px;
        }

        .team-card {
            background: #C4C4C4;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
        }

        .team-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .leave-btn {
            margin-top: 15px;
            padding: 10px 20px;
            background: #cc0000;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        .leave-btn:hover {
            background: #ff0000;
        }
    </style>
</head>

<body>

    <header>
        <a href="index.php">
            <img src="images/Team_Select_logo2.png">
        </a>

        <h1>Als je ingelogt bent dan komt hier je informatie</h1>

        <a href="login.php"
            style="background-color: #C4C4C4; color: #F2F2F2; padding: 10px 20px; border-radius: 5px;">
            Inloggen
        </a>
    </header>

    <div class="account-box">
        <h2><?= $user['username'] ?></h2>
        <p><?= $user['email'] ?></p>
        <p>Aangemaakt op: <?= $user['created_at'] ?></p>
    </div>

    <h1 class="team-section-title">Mijn Team(s)</h1>

    <div class="team-list">
        <?php foreach ($teams as $team): ?>
            <div class="team-card">
                <img src="images/<?= $team['image'] ?>">
                <h2><?= $team['title'] ?></h2>
                <p><?= $team['description'] ?></p>

                <form action="leave_team.php" method="POST">
                    <input type="hidden" name="team_id" value="<?= $team['id'] ?>">
                    <button class="leave-btn" type="submit">Leave Team</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="account-box" style="background-color: #D9D9D9">
        <a href="logout.php"
            style="background-color: #D9D9D9; color: #cc0000; padding: 10px 20px; border-radius: 5px;">
            Logout
        </a>
    </div>

</body>

</html>