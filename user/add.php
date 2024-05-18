<?php
session_start();
define("PATH_ROOT", "../");
// le chemin de la racine
define("MODULE", "user");

$droits = $_SESSION["user"]["role"]["droits"][MODULE];
if ($droits['create'] == 0) {
    echo "<a href='" . PATH_ROOT . "'>Retourner au Home</a>";
    die("Vous n'avez pas le droit");
}

require PATH_ROOT . 'includes/config.php';
require (PATH_ROOT . "includes/functions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new user</title>
    <link rel="stylesheet" href="<?php echo PATH_ROOT; ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo PATH_ROOT; ?>assets/fontawesome/css/all.min.css">

    <style>
        .ajouter-form {
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
    <?php include PATH_ROOT . "includes/navbar.php"; ?>
    <div class="container">

        <div class="ajouter-form">
            <?PHP
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
                $fullName = isset($_POST["fullname"]) ? $_POST["fullname"] : false;
                $email = isset($_POST["email"]) ? $_POST["email"] : false;
                $username = isset($_POST["username"]) ? $_POST["username"] : false;
                $password = isset($_POST["password"]) ? $_POST["password"] : false;
                $role_id = isset($_POST["role"]) ? $_POST["role"] : false;
                $confirm_password = isset($_POST["confirm_password"]) ? $_POST["confirm_password"] : false;
                $photo = uploadUserPhoto($_FILES['photo']);
                if ($photo === false) {
                    die("error photo -- $photo");
                }
                if ($password == $confirm_password && $fullName && $email && $username) {
                    $hashedPss = password_hash($password, PASSWORD_DEFAULT);
                    $query = 'INSERT INTO `users`(`full_name`, `username`, `email`, `password`,`photo`, `role_id`) VALUES (?,?,?,?,?,?)';
                    $stmt = $conn->prepare($query);
                    $result = $stmt->execute([$fullName, $username, $email, $hashedPss, $photo, $role_id]);
                    if ($result !== true) {
                        $message = "Erreur lors de l'ajout d'utilisateur";
                    } else {
                        $message = "Ajouté avec succès";
                    }
                    echo $message;
                }
            }

            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <h2 class="text-center">Ajouter user</h2>
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
                    <input type="file" class="form-control" name="photo" placeholder="photo">
                </div>
                <div class="form-group my-2">
                    <input type="password" class="form-control" name="password" placeholder="Password"
                        required="required">
                </div>
                <div class="form-group my-2">
                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password"
                        required="required">
                </div>
                <div class="form-group">
                    <select class="form-control" id="role" name="role">
                        <option value="">Select role</option>
                        <?php
                        try {
                            $stmt = $conn->prepare("SELECT * FROM `role`;");
                            $stmt->execute();
                            $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        } catch (Exception $e) {
                            echo "<p>" . $e->getMessage() . "<p>";
                        }
                        foreach ($roles as $role) {
                            echo "<option value='$role[id]'>$role[libelle]</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group my-2">
                    <button type="submit" name='create' class="btn btn-primary btn-block">Créer</button>
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