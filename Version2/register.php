<?php
// Démarre une nouvelle session ou reprend une session existante
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"> <!-- Définit l'encodage des caractères à UTF-8 -->
    <title>Inscription - Plateforme de Conseils</title> <!-- Titre de la page -->
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS pour le style de la page -->
</head>
<body>
    <header>
        <h1>Inscription</h1> <!-- Titre principal de la page -->
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li> <!-- Lien vers la page d'accueil -->
                <li><a href="conseils.php">Conseils</a></li> <!-- Lien vers la page des conseils -->
                <?php if (isset($_SESSION['email'])): ?> <!-- Vérifie si l'utilisateur est connecté -->
                    <li><a href="soumettre.php">Soumettre un Conseil</a></li> <!-- Lien vers la page de soumission de conseil -->
                    <li><a href="profil.php">Profil</a></li> <!-- Lien vers la page de profil -->
                <?php endif; ?>
                <?php if (!isset($_SESSION['email'])): ?> <!-- Vérifie si l'utilisateur n'est pas connecté -->
                    <li class="page_actuelle"><a href="register.php">Inscription</a></li> <!-- Lien vers la page d'inscription, actuellement active -->
                    <li><a href="login.php">Connexion</a></li> <!-- Lien vers la page de connexion -->
                <?php else: ?>
                    <li><a href="logout.php">Déconnexion</a></li> <!-- Lien pour se déconnecter -->
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <!-- Formulaire d'inscription -->
        <form action="register1.php" method="post">
            <label for="nom">Nom:</label> <!-- Label pour le champ "Nom" -->
            <input type="text" id="nom" name="nom" required><br> <!-- Champ de saisie pour le nom, obligatoire -->
            <label for="email">Email:</label> <!-- Label pour le champ "Email" -->
            <input type="email" id="email" name="email" required><br> <!-- Champ de saisie pour l'email, obligatoire -->
            <label for="password">Mot de passe:</label> <!-- Label pour le champ "Mot de passe" -->
            <input type="password" id="password" name="password" required><br> <!-- Champ de saisie pour le mot de passe, obligatoire -->
            <input type="submit" value="S'inscrire"> <!-- Bouton pour soumettre le formulaire -->
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Plateforme de Conseils</p> <!-- Pied de page avec la mention de copyright -->
    </footer>
</body>
</html>
