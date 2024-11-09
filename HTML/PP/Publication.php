<?php
session_start();

$connexion = mysqli_connect("localhost", "root", "", "bdd_devoir");

if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}
$nom=$_SESSION["user"];
$trajet = [];
if(isset($_GET['id'])) { 
    $idTrajet = $_GET['id'];

    $sql_trajet = "SELECT * FROM trajet WHERE IdTrajet = '$idTrajet'";
    $result = mysqli_query($connexion, $sql_trajet);

    if (!$result) {
        die("Erreur de requête : " . mysqli_error($connexion));
    }

    $trajet = mysqli_fetch_assoc($result);
} else {
    
    $trajet = array(
        'IdTrajet' => '',
        'DateD' => '',
        'NbPlaces' => '',
        'LieuD' => '',
        'HeureD' => '',
        'LieuA' => '',
        'HeureA' => '',
        'Arret1' => '',
        'Arret2' => ''
    );
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idTrajet = $_POST['IdTrajet'];
    $date = $_POST['Date'];
    $places = $_POST['Places'];
    $departure = $_POST['Departure'];
    $timeD = $_POST['TimeD'];
    $destination= $_POST['Destination'];
    $timeA = $_POST['TimeA'];
    $arret1 = $_POST['Arret1'];
    $arret2 = $_POST['Arret2'];

    if(isset($_SESSION['username'])) {
        $id_conducteur = $_SESSION['username'];

        if ($idTrajet) {
            // Update existing trip
            $requete = "UPDATE trajet SET LieuD='$departure', LieuA='$destination', HeureD='$timeD', HeureA='$timeA', NbPlaces='$places', Arret1='$arret1', Arret2='$arret2', DateD='$date' WHERE IdTrajet='$idTrajet' AND IdConducteur='$id_conducteur'";
        } else {
            // Insert new trip
            $requete = "INSERT INTO trajet (LieuD, LieuA, HeureD, HeureA, NbPlaces, Tarif, Arret1, Arret2, Options, DateD, IdConducteur) VALUES ('$departure', '$destination', '$timeD', '$timeA', '$places', '0', '$arret1', '$arret2', '', '$date', '$id_conducteur')";
        }

        if (mysqli_query($connexion, $requete)) {
            header("Location: ../profil_coducteur.php");
            exit();
        } else {
            echo "Erreur lors de l'enregistrement : " . mysqli_error($connexion);
        }
    } else {
        echo "Utilisateur non connecté ou ID de conducteur non disponible.";
    }
}
mysqli_close($connexion);
?>