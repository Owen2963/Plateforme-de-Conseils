<?php
if (($handle = fopen("data.csv", "r")) !== FALSE) {
    fgetcsv($handle); // Ignore l'en-tête
    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $shortDescription = strlen($row[2]) > 50 ? substr($row[2], 0, 50) . "..." : $row[2];
        echo "<div class='conseil'>";
        echo "<h3><a href='conseil.php?id={$row[0]}'>{$row[1]}</a></h3>";
        echo "<p>$shortDescription</p>";
        echo "<a href='conseil.php?id={$row[0]}' class='voir-plus'>Voir plus</a>";
        echo "</div>";
    }
    fclose($handle);
}
?>
