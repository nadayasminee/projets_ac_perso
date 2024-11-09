<?php
session_start(); 

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION["username"];
$nom=$_SESSION["user"];

$connexion = mysqli_connect("localhost", "root", "", "bdd_devoir");
if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

$sql = "(SELECT NomP, TelP FROM passager WHERE adresseP = '$email')";
$result = mysqli_query($connexion, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nom = $row['NomP'];
    $tel = $row['TelP'];
} else {
    $nom = "Nom inconnu";
    $tel = "Téléphone inconnu";
}