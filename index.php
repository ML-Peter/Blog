<?php
session_start();
require 'models/model.php';
require 'controllers/functions.php';


if (!isset($_GET['search'])) {
    include 'controllers/acceuil.php';
    die;
} 

$controller = match ($_GET['search']) {
    'accueil' => 'acceuil.php',
    'login' => 'login.php',
    'logAdmin' => 'processing_log.php',
    'signup' => 'signup.php',
    'createAccount' => 'processing_sign.php',
    'admin' => 'admin.php',
    'logout' => 'logout.php',
    'postedArticles' => 'processing_admin.php',
    'articles' => 'userArticles.php',
    'deleteArticle' => 'delete.php',
    'editArticle' => 'preModifier.php',
    'finishEdit' => 'editFinish.php',
    'editImg' => 'modifierImg.php',
    default => '../views/404.php',
};

require 'controllers/' . $controller;