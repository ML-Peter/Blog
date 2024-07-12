<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['article_id'])) {
    $article_id = $_POST['article_id'];

    try {
        deleteArticle($article_id);
        $_SESSION['delete'] = "Article supprimé avec succès.";
    } catch (PDOException $e) {
        $_SESSION['delete'] = "Erreur de la suppression de l'article : " . $e->getMessage();
    }

    header("Location: index.php?search=articles");
    exit();
}
