<?php
session_start();
define("PATH_ROOT", "../");
define("MODULE", "user");

if (!isset($_SESSION["user"]["role"]["droits"][MODULE]) || $_SESSION["user"]["role"]["droits"][MODULE]['delete'] == 0) {
    echo "<a href='" . htmlspecialchars(PATH_ROOT) . "'>Retourner au Home</a>";
    die("Vous n'avez pas le droit pour supprimer les users");
}

if (empty($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Il faut spécifier un ID valide que vous souhaitez supprimer");
}

require PATH_ROOT . 'includes/config.php';
$id = intval($_GET['id']);

$query = 'DELETE FROM `users` WHERE id=:id';
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$result = $stmt->execute();

if ($result) {
    echo "Supprimé avec succès";
    $homepage = "index.php";
    header("Refresh: 2; url=$homepage");
    exit();
} else {
    $errorInfo = $stmt->errorInfo();
    echo "Erreur lors de la suppression: " . htmlspecialchars($errorInfo[2]);
}