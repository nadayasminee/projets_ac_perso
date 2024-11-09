<?php
session_start();
$connexion = mysqli_connect("localhost", "root", "", "bdd_devoir");

if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

$email = $_POST['email'];
$password = $_POST['password'];

$requete = "
    (SELECT IdPassager,NomP,adresseP AS email, motdepasseP AS motdepasse, 'passager' AS role FROM passager WHERE adresseP = '$email')
    UNION
    (SELECT IdCond,NomC,adresse AS email, motdepasseC AS motdepasse, 'chauffeur' AS role FROM conducteur WHERE adresse = '$email')
";

$result = mysqli_query($connexion, $requete);

if ($result) {
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['motdepasse'];
        $role = $row['role'];
        

        echo "Le type de la variable \$password est : " . gettype($password) . "<br>";
        echo "Le type de la variable \$storedPassword est : " . gettype($storedPassword) . "<br>";

        echo $password . "<br>" . $storedPassword . "<br>";

        if ($password === $storedPassword) {
            if ($role == 'passager') {
                header("Location: ../comptepassager.php");
                $_SESSION["username"]=$row['IdPassager'];
                $_SESSION["user"]=$row['NomP'];
                $_SESSION['role']=$row['role'];
                exit();
            } elseif ($role == 'chauffeur') {
                header("Location: ../profil_coducteur.php");
                $_SESSION["username"] = $row['IdPassager'];
                $_SESSION["user"]=$row['NomP'];
                $_SESSION['role']=$row['role'];
                
                exit();
            }
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "L'utilisateur n'existe pas.";
    }
} else {
    echo "Erreur de requête : " . mysqli_error($connexion);
}

mysqli_close($connexion);
?>
