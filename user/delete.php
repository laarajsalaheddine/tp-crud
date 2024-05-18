<?php
session_start();
define("PATH_ROOT", "../");
// le chemin de la racine
define("MODULE", "user");
$droits = $_SESSION["user"]["role"]["droits"][MODULE];

if ($droits['delete'] == 0) {

    echo "<a href='" . PATH_ROOT . "'>Retourner au Home</a>";
    die("Vous n'avez pas le droit pour supprimer les users");
}

if (empty($_GET['id'])) {
    die("il faut spécifier l'id que vous souhaiter supprimer");
}
require PATH_ROOT . 'includes/config.php';
$id = $_GET['id'];

$query = 'DELETE FROM `users` WHERE id=:id';
$stmt = $conn->prepare($query);
$stmt->bindParam(":id", $id);
$result = $stmt->execute();
if ($result !== true) {
    $message = "Erreur lors de la suppression";
} else {
    $homepage = "index.php";
    echo "Supprimé avec succès";
    header("Refresh: 2; url=$homepage");
}

