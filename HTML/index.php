

<!DOCTYPE html>
<html>
<head>
    <head>
        <meta charset="utf-8">
        <title>Page d'accueil</title>
        <link rel="stylesheet" type="text/css" href="CSS/style.css"> 
       <link rel="stylesheet" type="text/css" href="CSS/searchbar.css"> 
       <link rel="stylesheet" type="text/css" href="CSS/PageAccueil.css"> 
       <link rel="stylesheet" type="text/css" href="CSS/PageAccueil1.css"> 
       <link rel="stylesheet" href="CSS/dropdown-menu.css">
       <script>
        function checkLoggedIn() {
            <?php
            session_start();
            if(!isset($_SESSION['user'])) {
            ?>
                alert("Vous devez d'abord vous connecter pour utiliser la recherche.");
            <?php
            }
            ?>
        }
        function validateForm() {
            const dateInput = document.getElementById('date').value;

            if (!dateInput) {
                alert('Veuillez sélectionner une date.');
                return false;
            }

            const datePattern = /^\d{4}-\d{2}-\d{2}$/;
            if (!datePattern.test(dateInput)) {
                alert('Le format de la date est invalide. Utilisez le format AAAA-MM-JJ.');
                return false;
            }

            const date = new Date(dateInput);
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            if (date < today) {
                alert('La date ne peut pas être dans le passé.');
                return false;
            }

            return true;
        }
    </script>
    </head>
<body>
<?php

if (isset($_SESSION['user'])) {
    $nom = $_SESSION['user'];
    echo '
    <header id="header">
        <div id="top-header">
            <h1>BEEPBEEP.DZ</h1>
            <div class="profile-dropdown">
                <div onclick="toggle()" class="profile-dropdown-btn">
                    <span style="font-weight: 900; color:#eee2de;">' . htmlspecialchars($nom) . '</span>
                    <img src="pictures/user-circle-regular-24.png">
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
        <div id="bottom-header"></div>
    </header>';
} else {
    echo '
    <header id="header">
        <div id="top-header">
            <h1>BEEPBEEP.DZ</h1>
            <button class="show-login"><img src="pictures/user-circle-regular-24.png"></button>
        </div>
        <div id="bottom-header"></div>
    </header>
    <div class="login">
        <div class="close-btn">&times;</div>
        <div class="form">
            <h2>Connexion</h2>
            <form method="post" action="PP/connexion.php">
                <div class="elements">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="elements">
                    <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                </div>
                <div class="elements">
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">Remember me</label>
                </div>
                <div class="elements">
                    <button type="submit" class="bouttonF">Se connecter</button>
                </div>
                <h4>Pas encore inscrit?</h4>
                <center><a href="inscription.php">S\'inscrire</a></center>
            </form>
        </div>
    </div>
    <div class="overlay"></div>
    <script src="JS/PageAccueil.js"></script>';
}
?>

   
<div id="Recherche" onclick="checkLoggedIn()">
    <form method="post" action="Recherche.php" id="search-form" class="search-form">
    <input type="text" name="depart" id="debut" placeholder="Départ">
    <input type="text" name="destination" placeholder="Destination">
    <input type="text" name="date" placeholder="Date">
    <input type="text" name="passager" id="fin" placeholder="Passager">
    <button type="submit" class="button">Rechercher</button>
</form>

    </div>
    <div class="accueil">
        <div class="droite">
            <center>
        <div class="presentation">
            <img src="pictures/pic.jpg">
            <p>We take the time to get to know our members and our partner bus companies. We check reviews, profiles and IDs.
                So you know who you are going to travel with.</p>
        </div>
        <h3>Go everywhere with us</h3></center>
        </div>

        <div class="avis">
            <div class="box1">
            <img src="pictures/IMG_6021.jpg">
            <p>I was looking for a service capable of offering trips!</p>
        </div>
            <div class="box1">
                <p>I was looking for a service capable of offering trips from
                    several companies!</p>
                    <img src="pictures/IMG_6021.jpg">

                </div>
            
            <div class="box1">
                <img src="pictures/IMG_6021.jpg">
                <p>« was looking for a service capable of offering trips from several companies»</p>
                </div>
        </div>

    </div>
    
</div>

    <center>
    <a href="inscription.php">Inscription</a>
</center>
<style>
    .avis p{
    text-align: left;
    Font-family: Dejavu Sans, Arial, Verdana, sans-serif;    
   width: fit-content;
   font-size:larger;
   margin: 20px;
   color:#2b2a4c;
   margin-top: 0;
}
.droite h3{
    color: cornflowerblue;
    Font-family: Dejavu Sans, Arial, Verdana, sans-serif;    
}

.presentation p{
    text-align: left;
    Font-family: Dejavu Sans, Arial, Verdana, sans-serif;    
   width: fit-content;
   margin: 30px;
   font-size: larger;
   color:#2b2a4c;
}

.droite{
    flex-direction: column;
    justify-content: space-evenly;
}

.accueil img{
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.4);
    border-radius: 10%;
}
.presentation img{
    width: 300px;
    height: 250px;
}

.presentation{
    align-items: center;
    display: flex;
    flex-direction: row;
    width: 60%;
    margin-left: -100px;
}

.accueil{
    display: flex;
    margin-top: 50px;
    justify-content:space-evenly ;
    
}
.avis img{
    width: 80px;
    height: 80px;
}
.avis{
    display: flex;
    flex-direction: column;
    margin-right: 100px;
}
.box1{
    display: flex;
    margin-bottom: 20px;

}
</style>
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
