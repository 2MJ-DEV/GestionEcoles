<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    <!-- Inclusion des feuilles de style Bootstrap et personnalisée -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- Inclusion des icônes FontAwesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body class="bg-content">
    <main class="dashboard d-flex">
        <!-- Inclusion de la barre latérale -->
        <?php include "component/sidebar.php"; ?>

        <div class="container-fluid px-4">
            <!-- Inclusion de l'en-tête -->
            <?php include "component/header.php"; ?>

            <!-- En-tête de la liste des étudiants -->
            <div class="student-list-header d-flex justify-content-between align-items-center py-2">
                <div class="title h6 fw-bold">LISTE DES ETUDIANTS</div>
                <div class="btn-add d-flex gap-3 align-items-center">
                    <div class="short">
                        <i class="far fa-sort"></i>
                    </div>
                    <!-- <a href="export_csv.php" class="btn btn-success">Télécharger l'historique des présences</a> -->
                    <?php include 'component/popupadd.php'; ?>
                </div>
            </div>

            <!-- Table des étudiants -->
            <div class="table-responsive">
                <form action="save_presence.php" method="POST">
                    <table class="table student_list table-borderless">
                        <thead>
                            <tr class="align-middle">
                                <!-- <th>Elèves</th> -->
                                <th>Noms</th>
                                <th>Etat Frais</th>
                                <th>Promotion</th>
                                <th>Numéro Téléphone</th>
                                <th>Mise à jour</th>
                                <!-- <th>Présence</th> -->
                                <!-- <th>Actions</th> -->
                                <!-- <th>QR Code</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Récupération des données des étudiants depuis la base de données -->
                            <?php include 'connexiondb.php';
                                $result = $con->query("SELECT * FROM students_list");
                                foreach($result as $value):
                            ?>
                            <tr class="bg-white align-middle">
                                <!-- Affichage de l'image de l'étudiant -->
                                <!-- <td><img src="../assets/img/<?php echo htmlspecialchars($value['img']) ?>" alt="img" height="50" width="50"></td> -->
                                <!-- Affichage des informations de l'étudiant -->
                                <td><?php echo htmlspecialchars($value['Name']) ?></td>
                                <td><?php echo htmlspecialchars($value['Paiement']) ?></td>
                                <td><?php echo htmlspecialchars($value['Promotion']) ?></td>
                                <td><?php echo htmlspecialchars($value['NumeroTelephone']) ?></td>
                                <td><?php echo htmlspecialchars($value['DateUpDate']) ?></td>
                                <td class="d-md-flex gap-3 mt-3">
                                    <!-- Icône pour modifier l'étudiant -->
                                    <a href="modifier.php?Id=<?php echo $value['Id']?>"><i class="far fa-pen" style="color: green;"></i></a>
                                    <!-- Icône pour supprimer l'étudiant -->
                                    <a href="remove.php?Id=<?php echo $value['Id']?>"><i class="far fa-trash" style="color: black;"></i></a>
                                    <!-- Bouton pour voir les détails de l'étudiant -->
                                    <a href="student_info.php?Id=<?php echo $value['Id']?>" class="btn btn-info">Voir</a>
                                </td>
                                <td>
                                    <!-- <a href="generate_qr.php?Id=<?php echo $value['Id'] ?>" class="btn btn-primary">Générer QR Code</a> -->
                                </td>
                            </tr> 
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- <button type="submit" name="submit_presence" class="btn btn-primary">Enregistrer la présence</button> -->
                </form>
            </div>
        </div>
    </main>
    <!-- Inclusion des scripts JavaScript -->
    <script src="../js/script.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
</body>

</html>
