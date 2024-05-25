<?php
  if ($_POST['password'] !== $_POST['confirmation']) {
    die("Les mots de passes ne correspondent pas.");
  }
  $file=fopen('donnees.csv','r+');
  $fil='donnees.csv';
  while(!feof($file)){
    $line=fgets($file);
    $line=trim($line);
    $mots=explode(";",$line);
    for($i=0;$i<count($mots);$i++){
      if($mots[$i]==$_POST['username']){
        die("Ce nom d'utilisateur est déjà utilisé.");
      }
    }
  }
  file_put_contents($fil, $_POST['username'].";".$_POST['password']."\n", FILE_APPEND);
  header('Location: inscrit.html');
  exit;
?>