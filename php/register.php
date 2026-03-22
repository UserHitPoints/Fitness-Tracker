<?php
require_once 'db.php';
$name = $_POST["name"];
$surname = $_POST["surname"];
$email = $_POST["email"];
$passwort = $_POST["passwort"];

$sql = "INSERT INTO users (name,surname,email,passwort) VALUES(?,?,?,?)";
$sendtodb = $pdo -> prepare($sql);
$passwort = password_hash($_POST["passwort"], PASSWORD_DEFAULT);
$sendtodb -> execute([$name,$surname,$email,$passwort]);
header("Location: ../login.html");

?>  