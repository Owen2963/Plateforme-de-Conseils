<?php
// Reprend la session existante
session_start();

// Supprime toutes les variables de session
session_unset();

// Détruit la session actuelle
session_destroy();

// Supprime le cookie en définissant son expiration à une heure passée
setcookie("user", "", time() - 3600, "/");

// Redirige l'utilisateur vers la page d'accueil
header('Location: index.php');
exit; // Arrête l'exécution du script
?>
