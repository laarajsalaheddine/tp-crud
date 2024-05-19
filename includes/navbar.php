<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?php echo PATH_ROOT; ?>">Brand</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link text-capitalize" href="<?php echo PATH_ROOT; ?>">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-capitalize" href="<?php echo PATH_ROOT; ?>user/">utilisateur</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-capitalize" href="<?php echo PATH_ROOT; ?>roles/">roles</a>
                </li>
                <!-- <li class="nav-item active">
                    <a class="nav-link text-capitalize" href="<?php echo PATH_ROOT; ?>product/">produits</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-capitalize" href="<?php echo PATH_ROOT; ?>categorie/">catégorie</a>
                </li> -->
            </ul>
        </div>
        <form class="form-inline">
            <a href="<?php echo PATH_ROOT; ?>login/logout.php" class="btn btn-danger">Log out</a>
        </form>
    </div>
</nav>