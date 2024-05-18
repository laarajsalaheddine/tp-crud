<?php
define("PATH_ROOT", "../");
require PATH_ROOT . 'includes/config.php';
require (PATH_ROOT . "includes/functions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link rel="stylesheet" href="<?php echo PATH_ROOT; ?>assets/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo PATH_ROOT; ?>assets/fontawesome/css/all.min.css">

    <style>
        .signup-form {
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
    <div class="container">

        <div class="signup-form">
            <?PHP
            if (isset($_POST["signup"])) {
                $fullName = isset($_POST["fullname"]) ? $_POST["fullname"] : false;
                $email = isset($_POST["email"]) ? $_POST["email"] : false;
                $username = isset($_POST["username"]) ? $_POST["username"] : false;
                $password = isset($_POST["password"]) ? $_POST["password"] : false;
                $confirm_password = isset($_POST["confirm_password"]) ? $_POST["confirm_password"] : false;
                // $photo = uploadUserPhoto($_FILES);
                $role_id = 1;
                // if ($photo === false) {
                //     die($photo);
                // }
                if ($password == $confirm_password && $fullName && $email && $username) {
                    $hashedPss = password_hash($password, PASSWORD_DEFAULT);
                    $query = 'INSERT INTO `users`(`full_name`, `username`, `email`, `password`, `role_id`) VALUES (?,?,?,?,?)';
                    $stmt = $conn->prepare($query);
                    $result = $stmt->execute([$fullName, $username, $email, $hashedPss, $role_id]);
                    if ($result !== true) {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button class="btn btn-danger" type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                Erreur lors du signup
                            </div>';

                    } else {
                        header("Location: " . PATH_ROOT . "login/login.php");
                    }
                }
            }

            ?>
            <div>
                <img src="<?php echo PATH_ROOT; ?>assets/images/signup.svg" alt="" srcset="">
            </div>
            <form action="signup.php" method="post" enctype="multipart/form-data">
                <h2 class="text-center">Sign Up</h2>
                <div class="form-group my-2">
                    <input type="text" class="form-control" name="fullname" placeholder="Full Name" required="required">
                </div>
                <div class="form-group my-2">
                    <input type="email" class="form-control" name="email" placeholder="Email" required="required">
                </div>
                <div class="form-group my-2">
                    <input type="text" class="form-control" name="username" placeholder="Username" required="required">
                </div>
                <div class="form-group my-2">
                    <input type="password" class="form-control" name="password" placeholder="Password"
                        required="required">
                </div>
                <div class="form-group my-2">
                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password"
                        required="required">
                </div>

                <div class="form-group my-2">
                    <button type="submit" name='signup' class="btn btn-primary btn-block">Sign Up</button>
                    <span class="mx-2"> or <a href="login.php">login</a> </span>
                </div>

            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>