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
    <title>Inspiratie</title>

    <style>
        body {
            margin: 0;
            background-color: #F9A825;
            font-family: Arial, sans-serif;
        }

        header {
            background: #C62828;
            color: #F9A825;
            padding: 15px 20px;
            border-bottom: 1px solid black;
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 20px;
        }

        header img {
            width: 180px;
            height: auto;
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #C62828;
            margin-top: 20px;
        }

        .team-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
        }

        .information {
            background: #C62828;
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

        h2 {
            color: #F9A825;
        }

        h4 {
            color: #F9A825;
        }

        @media (max-width: 900px) {
            .team-list {
                grid-template-columns: repeat(2, 1fr);
            }

            header img {
                width: 150px;
            }
        }

        @media (max-width: 600px) {
            .team-list {
                grid-template-columns: 1fr;
            }

            header img {
                width: 130px;
            }

            h1 {
                font-size: 20px;
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
    </div>
</header>

<h1>Dit zijn mijn inspiraties voor de styling van de pagina's</h1>

<div class="team-list">

    <div class="information">
        <img src="images/invincible.jpg" alt="Invincible blue suit">
        <h2>Blue Suit Invincible</h2>
        <h4>Start pagina</h4>
    </div>

    <div class="information">
        <img src="images/omniman.jpg" alt="Omni-man">
        <h2>Omni-man</h2>
        <h4>Account aanmaak pagina</h4>
    </div>

    <div class="information">
        <img src="images/Thragg_Invincible_Comics.webp" alt="Thragg">
        <h2>Thragg</h2>
        <h4>Detail pagina</h4>
    </div>

    <div class="information">
        <img src="images/viltrumite.webp" alt="Viltrumite officer">
        <h2>Viltrumite officer</h2>
        <h4>Login pagina</h4>
    </div>

    <div class="information">
        <img src="images/rex.webp" alt="Rex Splode">
        <h2>Rex Splode</h2>
        <h4>Inspiratie pagina</h4>
    </div>

    <div class="information">
        <img src="images/immortal.webp" alt="Immortal">
        <h2>Immortal</h2>
        <h4>Team aanvraag pagina</h4>
    </div>
    
    <div class="information">
        <img src="images/mark.png" alt="Immortal">
        <h2>Emporer Mark</h2>
        <h4>Account pagina</h4>
    </div>

</div>

</body>
</html>
