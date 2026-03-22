<?php
require_once "db.php";
$email = $_POST["email"];
$passwort = $_POST["passwort"];

$sql = "SELECT * FROM users WHERE email = ?";
$sendtodb = $pdo -> prepare($sql);
$sendtodb -> execute([$email]);

$user = $sendtodb->fetch(PDO::FETCH_ASSOC);
if (!$user) {
    echo "User nicht gefunden";
} else if (password_verify($passwort, $user["passwort"])) {
    header("Location: ../hub.html");
} else {
    echo "passwort  falsch";
}
?>