<?php

if (isset($_SESSION['message']['true'])) : ?>
    <p style='color: red;'><?php echo $_SESSION['message']['true']; ?></p>
<?php endif; ?>
<?php if (isset($_SESSION['message']['false'])) : ?>
    <p style='color: red;'><?php echo $_SESSION['message']['false']; ?></p>
<?php endif; ?>
<?php if (isset($_SESSION['Errors']['database'])) : ?>
    <p style='color: red;'><?php echo $_SESSION['Errors']['database']; ?></p>
<?php endif; ?>
<?php if (isset($_SESSION['Errors']['upload'])) : ?>
    <p style='color: red;'><?php echo $_SESSION['Errors']['upload']; ?></p>
<?php endif; ?>
<?php if (isset($_SESSION['Errors']['empty'])) : ?>
    <p style='color: red;'><?php echo $_SESSION['Errors']['emptyr']; ?></p>
<?php endif;

isAuthenticated('admin');

views('admin', ['titre' => 'Page Administrateur']);

unset($_SESSION['message']);
unset($_SESSION['Errors']);
unset($_SESSION['titre']);
unset($_SESSION['contenu']);

session_destroy();
die;

?>