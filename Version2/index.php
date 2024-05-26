<?php
session_start();

function calculerNoteMoyenne($conseilId) {
    $totalNotes = 0;
    $nombreNotes = 0;
    if (($notesHandle = fopen("notes.csv", "r")) !== FALSE) {
        fgetcsv($notesHandle); // Ignore l'en-tête
        while (($noteRow = fgetcsv($notesHandle, 1000, ",")) !== FALSE) {
            if ($noteRow[0] == $conseilId) {
                $totalNotes += $noteRow[1];
                $nombreNotes++;
            }
        }
        fclose($notesHandle);
    }
    return $nombreNotes ? $totalNotes / $nombreNotes : 0;
}

$conseils = [];
if (($handle = fopen("data.csv", "r")) !== FALSE) {
    fgetcsv($handle); // Ignore l'en-tête
    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $noteMoyenne = calculerNoteMoyenne($row[0]);
        $conseils[] = [
            'id' => $row[0],
            'titre' => $row[1],
            'description' => $row[2],
            'categorie' => $row[3],
            'email' => $row[4],
            'noteMoyenne' => $noteMoyenne
        ];
    }
    fclose($handle);
}

// Trier les conseils par note moyenne décroissante
usort($conseils, function($a, $b) {
    return $b['noteMoyenne'] <=> $a['noteMoyenne'];
});
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
                <li class="page_actuelle"><a href="index.php">Accueil</a></li>
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
            foreach ($conseils as $conseil) {
                $shortDescription = strlen($conseil['description']) > 50 ? substr($conseil['description'], 0, 50) . "..." : $conseil['description'];
                $email = isset($conseil['email']) ? $conseil['email'] : 'Email non disponible';
                $noteMoyenne = $conseil['noteMoyenne'];

                echo "<div class='conseil'>";
                echo "<h3><a href='conseil.php?id={$conseil['id']}'>{$conseil['titre']}</a></h3>";
                echo "<p>$shortDescription</p>";
                echo "<p><strong>Email de l'auteur:</strong> $email</p>";
                echo "<p><strong>Note moyenne:</strong> $noteMoyenne</p>";
                echo "<a href='conseil.php?id={$conseil['id']}' class='voir-plus'>Voir plus</a>";
                echo "</div>";
            }
            ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Plateforme de Conseils</p>
    </footer>
</body>
</html>
