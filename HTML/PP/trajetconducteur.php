<?php
session_start();

$connexion = mysqli_connect("localhost", "root", "", "bdd_devoir");

if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

$nom = $_SESSION["user"];
$trajet = [];

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $sql_trajet = "
        SELECT p.idPassager, p.nomP, p.DateNP, t.DateD, t.LieuD, t.LieuA, r.idReservation 
        FROM passager p 
        JOIN reservation r ON p.idPassager = r.idPassager
        JOIN trajet t ON r.idTrajet = t.idTrajet
        WHERE t.idTrajet = $id AND r.Etat = 'En attente'
    ";
    $result = mysqli_query($connexion, $sql_trajet);

    if (!$result) {
        die("Erreur de requête : " . mysqli_error($connexion));
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $trajet[] = $row;
    }
}
