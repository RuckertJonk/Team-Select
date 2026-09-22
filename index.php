<?php

session_start();

$host = 'localhost';
$dbname = 'netland';
$username = 'bit_academy';
$password = 'bit_academy';

$db = new PDO("mysql:host=localhost;dbname=netland", "bit_academy", "bit_academy");

$query = $db->prepare("SELECT * FROM teams ORDER BY title ASC");
$query->execute();
$teams = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Select</title>

    <style>
        body {
            margin: 0;
            background-image: url('images/star.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
        }

        header {
            background: blue;
            color: black;
            padding: 15px 20px;
            border-bottom: 1px solid black;
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        header img {
            width: 180px;
            height: auto;
            border-radius: 8px;
        }

        header h2 {
            flex: 1;
            text-align: center;
            font-size: 18px;
            min-width: 250px;
        }

        header a {
            background-color: black;
            color: blue;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            white-space: nowrap;
        }

        .team-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
        }

        .team-card {
            background: blue;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .team-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .team-card h2 {
            margin: 10px 0;
            font-size: 22px;
        }

        .details-btn {
            padding: 10px 20px;
            background: black;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        .information {
            background: blue;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .information img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        h1, h4 {
            text-align: center;
        }

        @media (max-width: 900px) {
            .team-list {
                grid-template-columns: repeat(2, 1fr);
            }

            header img {
                width: 150px;
            }

            header h2 {
                font-size: 16px;
            }
        }

        @media (max-width: 600px) {
            .team-list {
                grid-template-columns: 1fr;
            }

            header {
                text-align: center;
            }

            header h2 {
                font-size: 14px;
            }

            header a {
                width: 100%;
                text-align: center;
            }

            .team-card img {
                height: 180px;
            }

            .team-card h2 {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>

<header>
    <div class="header-inner">

        <a href="index.php">
            <img src="images/Team_Select_logo2.png" alt="Team Select Logo">
        </a>

        <h2>Welcome to Team Select — choose your team to train with and begin your journey.</h2>

        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <a href="admin.php">Admin</a>
            <a href="inspiratie.php">Inspiraties</a>
            <a href="feedback.php">Teams toevoegen</a>
        <?php endif; ?>

        <a href="account.php">Account</a>

    </div>
</header>

<div class="team-list">
    <?php foreach ($teams as $team): ?>
        <div class="team-card">
            <img src="images/<?php echo htmlspecialchars($team['image']); ?>" 
                 alt="<?php echo htmlspecialchars($team['title']); ?>">

            <h2><?php echo htmlspecialchars($team['title']); ?></h2>

            <h4><?php echo htmlspecialchars($team['description']); ?></h4>

            <button class="details-btn">
                <a href="details.php?id=<?php echo $team['id']; ?>" style="color:white; text-decoration:none;">
                    Details bekijken
                </a>
            </button>
        </div>
    <?php endforeach; ?>
</div>

<h1 style="color:blue">News</h1>
<h4 style="color:blue">Read the last news from the Multiverse</h4>

<div class="team-list">

    <div class="information">
        <img src="images/mark.png" alt="Invincible">
        <h2>Invincible</h2>
        <h4 style="color:black">The savior of the universe: Emporer Mark</h4>
    </div>

    <div class="information">
        <img src="images/american.jpg" alt="American Psycho">
        <h2>Patrick Bateman</h2>
        <h4 style="color:black">Who is the real Patrick Bateman</h4>
    </div>

    <div class="information">
        <img src="images/Stratton_Oakmont_Logo.png" alt="Wolf Of Wallstreet">
        <h2>Stratton Oakmont</h2>
        <h4 style="color:black">Stratton Oakmont Wants you!</h4>
    </div>

    <div class="information">
        <img src="images/R.jpg" alt="Seven">
        <h2>John Doe</h2>
        <h4 style="color:black">Killer using seven deadly sins found</h4>
    </div>

    <div class="information">
        <img src="images/heisenberg.jpg" alt="Heisenberg">
        <h2>Heisenberg</h2>
        <h4 style="color:black">Heisenberg identitie found: Walter Hartwell White</h4>
    </div>

    <div class="information">
        <img src="images/charlieharper.jpg" alt="Charlie Harper">
        <h2>Charlie Harper</h2>
        <h4 style="color:black">Charlie Harper Death</h4>
    </div>

</div>

</body>
</html>
