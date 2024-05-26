<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Soumettre un Conseil - Plateforme de Conseils</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Soumettre un Conseil</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="conseils.php">Conseils</a></li>
                <li class="page_actuelle"><a href="soumettre.php">Soumettre un Conseil</a></li>
                <li><a href="profil.php">Profil</a></li>
                <?php if (!isset($_SESSION['email'])): ?>
                    <li><a href="register.php">Inscription</a></li>
                    <li><a href="login.php">Connexion</a></li>
                <?php else: ?>
                    <li><a href="logout.php">Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <form action="submit_conseil.php" method="post">
            <label for="titre">Titre:</label>
            <input type="text" id="titre" name="titre" required><br>
            <label for="categorie">Catégorie:</label>
            <input type="text" id="categorie" name="categorie" required><br>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea><br>
            <input type="submit" value="Soumettre">
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Plateforme de Conseils</p>
    </footer>
</body>
</html>
