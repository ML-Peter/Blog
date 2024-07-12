<?php

// Vérifier si un identifiant d'article est passé en paramètre POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    // Récupérer l'article
    $article = preModifierArticle($id);
    //include 'views/preModifier.php';
    views('preModifier', ['article' => $article, 'titre' => 'Modifier L\'articles']);
    die;
}
?>
