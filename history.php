<?php
session_start();
require_once "php/db.php";
$user_id = $_SESSION["user_id"];    

$sql = "SELECT workout_sets.*, workouts.datum 
FROM workout_sets 
JOIN workouts ON workout_sets.workout_id = workouts.id 
WHERE workouts.user_id = ?";

$sendtodb = $pdo -> prepare($sql);
$sendtodb->execute([$user_id]);
$workout_sets = $sendtodb->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>History</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/history.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          <link rel="manifest" href="/fitness-tracker1/manifest.json">
    </head>

    <body>

        <nav>
            <a href="hub.php">Zurück zu Hub</a>
            <h1>History</h1>
        </nav>

        <main>
            <div class="card">
                <h2>Übung auswählen</h2>
                <select id="uebung_select">
                <option value="">Übung wählen</option>
                </select>
            </div>

            <div class="card">
            <h2>Gewichtsverlauf</h2>
            <canvas id="gewicht_chart"></canvas>
            </div>
        </main>

        <script> const workoutData = <?php echo json_encode($workout_sets); ?>; </script>
        <script src="js/history.js"></script>
    </body>
</html>