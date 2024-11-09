<?php include "PP/Publication.php";?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Publish a journey</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css"> 
    <link rel="stylesheet" type="text/css" href="CSS/publiertrajet.css">
    <link rel="stylesheet" href="CSS\dropdown-menu.css">
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
            var form = document.getElementById('formulaire');
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
    <center>
        <form id="formulaire" method="post" action="PP/Publication.php">
            <h2>Publish a journey</h2>
            <input type="hidden" name="IdTrajet" value="<?php echo $trajet['IdTrajet']; ?>">
            <div class="form-row">
                <input name="Date" id="date" type="text" placeholder="Date" value="<?php echo $trajet['DateD']; ?>" required>
                <input type="text" name="Places" placeholder="Places" value="<?php echo $trajet['NbPlaces']; ?>"required>
            </div>
            <div class="form-row">
                <input type="text" name="Departure" placeholder="Departure" style="width: 71%;" value="<?php echo $trajet['LieuD']; ?>"required>
                <input type="time" name="TimeD" placeholder="Time" value="<?php echo $trajet['HeureD']; ?>"required>
            </div>
            <div class="form-row">
                <input type="text" name="Destination" placeholder="Destination" style="width: 71%;" value="<?php echo $trajet['LieuA']; ?>"required>
                <input type="time" name="TimeA" placeholder="Time" value="<?php echo $trajet['HeureA']; ?>"required>
            </div>
            <div class="form-row">
                <input type="text" name="Arret1" placeholder="Stop 1" value="<?php echo $trajet['Arret1']; ?>">
                <input type="text" name="Arret2" placeholder="Stop 2" value="<?php echo $trajet['Arret2']; ?>">
            </div>
            <button type="submit" class="button">Publier</button>
        </form>
        
       
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