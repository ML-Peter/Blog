<?php
$id = $_SESSION['user_id'];
$articles = getUserArticles($id);
//$vue = 'User Articles';
views('articles', ['articles' =>$articles, 'titre' => 'Vos Articles']);
//footerPagination();
die;

?>