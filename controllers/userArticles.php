<?php
$id = $_SESSION['user_id'];
$articles = getUserArticles($id);

if (isset($_SESSION['delete'])) : ?>
    <div class="error-message" style='color: red;'><?php echo $_SESSION['delete']; ?></div><br>
<?php endif; ?>
<?php if (isset($_SESSION['editImg'])) : ?>
    <div class="error-message" style='color: red;'><?php echo $_SESSION['editImg']; ?></div><br>
<?php endif; ?>
<?php if (isset($_SESSION['Error']['edit'])) : ?>
    <div class="error-message" style='color: red;'><?php echo $_SESSION['Error']['edit']; ?></div><br>
<?php endif;

//$vue = 'User Articles';
views('articles', ['articles' => $articles, 'titre' => 'Vos Articles']);

unset($_SESSION['delete']);
unset($_SESSION['Error']['edit']);
unset($_SESSION['editImg']);
//footerPagination();
die;

?>