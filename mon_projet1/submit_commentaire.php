<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conseilId = $_POST['conseil_id'];
    $utilisateur = $_SESSION['email'];
    $commentaire = $_POST['commentaire'];

    $file = fopen('commentaires.csv', 'a');
    fputcsv($file, [$conseilId, $utilisateur, $commentaire]);
    fclose($file);

    header('Location: conseil.php?id=' . $conseilId);
    exit;
}
?>
