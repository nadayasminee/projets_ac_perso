<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>comptepassager</title>
        <link rel="stylesheet" href="CSS/style.css">
        <link rel="stylesheet" href="CSS/comptepassager.css">
        <link rel="stylesheet" href="CSS/dropdown-menu.css">


    </head>
    <body>
    <header id="header">
    <div id="top-header">
        <h1>BEEPBEEP.DZ</h1>
        <div class="profile-dropdown">
        
        <div onclick="toggle()" class="profile-dropdown-btn">
        <span style="font-weight: 900; color:#eee2de; "><?php
        session_start();
        $nom=$_SESSION['user'];
        echo $nom; ?></span>
           
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
            <a href="PP/logout.php">
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
    
        <div class="containerr">
        <div class="formulaire">
            <h3>Mon profil:</h3>
            <?php 

            if (!isset($_SESSION["username"])) {
                header("Location: index.php");
                exit();
            }

            
            $idP = $_SESSION["username"];
            
            
            $connexion = mysqli_connect("localhost", "root", "", "bdd_devoir");
            if (!$connexion) {
                die("La connexion à la base de données a échoué : " . mysqli_connect_error());
            }

           

            $sql = "(SELECT NomP, TelP,adresseP FROM passager WHERE IdPassager = '$idP')";
            $result = mysqli_query($connexion, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $nom = $row['NomP'];
                $tel = $row['TelP'];
                $email= $row['adresseP'];
            } else {
                $nom = "Nom inconnu";
                $tel = "Téléphone inconnu";
                $email="inconnu";
            }
            $sql_trajet = $sql_trajets = "
            SELECT t.*, r.Etat
            FROM trajet t
            INNER JOIN reservation r ON t.IdTrajet = r.IdTrajet
            WHERE r.IdPassager = '$idP';
        ";
            $result = mysqli_query($connexion, $sql_trajet);

            if (!$result) {
                die("Erreur de requête : " . mysqli_error($connexion));
            }

            mysqli_close($connexion);
            ?>

          
         
            <form >
                <div class="champs">
                    <label>Nom:</label>
                    <input type="text" name="Nom" placeholder="Name" value="<?php echo htmlspecialchars($nom); ?>" readonly>
                </div>
                <div class="champs">
                    <label>Tel:</label>
                    <input type="text" name="Tel" placeholder="00000000000" value="<?php echo htmlspecialchars($tel); ?>" readonly>
                </div>
                <div class="champs">
                    <label>Email:</label>
                    <input type="email" name="email" placeholder="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
                </div>
            </form>
        </div>
      <div class="journey">
        <h3>My Journeys</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Depart/Arrival</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['DateD'] . "</td>";
                echo "<td>" . $row['HeureD'] . "</td>";
                echo "<td>" . $row['LieuD'] ."/".$row['LieuA']  . "</td>";
                echo "<td>" . $row['Etat'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
                </table>
                
            </div>
        </div>
              <center>  <a href="recherche.php">Retour à la page de recherche</a>
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
   </html>
   
