<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('connectConnexion.php');
    $cookie      = $_POST['cookie'];
    $target_dir  = "img/"; // Dossier où le fichier sera stocké
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk    = 1;
    $fileType    = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Vérifiez la taille du fichier
    if ($_FILES["file"]["size"] > 1000000) { // 1000 KB
        echo "Désolé, votre fichier est trop volumineux.";
        $uploadOk = 0;
    }

    // Autoriser certains formats de fichiers
    if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") {
        echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
        $uploadOk = 0;
    }

    // Vérifiez si $uploadOk est défini à 0 par une erreur
    if ($uploadOk == 0) {
        echo "Désolé, votre fichier n'a pas été uploadé.";
        // Si tout est ok, essayez d'uploader le fichier
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "Le fichier ". htmlspecialchars(basename($_FILES["file"]["name"])) . " a été uploadé.";
            $nameFile = htmlspecialchars(basename($_FILES["file"]["name"]));
            // modification du nom du fichier dans la bd
            $up = "UPDATE comptes SET photo='$nameFile' WHERE login_user='$cookie'";
            if($upd = $connec -> query($up)){}

        } else {
            echo "Désolé, une erreur s'est produite lors de l'upload de votre fichier.";
        }
    }
}
?>