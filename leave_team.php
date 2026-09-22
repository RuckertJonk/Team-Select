<?php

session_start();

$pdo = new PDO("mysql:host=localhost;dbname=netland;charset=utf8mb4","bit_academy","bit_academy");

$user_id = $_SESSION['user_id'];
$team_id = $_POST['team_id'];

$stmt = $pdo->prepare("DELETE FROM team_members WHERE fighter_id = ? AND team_id = ?");
$stmt->execute([$user_id, $team_id]);

header("Location: account.php");
exit;
?>
