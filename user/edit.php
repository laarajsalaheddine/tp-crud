<?php
session_start();
define("PATH_ROOT", "../");
// le chemin de la racine
define("MODULE", "user");

$droits = $_SESSION["user"]["role"]["droits"][MODULE];
if ($droits && $droits['update'] == 0) {
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
        .modifier-form {
            width: 400px;
            margin: 50px auto;
        }

        img {
            width: 100%;
            height: auto;
        }

        .user-photo {
            width: 70px;
            max-width: 70px;
            height: auto;
        }
    </style>
</head>

<body>
    <?php include PATH_ROOT . "includes/navbar.php"; ?>
    <div class="container">
        <div class="modifier-form">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {

                $fullName = filter_input(INPUT_POST, "fullname", FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
                $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
                $confirm_password = filter_input(INPUT_POST, "confirm_password", FILTER_SANITIZE_STRING);
                $role_id = filter_input(INPUT_POST, "role", FILTER_VALIDATE_INT);

                $photo = false;

                if (!empty($_FILES['photo']['tmp_name'])) {
                    $photo = uploadUserPhoto($_FILES['photo']);
                    if ($photo === false) {
                        die("Error uploading photo.");
                    }
                }
                $photoQueryChunk = $photo !== false ? '`photo` = :photo, ' : '';

                $hashedPss = password_hash($password, PASSWORD_DEFAULT);

                $query = 'UPDATE `users` SET `full_name` = :full_name, `email` = :email, `password` = :password, ' . $photoQueryChunk . ' `role_id` = :role_id WHERE `username` = :username';
                $stmt = $conn->prepare($query);

                $stmt->bindParam(':full_name', $fullName);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashedPss);
                $stmt->bindParam(':role_id', $role_id);
                $stmt->bindParam(':username', $username);

                if ($photo !== false) {
                    $stmt->bindParam(':photo', $photo);
                }

                if ($stmt->execute()) {
                    echo "User updated successfully.";
                    header("Refresh:2; url=./");
                } else {
                    echo "Error updating user: " . $stmt->errorInfo()[2];
                }
            }
            if ($_SERVER["REQUEST_METHOD"] == "GET" && $droits['read'] && $droits['update'] && isset($_GET['id'])) {
                try {
                    $id = intval($_GET['id']);
                    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `id` = :id;");
                    $stmt->bindParam(":id", $id);
                    $stmt->execute();
                    $selectedRecord = $stmt->fetch(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                    echo "<p>" . $e->getMessage() . "<p>";
                }
            }
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <h2 class="text-center">Modifier user</h2>
                <div class="form-group my-2">
                    <input type="hidden" class="form-control" name="id" placeholder="id"
                        value="<?php echo empty($id) ? "" : $id ?>">
                </div>
                <div class="form-group my-2">
                    <input type="text" class="form-control" name="fullname" placeholder="Full Name" required="required"
                        value="<?php echo empty($selectedRecord["full_name"]) ? "" : $selectedRecord["full_name"]; ?>">
                </div>
                <div class="form-group my-2">
                    <input type="email" class="form-control" name="email" placeholder="Email" required="required"
                        value="<?php echo empty($selectedRecord["email"]) ? "" : $selectedRecord["email"]; ?>">
                </div>
                <div class="form-group my-2">
                    <input type="text" class="form-control" name="username" placeholder="Username" required="required"
                        value="<?php echo empty($selectedRecord["username"]) ? "" : $selectedRecord["username"]; ?>">
                </div>
                <div class="form-group my-2 text-center">
                    <?php if (!empty($selectedRecord['photo'])): ?>
                        <label for="photo">
                            <img class="user-photo" id="user-photo"
                                src="<?php echo PATH_ROOT . $selectedRecord['photo']; ?>" alt="User photo">
                        </label>
                    <?php endif; ?>
                    <input type="file" class="form-control" name="photo" placeholder="photo" id="photo">
                </div>
                <div class="form-group my-2">
                    <input type="password" class="form-control" name="password" placeholder="New password">
                </div>
                <div class="form-group my-2">
                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                </div>
                <div class="form-group">
                    <select class="form-control" id="role" name="role">
                        <option value="">Select role</option>
                        <?php
                        try {
                            $stmt = $conn->prepare("SELECT * FROM `role`;");
                            $stmt->execute();
                            $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($roles as $role) {
                                echo "<option " . ($role['id'] == $selectedRecord['role_id'] ? "selected" : "") . " value='$role[id]'>$role[libelle]</option>";
                            }
                        } catch (Exception $e) {
                            echo "<p>" . $e->getMessage() . "<p>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group my-2">
                    <button type="submit" name='update' class="btn btn-primary btn-block">Créer</button>
                </div>

            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById("photo").addEventListener("change", function () {
            document.getElementById("user-photo").style.display = "none";
        });
    </script>
</body>

</html>