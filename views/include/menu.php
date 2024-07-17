<h2>Bienvenue <?php if (isset($_SESSION['fullname'])) : ?>
        <?php echo htmlspecialchars($_SESSION['fullname']); ?>
    <?php endif; ?> sur SafiriContent
</h2>

<?php
if ($pag = 'admin') {
    echo '<a href="index.php?search=accueil">Acceuil</a> |
<a href="index.php?search=login">Se connecter</a> |
<a href="index.php?search=signup">Créer un compte</a> |
<a href="index.php?search=articles">Vos articles</a> |
<a href="index.php?search=logout">Deconexion</a>
<br><br>';
}else{
    echo '<a href="index.php?search=accueil">Acceuil</a> |
<a href="index.php?search=login">Se connecter</a> |
<a href="index.php?search=signup">Créer un compte</a> |
<a href="index.php?search=admin">Postez un Article</a> |
<a href="index.php?search=articles">Vos articles</a> |
<a href="index.php?search=logout">Deconexion</a>
<br><br>';
}