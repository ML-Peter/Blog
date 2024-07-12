<?php
echo "<div class='pagination'>";
for ($i = 1; $i <= $totalPages; $i++) {
    if ($i == $page) {
        echo "<span>$i</span> "; // Page actuelle sans lien
    } else {
        echo "<a href='index.php?page=$i'>$i</a> ";
    }
}
echo "</div>";
?>