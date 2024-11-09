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
if(isset($_GET['id'])) { 
    $idTrajet = $_GET['id'];


    $sql = "SELECT * FROM conducteur WHERE idCond = (SELECT IdConducteur FROM trajet WHERE IdTrajet = $idTrajet)";

    $result = mysqli_query($connexion, $sql);

    if (!$result) {
        die("Erreur de requête : " . mysqli_error($connexion));
    }

    $row = mysqli_fetch_assoc($result);

    $idC=$row['IdCond'];

    $sql_trajet="SELECT * FROM trajet WHERE IdTrajet=$idTrajet ";
    $result_trajet = mysqli_query($connexion, $sql_trajet);
    if (!$result_trajet) {
        die("Erreur de requête :". mysqli_error($connexion));
    }

    $row_trajet = mysqli_fetch_assoc($result_trajet);
    $heureD = new DateTime($row_trajet['HeureD']);
$heureA = new DateTime($row_trajet['HeureA']);
$interval = $heureD->diff($heureA);
$duration = $interval->days * 24 + $interval->h;
    function experience($idC, $connexion) {
        $query = "SELECT c.DateNC, COUNT(t.IdTrajet) AS total_trips 
                    FROM Conducteur c
                    LEFT JOIN Trajet t ON c.IdCond = t.IdConducteur
                    WHERE c.IdCond = $idC";
       $result = mysqli_query($connexion, $query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $birthdate = new DateTime($row['DateNC']);
            $total_trips = $row['total_trips'];
            $age = $birthdate->diff(new DateTime())->y;
    
            $experience = ($age + $total_trips) / 100;
    
            return $experience;
        }
        return 0;
    }
    
    
    $experience = experience($idC, $connexion);
    
    mysqli_close($connexion);
    function evaluationConducteur($idC) {
        $connexion = mysqli_connect("localhost", "root", "", "bdd_devoir");
        if (!$connexion) {
            die("La connexion à la base de données a échoué : " . mysqli_connect_error());
        }
    
    
        $query = "SELECT AVG(Note) AS evaluation FROM Avis WHERE IdTrajet IN (
                    SELECT IdTrajet FROM Trajet WHERE IdConducteur = $idC
                  )";
        $result = mysqli_query($connexion, $query);
        if (!$result) {
            die("Erreur de requête : " . mysqli_error($connexion));
        }
    
        $row = mysqli_fetch_assoc($result);
        $evaluation = $row['evaluation'];
    
        
        mysqli_close($connexion);
    
        return $evaluation;
    }
    
    
    $evaluation = evaluationConducteur($idC);
    
    
    
    function generateStars($rating) {
        
        $fullStars = floor($rating);
    
        $halfStar = $rating - $fullStars;
    
        
        $stars = str_repeat('★', $fullStars);
        if ($halfStar > 0) {
            $stars .= '½';
        }
    
        
        $emptyStars = 5 - $fullStars - ceil($halfStar);
        $stars .= str_repeat('☆', $emptyStars);
    
        return $stars;
    }
    
    function getCategory($experience) {
        if ($experience < 20) {
            return "Débutant";
        } elseif ($experience >= 20 && $experience < 40) {
            return "Intermédiaire";
        } elseif ($experience >= 40 && $experience < 60) {
            return "Confirmé";
        } elseif ($experience >= 60 && $experience < 80) {
            return "Avancé";
        } elseif ($experience >= 80) {
            return "Expert";
        } else {
            return "Indéfini";
        }
    }
    $categorie = getCategory($experience);
    
    function countDelaysAndCancellations($idC) {
        $connexion = mysqli_connect("localhost", "root", "", "bdd_devoir");
    
        if (!$connexion) {
            die("La connexion à la base de données a échoué : " . mysqli_connect_error());
        }
    
        $query = "SELECT SUM(retardannulation) AS total 
                  FROM Avis 
                  WHERE IdTrajet IN (SELECT IdTrajet FROM Trajet WHERE IdConducteur = $idC)";
    
        $result = mysqli_query($connexion, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalDelaysAndCancellations = $row['total'];
        } else {
            die("Erreur de requête : " . mysqli_error($connexion));
        }
    
        mysqli_close($connexion);
    
        return $totalDelaysAndCancellations;
    }
    
    $totalDelaysAndCancellations = countDelaysAndCancellations($idC);
    
}