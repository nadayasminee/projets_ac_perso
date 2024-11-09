<?php include 'PP/functions.php'; ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inscription</title>
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
<div class="containerr">
    <div class="formulaire">
        <h3>Mon profil:</h3>
        <form>
            <div class="champs">
                <label>Evaluation:</label>
                <input type="text" name="Evaluation" placeholder="******" value="<?php echo generateStars($evaluation);?>" readonly>
            </div>
            <div class="champs">
                <label>Experience:</label>
                
                <input type="text" name="Experience" value="<?php echo $experience; ?>" readonly>
            </div>
            <div class="champs">
                <label>Categorie:</label>
                <input type="text" placeholder="categorie" value="<?php echo $categorie; ?>" readonly>
            </div>
            <div class="champs">
                <label>Annulation/retard:</label>
                <input type="text" value="<?php echo $totalDelaysAndCancellations;?>" readonly>
            </div>
            <div class="champs">
                <label>Certification:</label><?php echo checkCertification($experience);?>
            </div>
        </form>
    </div>

    <div class="journey">
        <h3>Mes Trajets</h3>
        
        <a href="Publiertrajet.php" class="boutton" style="text-decoration:none;">Nouveau trajet</a>
        <table class="table">
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr data-id="<?php echo $row['IdTrajet']; ?>">                        <td><?php echo $row['DateD']; ?></td>
                        <td><?php echo $row['HeureD']; ?></td>
                        <td><?php echo $row['LieuA']; ?></td>
                        <td class="button-row">
                        <a href="Publiertrajet.php?id=<?php echo $row['IdTrajet']; ?>" class="boutton-table" style="text-decoration: none;">Modifier</a>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
        <br>
    </div>
</div>
<center>
    <a href="Recherche.php">Retour à la page de recherche</a>
</center>
<script>
    document.querySelectorAll('.table tr').forEach(row => {
        row.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            window.location.href = 'Gestiontrajet.php?id=' + id;
        });
    });
    </script>
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
