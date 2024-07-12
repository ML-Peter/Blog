<?php
//session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && (isset($_POST['titre']) and isset($_POST['contenu']) and isset($_POST['id']))) {
    // Mettre à jour l'article après soumission du formulaire de modification
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    modifierArticle($id, $titre, $contenu);
    $_SESSION['Error']['edit'] = "Article modifier avec succes !";
    // Rediriger vers la page de confirmation ou l'article modifié
    views('articles', ['titre' => 'Vos Articles']);
    die;
} else {
    $_SESSION['Error']['edit'] = "Erreur de modification !";
    views('admin', ['titre' => 'Page Administrateur']);
    die;
}
?>
