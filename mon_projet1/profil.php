<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.html');
    exit;
}

$utilisateur = [
    'nom' => $_SESSION['nom'],
    'email' => $_SESSION['email']
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil - Plateforme de Conseils</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Profil Utilisateur</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="conseils.php">Conseils</a></li>
                <li><a href="soumettre.php">Soumettre un Conseil</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Bienvenue, <?php echo $utilisateur['nom']; ?></h2>
        <p>Email: <?php echo $utilisateur['email']; ?></p>
    </main>
    <footer>
        <p>&copy; 2024 Plateforme de Conseils</p>
    </footer>
</body>
</html>
