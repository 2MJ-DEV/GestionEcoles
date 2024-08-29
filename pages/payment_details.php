<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTE ETUDIANTS</title>
    <!-- Inclusion des feuilles de style Bootstrap et personnalisées -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body class="bg-content">
    <main class="dashboard d-flex">
        <!-- Inclusion de la barre latérale -->
        <?php 
            include "component/sidebar.php";
        ?>
        <!-- Fin de la barre latérale -->

        <!-- Début du contenu de la page -->
        <div class="container-fluid px-4">
        <?php 
            include "component/header.php";
        ?>

            <!-- En-tête de la liste des étudiants avec le bouton pour accéder au formulaire de paiement -->
            <div class="student-list-header d-flex justify-content-between align-items-center py-2">
                <div class="title h6 fw-bold">DETAILS DES PAIEMENTS</div>
                <div class="btn-add d-flex gap-3 align-items-center">
                    <!-- Bouton pour trier (si nécessaire) -->
                    <div class="short">
                        <i class="far fa-sort"></i>
                    </div>
                    <!-- Bouton pour accéder au formulaire de paiement -->
                    <a href="formulaire_paiement.php" class="btn btn-success">
                        <i class="fas fa-credit-card"></i> Formulaire de Paiement
                    </a>
                </div>
            </div>

            <!-- Début du tableau affichant la liste des paiements des étudiants -->
            <div class="table table-responsive">
                <table class="table table-striped table-borderless">
                    <thead>
                        <tr class="py-3">
                            <th>Nom</th>
                            <th>Paiement</th>
                            <th>Numéro de téléphone</th>
                            <th>Montant</th>
                            <th>Balance</th>
                            <th>Date </th>
                            <th class="opacity-0">liste</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Connexion à la base de données
                        include 'connexiondb.php';

                        // Requête pour récupérer les données de la table payments_list
                        $requete = "SELECT * FROM payments_list";
                        $result = $con->query($requete);

                        // Boucle pour afficher chaque ligne de paiement
                        foreach($result as $value):
                        ?>
                            <tr>
                                <td><?php echo $value['Name'] ?></td>
                                <td><?php echo $value['PaymentSchedule'] ?></td>
                                <td><?php echo $value['BillNumber'] ?></td>
                                <td><?php echo $value['AmountPaid'] ?></td>
                                <td><?php echo $value['BalanceAmount'] ?></td>
                                <td><?php echo $value['Date'] ?></td>
                                <td><i class="fal fa-eye"></i></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Fin du tableau de la liste des paiements des étudiants -->
        </div>
        <!-- Fin du contenu de la page -->
    </main>

    <!-- Inclusion des scripts JavaScript de Bootstrap et personnalisés -->
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/script.js"></script>
</body>

</html>
