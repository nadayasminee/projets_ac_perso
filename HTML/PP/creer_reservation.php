<?php
session_start(); 

if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

$idPassager = $_SESSION["username"];

$connexion = mysqli_connect("localhost", "root", "", "bdd_devoir");
if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idTrajet = $_POST['idTrajet'];
    $idConducteur = $_POST['dConducteur'];
    
    
    $sql = "INSERT INTO reservation (IdPassager, IdConducteur, Etat, IdTrajet) VALUES ('$idPassager', '$idConducteur', 'En attente', '$idTrajet')";
    
    if (mysqli_query($connexion, $sql)) {
        echo "Réservation créée avec succès!";
        header("Location: Recherche.php"); 
        exit();
    } else {
        echo "Erreur: " . $sql . "<br>" . mysqli_error($connexion);
    }
}

mysqli_close($connexion);

