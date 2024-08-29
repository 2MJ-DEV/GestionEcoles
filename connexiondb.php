<?php 
    try {
      $con = new PDO("mysql:host=localhost;dbname=bac-1-universite", "root", ""); // Remplace "root" et "password" par tes propres informations
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
      echo "Connexion échouée: " . $e->getMessage();
      exit();
  }
  
?>