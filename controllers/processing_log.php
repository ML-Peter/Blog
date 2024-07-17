<?php
//session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //$_SESSION['errors'] = [];
    $GLOBALS['username'] = trim($_POST['username']);
    $password = trim($_POST['password']);
    //$user_id = $_SESSION['user_id'];

    if (empty($_POST['username'])) {
        $_SESSION['errors']['username'] = 'Le nom complet est obligatoire';
    }
    if(empty($_POST['password'])){
        $_SESSION['errors']['password'] = 'Le mot de passe est obligatoire';
    }

    if (!empty($GLOBALS['username']) && !empty($password)) {
        $user = logAdmin();
        if (isset($user) && ($password === $user['password'])) {
            $_SESSION['isAuthenticated'] = true;
            $_SESSION['fullname'] =  $user['fullname'];
            $_SESSION['user_id'] = $user['id'];
            views('admin', ['titre' => 'Page Administrateur']);
            die;
        } else {
            $_SESSION['username'] = $GLOBALS['username'];
            $_SESSION['password'] = $password;
            $_SESSION['isAuthenticated'] = false;
            views('login', ['titre' => 'Login']);
            die;
        }
    } else {
        $_SESSION['usermane'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        views('login', ['titre' => 'Login']);
        die;
    }
} else {
    $_SESSION['usermane'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    views('login', ['titre' => 'Login']);
    die;
}

