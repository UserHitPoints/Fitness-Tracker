
<?php
session_start();
require_once "php/db.php";
$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM workouts WHERE user_id = ?";

$sendtodb = $pdo->prepare($sql);
$sendtodb->execute([$user_id]);

$workouts = $sendtodb->fetchAll(PDO::FETCH_ASSOC);

$woche = date("W");
$jahr = date("Y");

$dieseWoche = [];
for ($i = 0; $i < count($workouts); $i++) {
    if (date("W", strtotime($workouts[$i]["datum"])) == $woche
        && date("Y", strtotime($workouts[$i]["datum"])) == $jahr) {
        array_push($dieseWoche, $workouts[$i]);
    }
}

$anzahl = count($dieseWoche);

$streakWochen = 0;
$wochenNummer = (int)date("W");
$jahrnummer = (int)date("Y");

for ($w = 0; $w <= 52; $w++) {
    $checkwoche = $wochenNummer - $w;
    $checkjahr = $jahrnummer;

    if ($checkwoche <= 0) {
        $checkwoche += 52;
        $checkjahr--;
    }

    $trainingsInWoche = 0;
    for ($i = 0; $i < count($workouts); $i++) {
        $datumWoche = (int)date("W", strtotime($workouts[$i]["datum"]));
        $datumJahr = (int)date("Y", strtotime($workouts[$i]["datum"]));
        if ($datumWoche == $checkwoche && $datumJahr == $checkjahr) {
            $trainingsInWoche++;
        }
    }

    if ($trainingsInWoche >= 3) {
        $streakWochen++;
    } else {
        break;
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/hub.css">
    <link rel="manifest" href="/fitness-tracker1/manifest.json">
    </head>

    <body>
        <main>
            <nav>
                <h1 class="header">Beef Cake</h1>
                <a href="login.html">Log Out</a>
            </nav>
       
            <div class="card streak">
                <h2>Streak</h2>
                <p class="eyecatcher">
                <?php echo $streakWochen; ?> Wochen </p>
            </div>

            <div class="card progress">
                <h2>Die Woche</h2>
                <p class="eyecatcher"><?php echo $anzahl; ?> / 3 Trainingseinheiten absolviert</p>
            </div>

            <div class="card links">
                <h3>Weiter Zu:</h3>
                <a href="tracker.html" class="link">Tracker</a>
                <a href="history.php" class="link">History</a>
            </div>
        </main>
    </body>
</html>
