<?php
session_start();
// if(!isset($_SESSION["username"]) && !isset($_SESSION['id'])){
//     header('Location: ./') ;
// }

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
        /* Custom styles */
        .signup-form {
            width: 400px;
            margin: 50px auto;
        }
    </style>
</head>
<?php
require_once ('config.php');
?>

<body>
    <div class="container">
        <?php include __DIR__ . "/includes/navbar.php"; ?>
    </div>

    <div class="container">

        <div class="signup-form">
            <?PHP
            if (isset($_POST["signup"])) {
                $fullName = isset($_POST["fullname"]) ? $_POST["fullname"] : false;
                $email = isset($_POST["email"]) ? $_POST["email"] : false;
                $username = isset($_POST["username"]) ? $_POST["username"] : false;
                $password = isset($_POST["password"]) ? $_POST["password"] : false;
                $confirm_password = isset($_POST["confirm_password"]) ? $_POST["confirm_password"] : false;
                $pic = isset($_POST["image"]) ? $_POST["image"] : false;
                $roles = array(
                    "consult" => isset($_POST['consult']) ? 1 : 0,
                    "editer" => isset($_POST['edit']) ? 1 : 0,
                    "add" => isset($_POST['add']) ? 1 : 0,
                    "delete" => isset($_POST['delete']) ? 1 : 0
                );
                if ($password == $confirm_password && $fullName && $email && $username && $pic) {
                    $serialized_roles = serialize($roles);
                    $hashedPss = password_hash($password, PASSWORD_DEFAULT);
                    $roleQuery = 'INSERT INTO role VALUES(null,?,?)';
                    $query = 'INSERT INTO USERS VALUES (null,?,?,?,?,?,?)';
                    $stmt = $conn->prepare($roleQuery);
                    $result = $stmt->execute(['user', $serialized_roles]);
                    if ($result === true) {
                        $lastid = $conn->lastInsertId();
                        $sqlState = $conn->prepare($query);
                        $sqlState->execute([$fullName, $email, $username, $hashedPss, $pic, $lastid]);
                        if ($sqlState) {
                            header('Location: dashboard.php');
                        } else {
                            header('Location: index.php');
                        }
                    } else {
                        echo 'Error';
                    }
                }
            }

            ?>
            <form method="post">
                <h2 class="text-center">Ajouter Un Utilisateur</h2>
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
                    <input type="file" class="form-control" name="image" required="required">
                </div>
                <div class="form-group my-2">
                    <select name="role" class="form-control">
                        <option value="">Selectionner role</option>
                        <?php
                        $rolesList = $conn->query("SELECT * FROM `role` WHERE 1")->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($rolesList as $role) {
                            echo "<option value='$role[id]'>$role[libelle]</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group my-2">
                    <button type="submit" name='signup' class="btn btn-primary btn-block">Ajouter</button>
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