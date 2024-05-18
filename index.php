<?php
session_start();
define("PATH_ROOT", "./");
if (isset($_SESSION['userLoggedIn']) && $_SESSION['userLoggedIn'] == true) {
    header("location: " . PATH_ROOT . "dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="<?php echo PATH_ROOT; ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo PATH_ROOT; ?>assets/fontawesome/css/all.min.css">

    <style>
        .glow-button {
            border: none;
            outline: none;
            box-shadow: 0 0 10px #fff;
            transition: box-shadow 0.3s ease-in-out;
        }

        .glow-button:hover {
            box-shadow: 0 0 20px #33ccff;
        }

        .callToAction {
            font-size: 2em;
        }

        #img-container {
            height: 450px;
            max-height: 300px;
        }

        img {
            height: 100%;
            width: auto;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center">
            Gestion des produits
        </h1>
    </div>
    <div class="container mt-5 text-center">
        <div id="img-container">
            <img src="<?php echo PATH_ROOT; ?>assets/images/shoping-cart.svg" alt="" srcset="">
        </div>
        <div class="row my-3">
            <div class="text-center">
                <a href="<?php echo PATH_ROOT; ?>login/signup.php" class="btn btn-danger text-center p-3 glow-button"
                    class="callToAction">
                    signup
                </a>
                <a href="<?php echo PATH_ROOT; ?>login/login.php" class="btn btn-primary text-center p-3 glow-button"
                    class="callToAction">
                    Login
                </a>
            </div>
        </div>
    </div>
</body>

</html>