<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Définition de l'encodage des caractères pour le document -->
    <meta charset="UTF-8">
    <!-- Compatibilité avec les versions d'Internet Explorer -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Configuration de la fenêtre pour un affichage réactif -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre du document -->
    <title>Document</title>
    <!-- Lien vers le fichier CSS de Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <!-- Lien vers le fichier CSS personnalisé -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <!-- Début du corps du document avec centrage vertical et horizontal -->

    <?php
        // Démarrage de la session
        session_start();
        // Inclusion du fichier de connexion à la base de données
        include 'connexiondb.php';
        // Stocker l'ID de l'étudiant dans la session après l'avoir récupéré de l'URL
        $_SESSION["id"] = $_GET['Id'];
        // Assigner l'ID de l'étudiant à une variable locale
        $id = $_SESSION["id"];
        // Préparation de la requête SQL pour récupérer les données de l'étudiant en fonction de son ID
        $statement = $con -> prepare("SELECT * FROM students_list WHERE Id = $id");
        // Exécution de la requête
        $statement->execute();
        // Récupération du résultat sous forme de tableau associatif
        $table = $statement -> fetch();
    ?>

    <!-- Conteneur principal centré contenant le formulaire -->
    <div class="container w-50 border p-4 shadow rounded bg-light">
        <!-- Formulaire pour mettre à jour les informations de l'étudiant -->
        <form method="POST" action="update.php" enctype="multipart/form-data">
            <!-- Champ pour entrer/modifier le nom de l'étudiant -->
            <div class="">
                <label for="recipient-name" class="col-form-label">Nom:</label>
                <!-- Champ de texte pré-rempli avec la valeur actuelle du nom -->
                <input type="text" class="form-control" id="recipient-name" name="Name" value="<?php echo $table['Name']?>">
            </div>
            <!-- Champ pour entrer/modifier l'état des frais de l'étudiant -->
            <div class="">
                <label for="recipient-name" class="col-form-label">Etat frais:</label>
                <!-- Champ de texte pré-rempli avec la valeur actuelle de l'état des frais -->
                <input type="text" class="form-control" id="recipient-name" name="Paiement" value="<?php echo $table['Paiement']?>">
            </div>
            <!-- Champ pour entrer/modifier la promotion de l'étudiant -->
            <div class="">
                <label for="recipient-name" class="col-form-label">Promotion:</label>
                <!-- Champ de texte pré-rempli avec la valeur actuelle de la promotion -->
                <input type="text" class="form-control" id="recipient-name" name="Promotion" value="<?php echo $table['Promotion']?>">
            </div>
            <!-- Champ pour entrer/modifier le numéro de téléphone de l'étudiant -->
            <div class="">
                <label for="recipient-name" class="col-form-label">Numéro téléphone:</label>
                <!-- Champ de texte pré-rempli avec la valeur actuelle du numéro de téléphone -->
                <input type="text" class="form-control" id="recipient-name" name="NumeroTelephone" value="<?php echo $table['NumeroTelephone']?>">
            </div>
            <!-- Champ pour entrer/modifier la date de la dernière mise à jour -->
            <div class="">
                <label for="recipient-name" class="col-form-label">Mise à jour:</label>
                <!-- Champ de texte pré-rempli avec la valeur actuelle de la date de mise à jour -->
                <input type="date" class="form-control" id="recipient-name" name="DateUpDate" value="<?php echo $table['DateUpDate']?>">
            </div>
            <!-- Bouton pour soumettre le formulaire et enregistrer les modifications -->
            <div class="modal-footer">
                <button type="submit" name="submit" class="btn btn-primary">Valider</button>
            </div>
        </form>
    </div>

    <!-- Inclusion du fichier JavaScript principal -->
    <script src="../js/script.js"></script>
    <!-- Inclusion du fichier JavaScript de Bootstrap -->
    <script src="../js/bootstrap.bundle.js"></script>
</body>
</html>
