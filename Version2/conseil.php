<?php
session_start(); // Démarre la session
$id = isset($_GET['id']) ? $_GET['id'] : ''; // Récupère l'ID du conseil depuis l'URL
$conseil = null;

// Lit le fichier CSV contenant les données des conseils
if (($handle = fopen("data.csv", "r")) !== FALSE) {
    fgetcsv($handle); // Ignore l'en-tête
    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($row[0] == $id) {
            $conseil = $row; // Stocke les données du conseil correspondant à l'ID
            break;
        }
    }
    fclose($handle);
}

// Si le conseil n'est pas trouvé, affiche un message et arrête le script
if ($conseil === null) {
    echo "Conseil non trouvé.";
    exit;
}

// Calcul de la note moyenne du conseil
$totalNotes = 0;
$nombreNotes = 0;
if (($handle = fopen("notes.csv", "r")) !== FALSE) {
    fgetcsv($handle); // Ignore l'en-tête
    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($row[0] == $id) {
            $totalNotes += $row[1];
            $nombreNotes++;
        }
    }
    fclose($handle);
}
$noteMoyenne = $nombreNotes ? $totalNotes / $nombreNotes : 'Pas encore de notes';

// Récupération des commentaires associés au conseil
$commentaires = [];
if (($handle = fopen("commentaires.csv", "r")) !== FALSE) {
    fgetcsv($handle); // Ignore l'en-tête
    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($row[0] == $id) {
            $commentaires[] = $row; // Stocke les commentaires associés au conseil
        }
    }
    fclose($handle);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $conseil[1]; ?> - Plateforme de Conseils</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1><?php echo $conseil[1]; ?></h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li class="page_actuelle"><a href="conseils.php">Conseils</a></li>
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
        <article>
            <h2><?php echo $conseil[1]; ?></h2>
            <p><?php echo nl2br($conseil[2]); ?></p> <!-- Affiche la description du conseil -->
            <p><strong>Email de l'auteur:</strong> <?php echo $conseil[4]; ?></p>
            <p><strong>Note moyenne:</strong> <?php echo $noteMoyenne; ?></p>
            <h3>Commentaires</h3>
            <?php foreach ($commentaires as $commentaire): ?>
                <p><strong><?php echo $commentaire[1]; ?>:</strong> <?php echo $commentaire[2]; ?></p> <!-- Affiche les commentaires associés -->
            <?php endforeach; ?>
            <h3>Ajouter un commentaire</h3>
            <?php if (isset($_SESSION['email'])): ?>
                <form action="submit_commentaire.php" method="post"> <!-- Formulaire pour soumettre un commentaire -->
                    <input type="hidden" name="conseil_id" value="<?php echo $id; ?>">
                    <label for="commentaire">Commentaire:</label><br>
                    <textarea id="commentaire" name="commentaire" required></textarea><br>
                    <button type="submit">Soumettre</button>
                </form>
                <h3>Noter ce conseil</h3>
                <form action="submit_note.php" method="post"> <!-- Formulaire pour soumettre une note -->
                    <input type="hidden" name="conseil_id" value="<?php echo $id; ?>">
                    <label for="note">Note:</label><br>
                    <select id="note" name="note" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select><br>
                    <button type="submit">Soumettre</button>
                </form>
            <?php else: ?>
                <p><a href="login.php">Connectez-vous</a> pour ajouter un commentaire ou noter ce conseil.</p>
            <?php endif; ?>
            <a href="conseils.php" class="voir-moins">Voir moins</a>
        </article>
    </main>
    <footer>
        <p>&copy; 2024 Plateforme de Conseils</p>
    </footer>
</body>
</html>
