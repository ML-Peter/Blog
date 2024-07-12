<?php
session_start();
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['img']) && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        // Définir le dossier de téléchargement
        $upload_dir = "../public/uploadImg/";
        // Renommer l'image téléchargée avec un nom unique
        $file_extension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        $unique_filename = 'IMG_' . uniqid() . '.' . $file_extension;
        $uploaded_file = $upload_dir . $unique_filename;

        // Vérifier si le fichier est une image
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if ($check !== false) {
            // Vérifier les types de fichiers autorisés
            $allowedTypes = ["jpg", "png", "jpeg", "gif"];
            if (in_array($file_extension, $allowedTypes)) {
                // Déplacer le fichier téléchargé vers le dossier de destination
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $uploaded_file)) {
                    // Appel de la fonction pour mettre a jour l'image
                    editImg($uploaded_file, $id);
                    $_SESSION['editImg'] = "Image modifier avec succes !";
                    header("Location: index.php?search=articles");
                } else {
                    $_SESSION['Error']['edit'] = "Erreur lors du téléchargement de l'image.";
                    header("Location: ../views/articles.php");
                }
            } else {
                $_SESSION['Error']['edit'] = "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
                header("Location: index.php?search=articles");
            }
        } else {
            $_SESSION['Error']['edit'] = "Le fichier téléchargé n'est pas une image.";
            header("Location: index.php?search=articles");
        }
    } else {
        $_SESSION['Error']['edit'] = "Veuillez sélectionner une image à télécharger.";
        header("Location: index.php?search=articles");
    }
} else {
    $_SESSION['Error']['edit'] = "Requête invalide.";
    header("Location: index.php?search=articles");
}
