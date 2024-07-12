<?php
session_start();

// Vérifier si la méthode de requête est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['Errors'] = [];

    // Nettoyer et récupérer les données du formulaire
    $_SESSION['titre'] = htmlspecialchars($_POST['titre']);
    $_SESSION['contenu'] = htmlspecialchars($_POST['contenu']);
    $_SESSION['date'] = htmlspecialchars($_POST['date']);
    //$user_id = $_SESSION['user_id'];

    // Valider les champs requis
    if (empty($_POST['titre'])) {
        $_SESSION['Errors']['titre'] = 'Le titre est obligatoire';
    }
    if (empty($_POST['contenu'])) {
        $_SESSION['Errors']['contenu'] = 'Le contenu est obligatoire';
    }
    if (empty($_FILES['img']['name'])) {
        $_SESSION['Errors']['img'] = 'L\'image de couverture est obligatoire';
    }

    // Si aucune erreur n'est présente, procéder à l'enregistrement de l'article
    if (empty($_SESSION['Errors'])) {
        // Vérifier et créer le répertoire de téléchargement s'il n'existe pas
        $upload_dir = '../public/uploadImg/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Renommer l'image téléchargée avec un nom unique
        $file_extension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        $unique_filename = 'IMG_' . uniqid() . '.' . $file_extension;
        $uploaded_file = $upload_dir . $unique_filename;

        if (move_uploaded_file($_FILES['img']['tmp_name'], $uploaded_file)) {
           
                $GLOBALS['user_id'] = $_SESSION['user_id'];
                $GLOBALS['uploaded_file'] = $uploaded_file;
                //Appel de la fonction postedArticles pour l'enregistrer dans la base de donnees
                postedArticles();
                // Destruction de certaines sessions
                unset($_SESSION['message']);
                unset($_SESSION['Errors']);
                unset($_SESSION['titre']);
                unset($_SESSION['contenu']);

                $_SESSION['message']['true'] = "Article publié avec succès !";
                views('admin', ['titre' => 'Page Administrateur']);
                die;
        }
        else {
            $_SESSION['Errors']['upload'] = "Désolé, une erreur est survenue lors du téléchargement de votre fichier.";
            views('admin', ['titre' => 'Page Administrateur']);
            die;
        }

    } else {
        // Rediriger si la méthode de requête n'est pas POST
        $_SESSION['titre'] = $_POST['titre'];
        $_SESSION['continu'] = $_POST['contenu'];
        views('admin', ['titre' => 'Page Administrateur']);
        die;
    }
}
