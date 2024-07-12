<?php include 'include/header.php';  ?>

<body>
    <h1>Connectez-vous !</h1>
    <form method="post" action="index.php?search=logAdmin">
        <label for="username">Login :</label>
        <input type="text" id="username" name="username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>"><br><br>
        <?php if (isset($_SESSION['errors']['username'])) : ?>
            <div class="error-message" style='color: red;'><?php echo $_SESSION['errors']['username']; ?></div><br>
        <?php endif; ?>

        <label for="password">Password :</label>
        <input type="password" id="password" name="password" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ''; ?>"><br><br>
        <?php if (isset($_SESSION['errors']['password'])) : ?>
            <div class="error-message" style='color: red;'><?php echo $_SESSION['errors']['password']; ?></div><br>
        <?php endif; ?>

        <?php
        if (isset($_SESSION['isAuthenticated']) && $_SESSION['isAuthenticated'] === false) {
            echo "<p style='color: red;'>Login ou password incorrect !</p>";
        }
        ?>

        <input type="submit" value="Se connecter"><br><br>
    </form>
    <a href="index.php?search=signup">Cliquez ici pour créer un compte si vous n'en avez pas</a>
</body>

</html>
<?php session_destroy(); ?>