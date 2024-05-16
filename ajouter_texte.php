<?php



$nom_dossier = "Articles/";

// Créer le dossier
if (!file_exists($nom_dossier)) {
    mkdir($nom_dossier);
    echo "Le dossier $nom_dossier a été créé.";
}


if (isset($_POST['submit'])) {
    // Vérifier si le champ de texte n'est pas vide

    if (!empty($_POST['content'])) {
        $titre = $_POST['titre'];

        
        // Générer un nom de fichier unique basé sur la date et l'heure actuelles
        $filename = $nom_dossier."Article_". $titre ."_". date("Ymd_His") . ".txt";
        
        // Récupérer le contenu du champ de texte
        $content = $_POST['content'];
        
        // Écrire le contenu dans le fichier texte
        file_put_contents($filename, $content);
        
        echo "Le document texte a été créé avec succès !";
       echo "<script>setTimeout(function(){window.location.href='index.html';}, 100);</script>";

        
       
    } else {
        echo "Veuillez saisir du texte pour créer le document.";
       
    }
}
?>

