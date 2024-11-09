<?php
$connexion = mysqli_connect("localhost", "root", "", "bdd_devoir");


if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}
$id_reservation = $_POST['id_reservation'];
var_dump( $id_reservation);
$action = $_POST['action'];

if ($action === 'accepter') {
    $sql = "UPDATE reservation SET Etat = 'Confirmée' WHERE idReservation = $id_reservation";
} elseif ($action === 'annuler') {
    $sql = "UPDATE reservations SET Etat = 'Annulée' WHERE idReservation = $id_reservation";
}

if ($connexion->query($sql) === TRUE) {
    echo "L'état de la réservation a été mis à jour avec succès.";
} else {
    echo "Erreur lors de la mise à jour de l'état de la réservation : " . $connexion->error;
}

$connexion->close();
?>