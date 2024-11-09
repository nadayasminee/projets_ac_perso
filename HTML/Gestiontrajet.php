
<?php include 'PP\trajetconducteur.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Publish a journey</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <link rel="stylesheet" type="text/css" href="CSS/Gestiontrajey.css"> 
    <link rel="stylesheet" href="CSS\dropdown-menu.css">

</head>
<body>
    <h<header id="header">
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
        <form>
        <h2>Gerer un trajet</h2>
    <h2>Trajet: </h2>
    <table class="table">

    <?php if (isset($trajet) && is_array($trajet)) { ?>
                    <?php if (count($trajet) > 0): ?>
                        <?php foreach ($trajet as $row): ?>
                            <tr>
                                <td><?php echo $row['nomP']; ?></td>
                                <td><?php echo $row['DateNP']; ?></td>
                                <td><?php echo $row['LieuA']; ?></td>
                                

                                <td class="button-row">
                                <form method="post" action="PP/reservation.php">
                                    <input type="hidden" name="id_reservation" value="<?php echo $row['idReservation']; ?>">
                                    <button type="submit" name="action" value="accepter" class="boutton button-ok">OK</button>
                                    <button type="submit" name="action" value="annuler" class="boutton button-non">NON</button></form>
</form>
                    </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Aucune réservation trouvée.</td>
                        </tr>
                    <?php endif; ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="5">Erreur : Information sur le trajet non disponible.</td>
                    </tr>
                <?php } ?>
            </table>
    <button type="submit" class="boutton"><a href="profil_coducteur.php" style="text-decoration:none; color:white;">Retour</a></button><br>

       </form>
       
    </center>
</body>
<hr>
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