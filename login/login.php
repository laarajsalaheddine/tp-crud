<?php
define("PATH_ROOT", "../");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo PATH_ROOT; ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo PATH_ROOT; ?>assets/fontawesome/css/all.min.css">

    <style>
        /* Custom styles */
        .login-form {
            width: 400px;
            margin: 50px auto;
        }

        img {
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <?php
    require_once PATH_ROOT . 'includes/config.php';

    if (isset($_POST["login"]) && isset($_POST["username"]) && isset($_POST["password"])) {
        $loginFlag = true;
        $username = $_POST["username"];
        $password = $_POST["password"];
        $stmt = $conn->prepare("SELECT * FROM `users` u INNER JOIN `role` r on u.role_id = r.id WHERE u.username=:username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            $loginFlag = false;
            goto printMessage;
        }
        $hashedPass = $user['password'];
        if (!password_verify($password, $hashedPass)) {
            $loginFlag = false;
            goto printMessage;
        } else {
            session_start();
            $_SESSION['userLoggedIn'] = true;
            $_SESSION['user'] = [
                "currentUser" => $user,
                "role" => [
                    "libelle" => $user["libelle"],
                    "droits" => unserialize($user['droit']),
                ]
            ];
            setcookie('connectedUserSessionId', session_id(), time() + 50000, '/');
            header("Location: " . PATH_ROOT . "dashboard.php");
        }
    } else {
        $loginFlag = false;
        goto printMessage;
    }
    printMessage:
    if (!$loginFlag) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Warning!</strong> username et/ou le mot de passe incorrecte 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
        die;
    }
    ?>
    <div class="container">
        <div class="login-form my-5">
            <div>
                <img src="<?php echo PATH_ROOT; ?>assets/images/login.svg" alt="" srcset="">
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <h2 class="text-center">Login</h2>
                <div class="form-group my-2">
                    <input type="text" class="form-control" name="username" placeholder="Username" required="required">
                </div>
                <div class="form-group my-2">
                    <input type="password" class="form-control" name="password" placeholder="Password"
                        required="required">
                </div>
                <div class="form-group my-2">
                    <button type="submit" name="login" class="btn btn-primary btn-block">Log in</button>
                    <span class="mx-2"> or <a href="signup.php">Signup</a> </span>
                </div>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies (optional)
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
</body>

</html>