<?php
session_start(); // Démarre une nouvelle session en conservant les informations des utlisateurs
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Plateforme de Conseils</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS pour le style de la page -->
</head>
<body>
    <header>
        <h1>Connexion</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li> <!-- Lien vers la page d'accueil -->
                <li><a href="conseils.php">Conseils</a></li> <!-- Lien vers la page des conseils -->
                <!-- Vérifie si l'utilisateur est connecté -->
                <?php if (isset($_SESSION['email'])): ?>
                    <li><a href="soumettre.php">Soumettre un Conseil</a></li> <!-- Lien vers la page de soumission de conseil -->
                    <li><a href="profil.php">Profil</a></li> <!-- Lien vers la page de profil -->
                    <li><a href="logout.php">Déconnexion</a></li> <!-- Lien pour se déconnecter -->
                <?php else: ?>
                    <li><a href="register.php">Inscription</a></li> <!-- Lien vers la page d'inscription -->
                    <li class="page_actuelle"><a href="login.php">Connexion</a></li> <!-- Lien vers la page de connexion (page actuelle) -->
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <!-- Affiche un message d'erreur si les informations de connexion sont incorrectes -->
        <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
            <p style="color: red;">Email ou mot de passe incorrect.</p>
        <?php endif; ?>
        <!-- Formulaire de connexion -->
        <form action="login1.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br> <!-- Champ pour l'email, requis -->
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required><br> <!-- Champ pour le mot de passe, requis -->
            <input type="submit" value="Se connecter"> <!-- Bouton pour soumettre le formulaire -->
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Plateforme de Conseils</p> <!-- Pied de page -->
    </footer>
</body>
</html>
