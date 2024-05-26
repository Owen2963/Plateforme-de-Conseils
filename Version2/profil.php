<?php
// Démarre une nouvelle session ou reprend une session existante
session_start();

// Vérifie si l'utilisateur est connecté en vérifiant la variable de session 'email'
if (!isset($_SESSION['email'])) {
    // Si l'utilisateur n'est pas connecté, redirige vers la page de connexion
    header('Location: login.php');
    exit; // Arrête l'exécution du script
}

// Stocke les informations de l'utilisateur connecté dans un tableau
$utilisateur = [
    'nom' => $_SESSION['nom'],
    'email' => $_SESSION['email']
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"> <!-- Définit l'encodage des caractères à UTF-8 -->
    <title>Profil - Plateforme de Conseils</title> <!-- Titre de la page -->
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS pour le style de la page -->
</head>
<body>
    <header>
        <h1>Profil Utilisateur</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li> <!-- Lien vers la page d'accueil -->
                <li><a href="conseils.php">Conseils</a></li> <!-- Lien vers la page des conseils -->
                <li><a href="soumettre.php">Soumettre un Conseil</a></li> <!-- Lien vers la page de soumission de conseil -->
                <li class="page_actuelle"><a href="profil.php">Profil</a></li> <!-- Lien vers la page de profil, actuellement active -->
                <li><a href="logout.php">Déconnexion</a></li> <!-- Lien pour se déconnecter -->
            </ul>
        </nav>
    </header>
    <main>
        <!-- Affiche un message de bienvenue avec le nom de l'utilisateur -->
        <h2>Bienvenue, <?php echo htmlspecialchars($utilisateur['nom']); ?></h2>
        <!-- Affiche l'email de l'utilisateur -->
        <p>Email: <?php echo htmlspecialchars($utilisateur['email']); ?></p>
    </main>
    <footer>
        <p>&copy; 2024 Plateforme de Conseils</p> <!-- Pied de page avec la mention de copyright -->
    </footer>
</body>
</html>
