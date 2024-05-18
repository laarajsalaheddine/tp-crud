<?php
session_start();
session_destroy();
define("PATH_ROOT", "../");
echo "Signed out successfuly";
echo "<br />";
$timeout = 2;
echo "You will be redirected in $timeout seconds";
$destinationPage = PATH_ROOT . "index.php";
header("Refresh: $timeout; url=$destinationPage");
