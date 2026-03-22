<?php
session_start();
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
    $_SESSION["user_id"] = $user["id"];
    header("Location: ../hub.html");

} else {
    echo "passwort  falsch";
}
?>