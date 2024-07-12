<?php
    // $totalPages = getPagination();
    //$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $articles = getArticles();
    views('acceuil' , ['articles' => $articles, 'titre' => 'Les articles du blog']);
    
    //include 'views/pagination.php';
    die;
