<?php

session_start();

$pdo = new PDO("mysql:host=localhost;dbname=netland;charset=utf8mb4","bit_academy","bit_academy");

$team_id = $_POST['team_id'];

$stmt = $pdo->prepare("DELETE FROM team_members WHERE team_id = ?");
$stmt->execute([$team_id]);

$stmt = $pdo->prepare("DELETE FROM teams WHERE id = ?");
$stmt->execute([$team_id]);

header("Location: admin.php");
exit;
?>
