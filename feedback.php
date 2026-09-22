<?php

session_start();

$host = 'localhost';
$dbname = 'netland';
$username = 'bit_academy';
$password = 'bit_academy';

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $max_lengths = [
            'image' => 50,
            'title' => 35,
            'description' => 50,
            'afkomst' => 35,
            'leaders' => 35,
            'famous_members' => 100,
            'summary' => 150
        ];

        foreach ($max_lengths as $field => $max) {
            if (empty($_POST[$field])) {
                die("Veld '$field' mag niet leeg zijn.");
            }
            if (strlen($_POST[$field]) > $max) {
                die("Veld '$field' mag maximaal $max tekens bevatten.");
            }
        }

        $stmt = $pdo->prepare("
            INSERT INTO teams (image, title, description, afkomst, leaders, famous_members, summary)
            VALUES (:image, :title, :description, :afkomst, :leaders, :famous_members, :summary)
        ");

        $stmt->execute([
            ':image' => htmlspecialchars($_POST['image']),
            ':title' => htmlspecialchars($_POST['title']),
            ':description' => htmlspecialchars($_POST['description']),
            ':afkomst' => htmlspecialchars($_POST['afkomst']),
            ':leaders' => htmlspecialchars($_POST['leaders']),
            ':famous_members' => htmlspecialchars($_POST['famous_members']),
            ':summary' => htmlspecialchars($_POST['summary'])
        ]);

        header("Location: index.php");
        exit;
    }

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Teams Toevoegen</title>
    <style>
        header {
            background: #F2C200;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid black;
        }
        body {
            text-align: center;
            font-size: 20px;
            background-color: #1F4E78;
            color: #FFFFFF;
            font-family: Arial, sans-serif;
        }
        form {
            margin-top: 30px;
        }
        input, textarea {
            width: 300px;
            padding: 8px;
            margin: 10px 0;
            border-radius: 6px;
            border: none;
        }
        textarea {
            height: 120px;
            resize: none;
        }
        button {
            padding: 10px 20px;
            background: #F2C200;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
        }
        button:hover {
            background: #d4a600;
        }
    </style>
</head>
<body>

<header>
    <a href="index.php">
        <img src="images/Team_Select_logo2.png" alt="Team Select Logo" style="width: 180px; border-radius: 8px;">
    </a>
</header>

<h1>Teams toevoegen</h1>

<form method="POST">

    <label>Afbeelding (bestandsnaam)</label><br>
    <input type="text" name="image" maxlength="150" placeholder="bijv. cobra-kai.jpg"><br>

    <label>Titel</label><br>
    <input type="text" name="title" maxlength="100"><br>

    <label>Beschrijving</label><br>
    <input type="text" name="description" maxlength="255"><br>

    <label>Afkomst</label><br>
    <input type="text" name="afkomst" maxlength="100"><br>

    <label>Leiders</label><br>
    <textarea name="leaders" maxlength="500"></textarea><br>

    <label>Beroemde leden</label><br>
    <input type="text" name="famous_members" maxlength="255"><br>

    <label>Samenvatting</label><br>
    <input type="text" name="summary" maxlength="255"><br>

    <button type="submit">Toevoegen</button>
</form>

</body>
</html>
