<?php

session_start();

$host = 'localhost';
$dbname = 'netland';
$username = 'bit_academy';
$password = 'bit_academy';

// connect to the database...
$db = new PDO("mysql:host=$host;dbname=netland", "bit_academy", "bit_academy");

$query = $db->prepare("SELECT * FROM teams ORDER BY title ASC");
$query->execute();
$teams = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <head>
        <meta charset="UTF-8">
        <title>Mijn Account</title>

        <style>
            body {
                margin: 0;
                font-family: Arial, sans-serif;
                background: #111111;
                color: white;
            }

            header {
                background: #FFE556;
                color: #00BCF0;
                padding: 18px 45px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 4px solid #00BCF0;
                font-size: 17px;
                font-weight: bold;
            }

            header img {
                width: 180px;
            }

            .team-section-title {
                text-align: center;
                margin-top: 40px;
                font-size: 36px;
                color: #00BCF0;
                letter-spacing: 1px;
                text-shadow: 0 0 10px rgba(0, 188, 240, 0.4);
            }

            .team-list {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                gap: 30px;
                padding: 30px 50px;
            }

            .team-card {
                background: #FFE556;
                padding: 22px;
                border-radius: 14px;
                text-align: center;
                border: 3px solid #00BCF0;
                box-shadow: 0 0 20px rgba(0, 188, 240, 0.4);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .team-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 0 30px rgba(0, 188, 240, 0.7);
            }

            .team-card img {
                width: 100%;
                height: 180px;
                object-fit: cover;
                border-radius: 10px;
                margin-bottom: 15px;
                border: 2px solid #00BCF0;
            }

            button {
                background: #00BCF0;
                color: #111111;
                border: none;
                padding: 10px 18px;
                border-radius: 8px;
                font-weight: bold;
                cursor: pointer;
                transition: 0.2s;
            }

            button:hover {
                background: #0095c7;
            }
        </style>
    </head>

<body>

    <header>
        <a href="index.php">
            <img src="images/Team_Select_logo2.png">
        </a>

        <h1>Admin panel</h1>

        <a href="account.php"
            style="background-color: #00BCF0; color: #FFE556; padding: 10px 20px; border-radius: 5px;">
            Account
        </a>
    </header>

    <div class="team-list">
        <?php foreach ($teams as $team): ?>
            <div class="team-card">
                <h2><?php echo htmlspecialchars($team['title']); ?></h2>
                <img src="images/<?php echo htmlspecialchars($team['image']); ?>"
                    alt="<?php echo htmlspecialchars($team['title']); ?>">
                </button>

                <form action="delete_team.php" method="POST">
                    <input type="hidden" name="team_id" value="<?= $team['id'] ?>">
                    <button class="delete-btn" type="submit">Delete Team</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>