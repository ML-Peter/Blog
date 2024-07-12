<?php
//session_start();
// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['errors'] = [];
    $_SESSION['fullName'] = $_POST['fullName'];
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['confirmPassword'] = $_POST['confirmPassword'];


    // Vérification des champs vides
    if (empty($_POST['fullName'])) {
        $_SESSION['errors']['fullName'] = 'Le nom complet est obligatoire.';
    }

    if (empty($_POST['login'])) {
        $_SESSION['errors']['login'] = 'Le login est obligatoire.';
    }

    if (empty($_POST['password'])) {
        $_SESSION['errors']['password'] = 'Le mot de passe est obligatoire.';
    }

    if (empty($_POST['confirmPassword'])) {
        $_SESSION['errors']['confirmPassword'] = 'La confirmation du mot de passe est obligatoire.';
    }

    // Si aucun champ n'est vide, procéder à l'inscription
    if (empty($_SESSION['errors'])) {
        $GLOBALS['fullname'] = trim($_POST['fullName']);
        $GLOBALS['login'] = trim($_POST['login']);
        $GLOBALS['password'] = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirmPassword']);

        // Vérification si les mots de passe correspondent
        if ($password !== $confirmPassword) {
            $_SESSION['errors']['confirmPassword'] = 'Les mots de passe ne correspondent pas.';
        } else {
            // Connexion à la base de données et vérification si le nom complet ou le login existe déjà
            $conn = getDbConnection();
            // Si aucun champ n'est vide, procéder à l'inscription
            if (empty($_SESSION['errors'])) {
                $GLOBALS['fullname'] = trim($_POST['fullName']);
                $GLOBALS['login'] = trim($_POST['login']);
                $GLOBALS['password'] = trim($_POST['password']);
                $confirmPassword = trim($_POST['confirmPassword']);

                // Vérification si les mots de passe correspondent
                if ($password !== $confirmPassword) {
                    $_SESSION['errors']['confirmPassword'] = 'Les mots de passe ne correspondent pas.';
                } else {
                    // Vérification si le nom complet ou le login existe déjà
                    $result = verificationExistLoginOrFullname();
                    if ($result) {
                        $_SESSION['errors']['database'] = 'Le nom complet ou le login existe déjà.';
                    } else {
                        // Insertion des données
                        createAccount();
                        $_SESSION['isAuthenticated'] = true;
                        $_SESSION['fullname'] =  $GLOBALS['fullname'];
                        //$_SESSION['user_id'] = $user['id'];
                        views('admin', ['titre' => 'Page Administrateur']);
                        die;
                    }
                }
            }
        }
    }else{
        // Redirection vers le formulaire d'inscription en cas d'erreur
        $_SESSION['fullName'] = $_POST['fullName'];
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['confirmPassword'] = $_POST['confirmPassword'];
        $vue = 'signup';
        views($vue);
        die;
    }
}