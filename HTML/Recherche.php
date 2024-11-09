<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Recherche</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/searchbar.css">
    <link rel="stylesheet" href="CSS/Recherche.css">
    <link rel="stylesheet" href="CSS/dropdown-menu.css">
    <script>
      
        function validateDateFormat(date) {
            var datePattern = /^\d{4}\/(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])$/;
                return datePattern.test(date);
        }

        function validateForm(event) {
            var dateInput = document.getElementById('date').value;

            if (dateInput !== "" && !validateDateFormat(dateInput)) {
                alert("Veuillez entrer une date au format AAAA/MM/JJ.");
                event.preventDefault(); 
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('search-form');
            form.addEventListener('submit', validateForm);
        });
    </script>
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
           
        <img  src="pictures/user-circle-regular-24.png" >
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
    
 
<div id="Recherche" >
        <form method="post" action="Recherche.php" id="search-form" class="search-form">
            <input type="text" name="depart" id="debut" placeholder="Départ">
            <input type="text" name="destination" placeholder="Destination">
            <input type="text" name="date" id="date" placeholder="Date">
            <input type="text" name="passager" id="fin" placeholder="Passager">
            <button type="submit" class="button">Rechercher</button>
        </form>
    </div>

    <div class="contain">

        <div class="criteres">
            <h3>Trier par:</h3>
            <div class="criteres1">
            <form id="tri-form" action="Recherche.php" method="GET">
        <label>Durée du trajet</label><input type="radio" name="tri" value="duree"> <br>
        <label>Date de départ</label><input type="radio" name="tri" value="date"> <br>
        <label>Prix</label><input type="radio" name="tri" value="prix"> <br>
        </form>
                </div>


<hr>
    <h3>Filtres:</h3>
       <div class="criteres2">
       <form id="filtres-form" action="Recherche.php" method="GET">
        <label> Direct</label><input type="checkbox" name="direct" value="1"><br>
        <label> Non fumeur</label><input type="checkbox" name="non_fumeur" value="1"><br>
        <label>Chauffeur certifié</label><input type="checkbox" name="certifie" value="1"> <br>
    </form>
                </div>  
<script>document.getElementById('tri-form').addEventListener('change', function() {
    this.submit();
});

document.getElementById('filtres-form').addEventListener('change', function() {
    this.submit();
});</script>     


</div>
<div class="boxes" id="results">  
<?php
$connexion = mysqli_connect("localhost", "root", "", "bdd_devoir");
if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

$depart = isset($_POST['depart']) ? $_POST['depart'] : '';
$destination = isset($_POST['destination']) ? $_POST['destination'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';
$passager = isset($_POST['passager']) ? $_POST['passager'] : '';

$sql = "SELECT t.*, c.NomC,TIMEDIFF(HeureA, HeureD) AS Duree FROM trajet t INNER JOIN conducteur c ON t.IdConducteur = c.IdCond WHERE 1=1";

if ($depart !== '') {
    $sql .= " AND t.LieuD LIKE '%" .  $depart . "%'";
}
if ($destination !== '') {
    $sql .= " AND t.LieuA LIKE '%" . $destination . "%'";
}
if ($date !== '') {
    $sql .= " AND t.DateD = '" .  $date . "'";
}
if ($passager !== '') {
    $sql .= " AND t.NbPlaces >= " . (int)$passager;
}
$options = [];
if (isset($_GET['direct'])) {
    $options[] = "Pas Darrets";
}
if (isset($_GET['non_fumeur'])) {
    $options[] = "Non Fumeur";
}
if (isset($_GET['certifie'])) {
    $options[] = "Conducteur Certifié";
}


if (!empty($options)) {
    $optionsString = implode("','", $options);
    $sql .= " AND (";
    foreach ($options as $option) {
        $sql .= "FIND_IN_SET('" . $option . "', t.Options)  OR ";    }
    $sql = rtrim($sql, " OR ");
    $sql .= ")";
}



$tri = isset($_GET['tri']) ? $_GET['tri'] : ''; 
switch ($tri) {
    case 'duree':
        $sql .= " ORDER BY Duree";
        break;
    case 'date':
        $sql .= " ORDER BY DateD";
        break;
    case 'prix':
        $sql .= " ORDER BY Tarif";
        break;
    default:
        $sql .= " ORDER BY DateD";
        break;
}

$result = mysqli_query($connexion, $sql);

if (!$result) {
    die("Erreur de requête : " . mysqli_error($connexion));
}


while ($row = mysqli_fetch_assoc($result)) {
    $heureD = new DateTime($row['HeureD']);
    $heureA = new DateTime($row['HeureA']);
    $interval = $heureD->diff($heureA);
    $duration = $interval->days * 24 + $interval->h;

    echo '<div class="trajet" onclick="redirectToDetails(' . $row['IdTrajet'] . ')">'; 
    echo '<div class="time-date">';
    echo '<div class="time">';
    echo '<p class="DateDepart" id="TimeD">' . $heureD->format('h:i') . '</p>';
    echo '<p class="Duree" id="Duree">' . $duration . 'h' . '</p>';
    echo '<p id="timeA">' . $heureA->format('h:i') . '</p>';
    echo '</div>';
    echo '<div class="Lieu">';
    echo '<b id="depart"><img src="pictures/location_14085606.png">' . $row['LieuD'] . '</b>';
    echo '<b id="arrivee"><img src="pictures/location_14085606.png">' . $row['LieuA'] . '</b>';
    echo '</div>';
    echo '</div>';
    echo '<div class="last-row">';
    echo '<div class="Driver">';
    echo '<img src="pictures/car_6289742.png">';
    echo '<b id="driver">' . $row['NomC'] . '</b>';
    echo '</div>';
    echo '<p class="Prix">' . $row['Tarif'] . 'Da</p>';
    echo '</div>';
    echo '</div>';
}

mysqli_close($connexion);

?>

<script>
    
function redirectToDetails(trajetId) {
    window.location.href = 'trajets_details.php?id=' + trajetId;
}
</script>

  
</div>

</div>

</div> 

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