<?php
// Traitement du formulaire d'ajout de cours
if (isset($_POST['submit'])) {
    // Inclure le fichier de connexion à la base de données
    include 'connexiondb.php';

    // Récupérer les données envoyées par le formulaire
    $cours = $_POST['Cours'];
    $description = $_POST['Description'];
    $promotion = $_POST['Promotion'];

    // Préparer la requête d'insertion avec des paramètres
    $sql = "INSERT INTO courses (Cours, Description, Promotion) VALUES (?, ?, ?)";
    $stmt = $con->prepare($sql);

    // Exécuter la requête et vérifier si l'insertion a réussi
    if ($stmt->execute([$cours, $description, $promotion])) {
        $message = "Cours ajouté avec succès!";
        $alert_type = "success";
    } else {
        $message = "Erreur lors de l'ajout du cours.";
        $alert_type = "danger";
    }
}

// Traitement du formulaire de modification de cours
if (isset($_POST['update'])) {
    // Inclure le fichier de connexion à la base de données
    include 'connexiondb.php';

    // Récupérer les données envoyées par le formulaire
    $id = $_POST['id'];
    $cours = $_POST['Cours'];
    $description = $_POST['Description'];
    $promotion = $_POST['Promotion'];

    // Préparer la requête de mise à jour avec des paramètres
    $sql = "UPDATE courses SET Cours = ?, Description = ?, Promotion = ? WHERE id = ?";
    $stmt = $con->prepare($sql);

    // Exécuter la requête et vérifier si la mise à jour a réussi
    if ($stmt->execute([$cours, $description, $promotion, $id])) {
        $message = "Cours mis à jour avec succès!";
        $alert_type = "success";
    } else {
        $message = "Erreur lors de la mise à jour du cours.";
        $alert_type = "danger";
    }
}

// Traitement du formulaire de suppression de cours
if (isset($_POST['delete'])) {
    // Inclure le fichier de connexion à la base de données
    include 'connexiondb.php';

    // Récupérer l'identifiant du cours à supprimer
    $id = $_POST['id'];

    // Préparer la requête de suppression avec un paramètre
    $sql = "DELETE FROM courses WHERE id = ?";
    $stmt = $con->prepare($sql);

    // Exécuter la requête et vérifier si la suppression a réussi
    if ($stmt->execute([$id])) {
        $message = "Cours supprimé avec succès!";
        $alert_type = "success";
    } else {
        $message = "Erreur lors de la suppression du cours.";
        $alert_type = "danger";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTE DES COURS</title>
    <!-- Inclure les feuilles de style Bootstrap et personnalisées -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- Inclure la feuille de style FontAwesome pour les icônes -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>
<body class="bg-content">
    <main class="dashboard d-flex">
        <!-- Inclure la barre latérale -->
        <?php 
            include "component/sidebar.php";
        ?>
        <div class="container-fluid px-4">
            <!-- Inclure l'en-tête -->
            <?php 
                include "component/header.php";
            ?>
            <div class="button-add-student">
                <!-- Bouton pour ajouter un cours -->
                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                    Ajouter un cours
                </button>

                <!-- Modal pour ajouter un cours -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ajouter un cours</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Formulaire pour ajouter un cours -->
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="">
                                        <label for="recipient-name" class="col-form-label">Nom:</label>
                                        <input type="text" class="form-control" id="recipient-name" name="Cours">
                                    </div>
                                    <div class="">
                                        <label for="recipient-name" class="col-form-label">Description:</label>
                                        <input type="text" class="form-control" id="recipient-name" name="Description">
                                    </div>
                                    <div class="">
                                        <label for="recipient-name" class="col-form-label">Promotion:</label>
                                        <input type="text" class="form-control" id="recipient-name" name="Promotion">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal pour les alertes -->
            <?php if (isset($message)): ?>
            <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="alertModalLabel"><?php echo $alert_type == 'success' ? 'Succès' : 'Erreur'; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php echo $message; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="courses">
                <!-- Tableau affichant la liste des cours -->
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Cours</th>
                            <th>Description</th>
                            <th>Promotion</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php 
                        // Inclure le fichier de connexion à la base de données
                        include 'connexiondb.php'; 
                        // Préparer la requête pour récupérer tous les cours
                        $requete = "SELECT * FROM courses";
                        $result = $con->query($requete);

                        // Boucler à travers chaque résultat et afficher dans le tableau
                        foreach ($result as $value):
                        ?>
                        <tr> 
                            <td><?php echo htmlspecialchars($value['Cours']); ?></td>
                            <td><?php echo htmlspecialchars($value['Description']); ?></td>
                            <td><?php echo htmlspecialchars($value['Promotion']); ?></td>
                            <td>
                                <!-- Bouton pour modifier un cours -->
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $value['id']; ?>">
                                    Modifier
                                </button>

                                <!-- Modal de modification -->
                                <div class="modal fade" id="editModal<?php echo $value['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Modifier le cours</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Formulaire pour modifier un cours -->
                                                <form method="POST" action="">
                                                    <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
                                                    <div class="">
                                                        <label for="edit-cours" class="col-form-label">Nom:</label>
                                                        <input type="text" class="form-control" id="edit-cours" name="Cours" value="<?php echo htmlspecialchars($value['Cours']); ?>">
                                                    </div>
                                                    <div class="">
                                                        <label for="edit-description" class="col-form-label">Description:</label>
                                                        <input type="text" class="form-control" id="edit-description" name="Description" value="<?php echo htmlspecialchars($value['Description']); ?>">
                                                    </div>
                                                    <div class="">
                                                        <label for="edit-promotion" class="col-form-label">Promotion:</label>
                                                        <input type="text" class="form-control" id="edit-promotion" name="Promotion" value="<?php echo htmlspecialchars($value['Promotion']); ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                        <button type="submit" name="update" class="btn btn-primary">Mettre à jour</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Formulaire de suppression -->
                                <form method="POST" action="" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <!-- Inclure les scripts JavaScript pour Bootstrap et votre propre script -->
    <script src="../js/script.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>

    <!-- Script pour déclencher le modal d'alerte si un message est défini -->
    <script>
        <?php if (isset($message)): ?>
        var alertModal = new bootstrap.Modal(document.getElementById('alertModal'));
        alertModal.show();
        <?php endif; ?>
    </script>
</body>
</html>
