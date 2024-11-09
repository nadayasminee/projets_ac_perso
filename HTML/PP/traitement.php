<?php
$connexion = new mysqli("localhost", "root", "", "bdd_devoir");

if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

if(isset($_POST['userType'])) {
    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $datenaissance = $_POST['datenaissance'];
    $role = $_POST['userType'];
    $datenaissance = date("d-m-Y", strtotime($datenaissance));
    if ($role == 'passager') {
        $requete = "INSERT INTO passager (NomP, DateNP, TelP, adresseP, motdepasseP) VALUES ('$nom', '$datenaissance', '$telephone', '$email', '$password')";
    } elseif ($role == 'chauffeur') {
        $datepermis = $_POST['datepermis'];
        $genre = $_POST['genre'];
        $marque = $_POST['marque'];
        $AnneeCircu= $_POST['AnneeCircu'];
        $datepermis = date("d-m-Y", strtotime($datepermis));
        $AnneeCircu=date("Y",strtotime($AnneeCircu));
        $requete = "INSERT INTO conducteur (NomC, DateNC, TelC, adresse, motdepasseC, DatePermis, Genre, marqueV,AnneeCircu ) VALUES ('$nom', '$datenaissance', '$telephone', '$email', '$password', '$datepermis',  '$genre', '$marque', '$AnneeCircu')";
    }

    if (isset($requete) && mysqli_query($connexion, $requete)) {
        $redirectUrl = '';
        if ($role == 'passager') {
            $redirectUrl = 'comptepassager.php'; 
        } elseif ($role == 'chauffeur') {
            $redirectUrl = 'profil_coducteur.php'; 
        }
    
        if (!empty($redirectUrl)) {
            header("Location: $redirectUrl");
            exit();
        } else {
            echo "Impossible de rediriger l'utilisateur.";
        }
    } else {
        echo "Erreur lors de l'enregistrement.";
    }
    
} else {
    echo "Veuillez sélectionner un type d'utilisateur.";
}

mysqli_close($connexion);

