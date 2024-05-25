<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Plateforme de Conseils</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Plateforme de Partage de Conseils</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="conseils.php">Conseils</a></li>
                <?php if (isset($_SESSION['email'])): ?>
                    <li><a href="soumettre.php">Soumettre un Conseil</a></li>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="logout.php">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="register.php">Inscription</a></li>
                    <li><a href="login.php">Connexion</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Conseils Populaires</h2>
        <form method="GET" action="conseils.php">
            <input type="text" name="search" placeholder="Rechercher par mot-clé">
            <input type="text" name="category" placeholder="Rechercher par catégorie">
            <button type="submit">Rechercher</button>
        </form>
        <div id="conseils-populaires">
            <?php
            if (($handle = fopen("data.csv", "r")) !== FALSE) {
                fgetcsv($handle); // Ignore l'en-tête
                while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $shortDescription = strlen($row[2]) > 50 ? substr($row[2], 0, 50) . "..." : $row[2];
                    $email = isset($row[4]) ? $row[4] : 'Email non disponible';

                    // Calcul de la note moyenne
                    $totalNotes = 0;
                    $nombreNotes = 0;
                    if (($notesHandle = fopen("notes.csv", "r")) !== FALSE) {
                        fgetcsv($notesHandle); // Ignore l'en-tête
                        while (($noteRow = fgetcsv($notesHandle, 1000, ",")) !== FALSE) {
                            if ($noteRow[0] == $row[0]) {
                                $totalNotes += $noteRow[1];
                                $nombreNotes++;
                            }
                        }
                        fclose($notesHandle);
                    }
                    $noteMoyenne = $nombreNotes ? $totalNotes / $nombreNotes : 'Pas encore de notes';

                    echo "<div class='conseil'>";
                    echo "<h3><a href='conseil.php?id={$row[0]}'>{$row[1]}</a></h3>";
                    echo "<p>$shortDescription</p>";
                    echo "<p><strong>Email de l'auteur:</strong> $email</p>";
                    echo "<p><strong>Note moyenne:</strong> $noteMoyenne</p>";
                    echo "<a href='conseil.php?id={$row[0]}' class='voir-plus'>Voir plus</a>";
                    echo "</div>";
                }
                fclose($handle);
            }
            ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Plateforme de Conseils</p>
    </footer>
</body>
</html>
