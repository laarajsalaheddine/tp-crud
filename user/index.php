<?php
session_start();
// Constant qui définie le chemin racine du projet
define("PATH_ROOT", "../");
// Constant pour identifier le module auquel le fichier en cours fait  partie 
define("MODULE", "user");
if (empty($_SESSION['userLoggedIn']) || $_SESSION['userLoggedIn'] != true) {
    header("location: " . PATH_ROOT . "index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo PATH_ROOT; ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo PATH_ROOT; ?>assets/fontawesome/css/all.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="table.css">
    <title>Users</title>
</head>
<?php
require ('config.php');
?>

<body>
    <div class="container">
        <?php include __DIR__ . "/includes/navbar.php"; ?>
    </div>
    <?php
    $userStatement = $conn->prepare("SELECT u.*, r.libelle FROM users
        INNER JOIN role on role.id = users.role_id
        WHERE users.id = $user_id
    ");
    $userStatement->execute();
    $users = $userStatement->fetchAll(PDO::FETCH_ASSOC);
    $droits = $_SESSION["user"]["role"]["droits"];
    if ($droits['consult'] === 0) {
        die("Vous ne pouvez pas consulter");
    }

    ?>

    <div class="container mt-5">
        <a href="add.php" name="add" class="btn btn-primary">Ajouter</a>
        <table class="table table-bordered ">
            <thead>
                <th>Fullname</th>
                <th>Email</th>
                <th>Username</th>
                <th>Edit</th>
                <th>Delete </th>
            </thead>
            <tbody>
                <?php foreach ($users as $singleUser): ?>
                    <tr>
                        <td><?= $singleUser['full_name']; ?></td>
                        <td><?= $singleUser['email']; ?></td>
                        <td><?= $singleUser['username']; ?></td>
                        <td>
                            <?php
                            if ($droits['editer'] == 1) {
                                echo "<a href='edit.php?id=$singleUser[id]' name='add' class='btn btn-outline-info text-capitalize'>edit</a>";
                            } else {
                                echo "<span title='call to action placeholder'>****</span>";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($droits['delete'] == 1) {
                                echo "<a href='delete.php?id={$singleUser['id']}' name='delete' class='btn btn-outline-danger text-capitalize'>delete</a>";
                            } else {
                                echo "<span title='call to action placeholder'>****</span>";
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>