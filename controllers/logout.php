<?php
session_destroy();
$articles = getArticles();
views('acceuil', ['articles' => $articles, 'titre' => 'Les articles du blog']);
die;

?>