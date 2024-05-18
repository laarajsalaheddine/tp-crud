<?php
session_start();
define("PATH_ROOT", "./");

if (empty($_SESSION['userLoggedIn']) || $_SESSION['userLoggedIn'] != true) {
    header("location: " . PATH_ROOT . "index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo PATH_ROOT; ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo PATH_ROOT; ?>assets/fontawesome/css/all.min.css">
</head>

<body>
    <?php
    include PATH_ROOT . "includes/navbar.php";
    require (PATH_ROOT . 'includes/config.php');
    ?>

    <div class="container mt-5">
        <h1 class="text-center text-uppercase">
            bienvenue sur le tableau de bord
        </h1>
    </div>
    <div class="container text-center my-5">
        <a href="<?php echo PATH_ROOT; ?>user/" class="text-white text-capitalize">
            <div class="card text-white bg-primary mb-3 d-inline-block" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Utilisateurs <i class="fas fa-user mx-2"></i></h5>
                </div>
            </div>
        </a>
        <a href="<?php echo PATH_ROOT; ?>role/" class="text-white text-capitalize">
            <div class="card text-white bg-danger mb-3 d-inline-block" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Roles <i class="fas fa-user mx-2"></i></h5>
                </div>
            </div>
        </a>
        <a href="<?php echo PATH_ROOT; ?>categorie/" class="text-white text-capitalize">
            <div class="card text-white bg-info mb-3 d-inline-block" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Produits <i class="fas fa-user mx-2"></i></h5>
                </div>
            </div>
        </a>
        <a href="<?php echo PATH_ROOT; ?>product/" class="text-white text-capitalize">
            <div class="card text-white bg-success mb-3 d-inline-block" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Catégories <i class="fas fa-user mx-2"></i></h5>
                </div>
            </div>
        </a>
    </div>

</body>

</html>