<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Plateforme de Conseils</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Inscription</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="conseils.php">Conseils</a></li>
                <?php if (isset($_SESSION['email'])): ?>
                    <li><a href="soumettre.php">Soumettre un Conseil</a></li>
                    <li><a href="profil.php">Profil</a></li>
                <?php endif; ?>
                <?php if (!isset($_SESSION['email'])): ?>
                    <li class="page_actuelle"><a href="register.php">Inscription</a></li>
                    <li><a href="login.php">Connexion</a></li>
                <?php else: ?>
                    <li><a href="logout.php">Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <form action="register1.php" method="post">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="S'inscrire">
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Plateforme de Conseils</p>
    </footer>
</body>
</html>
