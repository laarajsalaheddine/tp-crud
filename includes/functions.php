<?php
function uploadUserPhoto($file, $uploadDir = "user-photo-uploads/", $maxFileSize = 500000, $allowedExtensions = ['jpg', 'jpeg', 'png'])
{
    // nous avons: $file, ici photo est le name dans le formulaire 
    $uploadDir = PATH_ROOT . $uploadDir;
    $targetFile = $uploadDir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $upload = 1;
    // Check if file is an image
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $upload = 0;
    }

    // Check file size
    if ($file["size"] > $maxFileSize) {
        echo "Sorry, your file is too large.";
        $upload = 0;
    }

    // Check file extension
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo "Sorry, only " . implode(', ', $allowedExtensions) . " files are allowed.";
        $upload = 0;
    }

    // Generate a unique filename to prevent overwriting existing files
    $uniqueFilename = uniqid() . '.' . $imageFileType;
    $targetFile = $uploadDir . $uniqueFilename;

    if ($upload == 0) {
        return false;
    }

    // Move uploaded file to destination
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        return str_replace(PATH_ROOT, "", $targetFile);
    } else {
        return false;
    }
}
