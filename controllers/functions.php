<?php
// Qui decide de quelle vue doit etre affichee et avec quelle donnees
function views($vue, $data=[])
{
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    
    include 'views/' . $vue . '.php';
}

function isAuthenticated($vue)
{
    if (isset($_SESSION['isAuthenticated']) && $_SESSION['isAuthenticated'] === true) {
        //views($vue);
        views($vue, ['titre' => 'Page Administrateur']);
    } else {
        views('login', ['titre'=> 'Login']);
    }
    die;
}
function pagination($totalPages, $page)
{
    echo "<div class='pagination'>";
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $page) {
            echo "<span>$i</span> "; // Page actuelle sans lien
        } else {
            echo "<a href='index.php?page=$i'>$i</a> ";
        }
    }
    echo "</div>";
}


