<?php include 'include/header.php';  ?>

<body>
    <h3>Bonjour <?php if (isset($_SESSION['fullname'])) : ?>
            <?php echo htmlspecialchars($_SESSION['fullname']); ?>
        <?php endif; ?> ,voici vos articles :
    </h3>
    <?php //echo $_SESSION['user_id']; 
    ?>

    <a href="index.php?search=accueil">Acceuil</a> |
    <a href="index.php?search=admin">Postez un article</a> |
    <a href="index.php?search=logout">Se deconnectez</a><br>

    <?php if (isset($_SESSION['delete'])) : ?>
        <div class="error-message" style='color: red;'><?php echo $_SESSION['delete']; ?></div><br>
    <?php endif; ?>
    <?php if (isset($_SESSION['editImg'])) : ?>
        <div class="error-message" style='color: red;'><?php echo $_SESSION['editImg']; ?></div><br>
    <?php endif; ?>
    <?php if (isset($_SESSION['Error']['edit'])) : ?>
        <div class="error-message" style='color: red;'><?php echo $_SESSION['Error']['edit']; ?></div><br>
    <?php endif; ?>

    <?php
    unset($_SESSION['delete']);
    unset($_SESSION['Error']['edit']);
    unset($_SESSION['editImg']);
    if (!empty($articles)) {
        // Afficher chaque article
        foreach ($articles as $article) {
            echo "<div class='article'>";
            echo "<div class='article-content'>";
            echo "<h2>" . htmlspecialchars_decode($article['titre']) . "</h2>";
            echo "<p class='date'>Date de votre publication : " . htmlspecialchars_decode(date("Y-m-d à H:i", strtotime($article['date_publication']))) . "</p>";
            echo "<p>" . nl2br(htmlspecialchars_decode($article['contenu'])) . "</p>";
            if (!empty($article['img_couverture'])) {
                echo "<img src='" . htmlspecialchars_decode($article['img_couverture']) . "' alt='Image de couverture'> <hr>";
            }
            // Formulaire de suppression
            echo "<form method='POST' action='index.php?search=deleteArticle'>";
            echo "<input type='hidden' name='article_id' value='" . $article['id'] . "'>";
            echo "<input type='submit' value='Supprimer cet article' onclick='return confirm(\"Voulez-vous vraiment supprimer cet article ?\");'>";
            echo "</form><hr>";

            // Formulaire de modification
            echo '<form method="post" action="index.php?search=editArticle">';
            echo '<input type="hidden" name="id" value="' . htmlspecialchars($article['id']) . '">';
            echo '<button type="submit">Modifier L\'article</button>';
            echo '</form><hr>';

            // Formulaire de modification
            echo '<form method="post" action="index.php?search=editImg" enctype="multipart/form-data">';
            echo '<input type="hidden" name="id" value=" ' . htmlspecialchars($article['id']) . '">';
            echo '<button type="submit">Modifier l\'image de couverture</button>';
            echo '<input type="file" name="img">';
            echo '</form>';

            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>Vous n'avez aucun article posté.</p>";
    }
    ?>
</body>

</html>