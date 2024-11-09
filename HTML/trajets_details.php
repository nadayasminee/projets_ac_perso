
<?php include 'PP/lookin.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Inscription</title>
    
    <link rel="stylesheet" type="text/css" href="CSS/style.css"> 
    <link rel="stylesheet" type="text/css" href="CSS/trajets_details.css">
    <link rel="stylesheet" href="CSS/dropdown-menu.css">
    <script>
    function checkLoggedIn() {
            <?php
            session_start();
            if($_SESSION['role']==="chauffeur") {
            ?>
                alert("Vous ne pouvez pas reserver un trajet en tant que conducteur .");
            <?php
            }
            ?>
        }
</script>
</head>
    <body>
    
        <header id="header">
            <div id="top-header">
                <h1>BEEPBEEP.DZ</h1>
                <div class="profile-dropdown">
                
                <div onclick="toggle()" class="profile-dropdown-btn">
                <span style="font-weight: 900; color:#eee2de; "><?php echo $nom; ?></span>
                   
                <img  src="pictures\user-circle-regular-24.png" >
                </div>
        
                <ul class="profile-dropdown-list">
                  <li class="profile-dropdown-list-item">
                    <a href="profil_coducteur.php">
                      <i class="fa-regular fa-user"></i>
                      Profil
                    </a>
                  </li>
        
                  <li class="profile-dropdown-list-item">
                    <a href="index.php">
                      <i class="fa-regular fa-envelope"></i>
                      Accueil
                    </a>
                  </li>
        
                 
                  <hr />
        
                  <li class="profile-dropdown-list-item">
                    <a href="#">
                      <i class="fa-solid fa-arrow-right-from-bracket"></i>
                      Log out
                    </a>
                  </li>
                </ul>
              </div>
            </nav>
            </div>
            <script>   
         let profileDropdownList = document.querySelector(".profile-dropdown-list");
        let btn = document.querySelector(".profile-dropdown-btn");
        
        let classList = profileDropdownList.classList;
        
        const toggle = () => classList.toggle("active");
        
        window.addEventListener("click", function (e) {
          if (!btn.contains(e.target)) classList.remove("active");
        });
        </script>
        
            <div id="bottom-header">
            </div>
            
        </header>
        
        <center>
            <div class="details-trajet">
            <h1>Details du trajet:</h1>
            <div class="trajet">
                
                <div class="time-date">
                <div class="time">
            <p id="TimeD"><?php echo $heureD->format('H:i'); ?></p>
            <p id="Duree"><?php echo $duration; ?>h</p>
            <p id="timeA"><?php echo $heureA->format('H:i'); ?></p>
        </div>
                <div class="Lieu">
                <b id="depart"><img src="pictures/location_14085606.png"><?php echo $row_trajet['LieuD']; ?></b>
            <b id="arrivee"><img src="pictures/location_14085606.png"><?php echo $row_trajet['LieuA']; ?></b>
        </div>
            </div><div class="last-row">
            <div class="optionss">
            <?php if (in_array("Pas D'arrets", explode(',', $row_trajet['Options']))): ?>
                <img id="direct" src="pictures/right-arrow_12071360.png">
            <?php endif; ?>
            <?php if (in_array('Conducteur Certifié', explode(',', $row_trajet['Options']))): ?>
                <img id="certified" src="pictures/shooting-star_599505.png">
            <?php endif; ?>
            <?php if (in_array('Non Fumeur', explode(',', $row_trajet['Options']))): ?>
                <img id="no-smokin" src="pictures/no-smoking_4264462.png">
            <?php endif; ?>
        </div>
                <p class="Prix"><?php echo $row_trajet['Tarif']; ?>Da</p>
                </div>
            </div>
            </div>
            <div class="details-conducteur">
            
            <div class="Driver">
                <span class="ide"><img src="pictures/car_6289742.png">
                <b id="driver"><?php echo $row['NomC'];?></b><br></span>
                <span class="details">
            <label>Evaluation:</label><p><?php echo generateStars($evaluation);?></p><br>
            <label>Experience:</label><p><?php echo $experience ;?></p><br>
            <label>Cateorie:</label><p><?php echo $categorie;?></p><br>
            <label>Annulation et retard:</label><p><?php echo $totalDelaysAndCancellations;?></p><br>
            <label>Contacter le conducteur:</label><p><?php echo $row['TelC'] ;?></p><br>
        </span> 
                </div>
            <div>

            </div>
            
                <div class="bouttons">
                <form action="" method="POST">
                    <input type="hidden" name="idTrajet" value="<?php echo $row_trajet['IdTrajet']; ?>">
                    <input type="hidden" name="idConducteur" value="<?php echo $row_trajet['IdConducteur']; ?>">

                    <button type="submit" class="boutton" id="reserveButton" onclick="checkLoggedIn()"> Demande de reservation </button>
                </form>                    <div class="barre-vertical"></div>
                    <button type="submit" class="boutton"><a href="Recherche.php" style="text-decoration:none; color:white;">Retour </a></button><br>
                </div>
                <div class="Options">
            <h2>Options:</h2>
            <?php if (in_array("Pas D'arrets", explode(',', $row_trajet['Options']))): ?>
                <p>Trajet direct</p>
            <?php endif; ?>
            <?php if (in_array('Conducteur Certifié', explode(',', $row_trajet['Options']))): ?>
                <p>Conducteur certifié</p>
            <?php endif; ?>
            <?php if (in_array('Non Fumeur', explode(',', $row_trajet['Options']))): ?>
                <p>Interdit de fumer</p>
            <?php endif; ?>
              </div>
            </div>
                
        </center>
    
    </body>  
    <footer id="footer">
        <div class="container">
            <div class="contact">
                <h3>Contactez-nous:</h3>
                <ul>
                    <li><a href="Tel:+999999999"> +99 999 99 999</a></li>
                    <li><a href="mailto:abdefgh@gmail.com">abdefgh@gmail.com</a></li>
                    <li>Sidi Amar Annaba 23000</li>
                </ul>
            </div>
            <div class="links">
                <h3>Autres liens:</h3>
                <ul>
                    <li><a href="#Register">S'inscrire</a></li>
                    <li><a href="#SendMessage">Envoyer un message</a></li>
                    <li><a href="#Whoarewe">Qui sommes-nous</a></li>
                </ul>
            </div>
            <div class="information">
                <h3>Plus d'informations:</h3>
                <ul>
                    <li><a href="#Partners">Nos partenaires</a></li>
                    <li><a href="#Region">Notre région</a></li>
                </ul>
            </div>
        </div>
    </footer>
    
</body>
</html>
<?php

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$idPassager = $_SESSION["username"];

$connexion = mysqli_connect("localhost", "root", "", "bdd_devoir");
if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idTrajet = $_POST['idTrajet'];
    $idConducteur = $_POST['idConducteur'];

    if (empty($idConducteur)) {
        die("L'ID du conducteur est manquant.");
    }

    $sql = "INSERT INTO reservation (IdPassager, IdConducteur, Etat, IdTrajet) VALUES ('$idPassager', '$idConducteur', 'En attente', '$idTrajet')";

    if (mysqli_query($connexion, $sql)) {
        exit();
    } else {
        echo "Erreur: " . $sql . "<br>" . mysqli_error($connexion);
    }
}

mysqli_close($connexion);
?>