<?php
// Vérifie si la méthode de la requête est POST (lorsqu'un formulaire est soumis)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupère l'email et le mot de passe soumis par l'utilisateur
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Lire le fichier CSV des utilisateurs et le convertir en tableau
    $data = array_map('str_getcsv', file('users.csv'));
    $user = null;
    
    // Parcourt chaque ligne du tableau pour trouver l'utilisateur correspondant
    foreach ($data as $row) {
        // Vérifie si l'email correspond et si le mot de passe est correct
        if ($row[1] == $email && password_verify($password, $row[2])) {
            $user = $row; // Utilisateur trouvé
            break; // Sort de la boucle
        }
    }

    // Si l'utilisateur est trouvé
    if ($user) {
        // Démarre une nouvelle session ou reprend une session existante
        session_start();
        // Stocke le nom et l'email de l'utilisateur dans la session
        $_SESSION['nom'] = $user[0];
        $_SESSION['email'] = $user[1];
        // Crée un cookie pour l'utilisateur qui expire dans 30 jours
        setcookie("user", $user[1], time() + (86400 * 30), "/");
        // Redirige vers la page de profil
        header('Location: profil.php');
    } else {
        // Si l'utilisateur n'est pas trouvé, redirige vers la page de connexion avec un message d'erreur
        header('Location: login.php?error=1');
    }
    exit; // Arrête l'exécution du script
}
?>
