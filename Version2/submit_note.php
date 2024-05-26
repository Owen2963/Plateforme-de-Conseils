<?php
session_start(); // Démarre la session

// Vérifie si l'utilisateur est connecté, sinon le redirige vers la page de connexion
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

// Vérifie si la requête est de type POST (c'est-à-dire si le formulaire a été soumis)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conseilId = $_POST['conseil_id']; // Récupère l'ID du conseil depuis le formulaire
    $note = $_POST['note']; // Récupère la note attribuée depuis le formulaire

    // Ouvre le fichier CSV des notes en mode ajout
    $file = fopen('notes.csv', 'a');
    // Ajoute une nouvelle ligne au fichier CSV contenant l'ID du conseil et la note attribuée
    fputcsv($file, [$conseilId, $note]);
    fclose($file); // Ferme le fichier

    // Redirige l'utilisateur vers la page du conseil après la soumission de la note
    header('Location: conseil.php?id=' . $conseilId);
    exit; // Termine le script
}
?>
