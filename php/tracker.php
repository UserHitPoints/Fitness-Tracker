<?php
session_start();

// Prüfe ob JSON geschickt wurde (offline sync)
$input = json_decode(file_get_contents("php://input"), true);
if ($input) {
    $_POST = $input;
}

require_once "db.php";

$user_id = $_SESSION["user_id"];
$datum = date("Y-m-d");

$sql = "INSERT INTO workouts (user_id,datum) VALUES (?,?)";
$sendtodb = $pdo -> prepare($sql);
$sendtodb -> execute([$user_id,$datum]);
$workout_id = $pdo->lastInsertId();

$uebung = $_POST["uebung"];
$gewicht = $_POST["gewicht"];
$wiederholungen = $_POST["wiederholungen"];

$sql = "INSERT INTO workout_sets (workout_id,uebung,gewicht,wiederholungen) VALUES (?,?,?,?)";
$sendtodb = $pdo -> prepare($sql);
$sendtodb->execute([$workout_id, $uebung, $gewicht, $wiederholungen]);

header("Location: ../tracker.html");
?>