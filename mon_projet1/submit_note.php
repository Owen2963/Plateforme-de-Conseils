<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conseilId = $_POST['conseil_id'];
    $note = $_POST['note'];

    $file = fopen('notes.csv', 'a');
    fputcsv($file, [$conseilId, $note]);
    fclose($file);

    header('Location: conseil.php?id=' . $conseilId);
    exit;
}
?>
