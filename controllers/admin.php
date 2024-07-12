<?php
isAuthenticated('admin');
views('admin',['titre' => 'Page Administrateur']);

unset($_SESSION['message']);
unset($_SESSION['Errors']);
unset($_SESSION['titre']);
unset($_SESSION['contenu']);

die;

?>