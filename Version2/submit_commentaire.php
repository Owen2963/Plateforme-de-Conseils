<?php
session_start(); // Démarre la session

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header('Location: login.php'); // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    exit; // Termine le script
}

// Vérifie si le formulaire a été soumis en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupère les données du formulaire
    $conseilId = $_POST['conseil_id']; // ID du conseil auquel le commentaire est associé
    $utilisateur = $_SESSION['email']; // Email de l'utilisateur connecté
    $commentaire = $_POST['commentaire']; // Contenu du commentaire

    // Enregistre le commentaire dans un fichier CSV
    $file = fopen('commentaires.csv', 'a'); // Ouvre le fichier en mode ajout
    fputcsv($file, [$conseilId, $utilisateur, $commentaire]); // Écrit une ligne dans le fichier CSV
    fclose($file); // Ferme le fichier

    // Redirige l'utilisateur vers la page du conseil après avoir soumis le commentaire
    header('Location: conseil.php?id=' . $conseilId); // Redirige vers la page du conseil
    exit; // Termine le script
}
?>
