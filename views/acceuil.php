<!-- Inclusion du de l'en-tete -->
<?php include 'include/header.php';  ?>

<body>
    <!-- Inclusion du menu -->
    <?php include 'include/menu.php'; ?>
    <!-- Formulaire de recherche -->
    <form method="POST" action="search.php">
        <input type="text" name="query" placeholder="Rechercher..." required>
        <input type="submit" value="Rechercher">
    </form>

    <?php
    //echo count($articles);
    if (!empty($articles)) {
        // Afficher chaque article
        foreach ($articles as $article) {
            echo "<div class='article'>";
            echo "<div class='article-content'>";
            // Le titre de l'article
            echo "<h2>" . htmlspecialchars_decode($article['titre']) . "</h2>";
            // Nom de celui qui l'a poste
            echo "<p class='author'>Posté par " . htmlspecialchars_decode($article['fullname']) . "</p>";
            // Date de publication
            echo "<p class='date'>Date de publication : " . htmlspecialchars_decode(date("Y-m-d à H:i", strtotime($article['date_publication']))) . "</p>";
            // Contenu de l'article
            echo "<p>" . nl2br(htmlspecialchars_decode($article['contenu'])) . "</p>";
            // Image de couverture
            echo "</div>";
            if (!empty($article['img_couverture'])) {
                echo "<img src='" . htmlspecialchars_decode($article['img_couverture']) . "' alt='Image de couverture'>";
            }
            echo "</div>";
        }
    } else {
        echo "<p>Vous n'avez aucun article posté.</p>";
    }

    ?>
</body>

</html>