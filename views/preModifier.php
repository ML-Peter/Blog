<?php include 'include/header.php';  ?>

<body>
    <h1>Modifier l'article</h1>
    <form method="post" action="index.php?search=finishEdit">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($article['id']); ?>">
        <div>
            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($article['titre']); ?>" required>
            <hr>
            <br>
        </div>
        <div>
            <label for="contenu">Contenu :</label>
            <textarea id="contenu" name="contenu" rows="10" cols="50" required><?php echo htmlspecialchars($article['contenu']); ?></textarea>
            <hr>
            <br>
        </div>
        <div>
            <button type="submit">Modifier</button>
        </div>
    </form>
</body>

</html>
<?phP session_destroy(); ?>