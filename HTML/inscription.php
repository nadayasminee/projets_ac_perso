<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inscription</title>
    
    <link rel="stylesheet" type="text/css" href="CSS/style.css"> 
    <link rel="stylesheet" type="text/css" href="CSS/inscription.css"> 
    <link rel="stylesheet" type="text/css" href="CSS/PageAccueil.css"> 
</head>

<body>
    <header id="header">
        <div id="top-header">
            <h1>BEEPBEEP.DZ</h1>
            <button class="show-login"><img src="pictures/user-circle-regular-24.png"></button>
        </div>
        <div id="bottom-header">
           
        </div>
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
                <center><a href="inscription.php">S'inscrire</a></center>
            </div>
        </form>
    </div>

    <div class="overlay"></div>
    <script src="JS/PageAccueil.js"></script>

    <form method="post" action="PP/traitement.php">
        <div class="registration">
            <div class="radio">
                <h1><strong>Inscription</strong></h1>
                <strong><label><input type="radio" id="passagerRadio" name="userType" value="passager"> Passager</label></strong>
                <strong><label><input type="radio" id="chauffeurRadio" name="userType" value="chauffeur"> Chauffeur</label></strong>
            </div> 
            <div id="formulaire">
                <br>
                <input type="text" id="nom" placeholder="Nom" name="nom" required>
                <input type="tel" id="telephone" placeholder="+213 00 00 00 00" name="telephone" required>
                <input type="email" id="email" placeholder="Email" name="email" required>
                <input type="text" id="datenaissance" name="datenaissance" placeholder="Date de naissance" required>
                <input type="password" id="password" placeholder="Mot de passe" name="password" required>
                <div id="chauffeurFields" class="fields">
                    <input type="text" id="datepermis"  placeholder="Date d'obtention du permis" name="datepermis" required>
                    <label for="genre">Genre:</label>
                    <select id="genre" name="genre" required>
                        <option value="homme">Homme</option>
                        <option value="femme">Femme</option>
                    </select>
                </div>
                <div id="voitureFields" class="fields" style="display: none;">
                    <input type="text" id="marque" name="marque" placeholder="Marque de la voiture" required>
                    <input type="text" id="AnneeCircu" name="AnneeCircu" placeholder="Année de Circulation" required>
                </div>
                <button type="submit" class="boutton"> S'inscrire </button><br>
            </div>
        </div>
    </form>

    <script src="JS/inscription.js"></script>
    
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
                    <li><a href="inscription.php">S'inscrire</a></li>
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
