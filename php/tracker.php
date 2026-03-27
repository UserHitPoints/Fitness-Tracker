<?php
session_start();
require_once "db.php";

$user_id = $_SESSION["user_id"];
$datum = date("Y-m-d");

$sql = "INSERT INTO workouts (user_id,datum) VALUES (?,?)";
$sendtodb = $pdo -> prepare($sql);
$sendtodb -> execute([$user_id,$datum]);
$workout_id = $pdo->lastInsertId();

$data = json_decode(file_get_contents('php://input'), true);

$uebung = $data["uebung"] ?? $_POST["uebung"];
$gewicht = $data["gewicht"] ?? $_POST["gewicht"];
$wiederholungen = $data["wiederholungen"] ?? $_POST["wiederholungen"];

$sql = "INSERT INTO workout_sets (workout_id,uebung,gewicht,wiederholungen) VALUES (?,?,?,?)";
$sendtodb = $pdo -> prepare($sql);
$sendtodb->execute([$workout_id, $uebung, $gewicht, $wiederholungen]);
header("Location: ../tracker.html");
?>