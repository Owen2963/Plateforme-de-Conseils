<?php
session_start(); // Démarre une nouvelle session en conservant les informations des utlisateurs

// Fonction pour calculer la note moyenne d'un conseil spécifique grâce au fichier csv
function calculerNoteMoyenne($conseilId) {
    $totalNotes = 0;
    $nombreNotes = 0;
    // Ouvre le fichier "notes.csv" en mode lecture
    if (($notesHandle = fopen("notes.csv", "r")) !== FALSE) {
        fgetcsv($notesHandle); // Ignore la première ligne (l'en-tête)
        // Boucle pour lire chaque ligne du fichier CSV
        while (($noteRow = fgetcsv($notesHandle, 1000, ",")) !== FALSE) {
            // Si l'ID du conseil correspond, ajoute la note au total
            if ($noteRow[0] == $conseilId) {
                $totalNotes += $noteRow[1];
                $nombreNotes++;
            }
        }
        fclose($notesHandle); // Ferme le fichier
    }
    // Retourne la moyenne des notes, ou 0 si aucune note
    return $nombreNotes ? $totalNotes / $nombreNotes : 0;
}

// Initialise un tableau pour stocker les conseils
$conseils = [];
// Ouvre le fichier "data.csv" en mode lecture
if (($handle = fopen("data.csv", "r")) !== FALSE) {
    fgetcsv($handle); // Ignore la première ligne (l'en-tête)
    // Boucle pour lire chaque ligne du fichier CSV
    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // Calcule la note moyenne pour le conseil actuel
        $noteMoyenne = calculerNoteMoyenne($row[0]);
        // Ajoute le conseil au tableau $conseils avec les informations nécessaires
        $conseils[] = [
            'id' => $row[0],
            'titre' => $row[1],
            'description' => $row[2],
            'categorie' => $row[3],
            'email' => $row[4],
            'noteMoyenne' => $noteMoyenne
        ];
    }
    fclose($handle); // Ferme le fichier
}

// Trie les conseils par note moyenne décroissante
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
                <?php if (isset($_SESSION['email'])): // Si l'utilisateur est connecté ?>
                    <li><a href="soumettre.php">Soumettre un Conseil</a></li>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="logout.php">Déconnexion</a></li>
                <?php else: // Si l'utilisateur n'est pas connecté ?>
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
            // Affiche chaque conseil
            foreach ($conseils as $conseil) {
                // Coupe la description à 50 caractères, ajoutant "..." si elle est plus longue
                $shortDescription = strlen($conseil['description']) > 50 ? substr($conseil['description'], 0, 50) . "..." : $conseil['description'];
                // Vérifie si l'email de l'auteur est disponible
                $email = isset($conseil['email']) ? $conseil['email'] : 'Email non disponible';
                $noteMoyenne = $conseil['noteMoyenne'];

                // Génère le code HTML pour afficher le conseil
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
