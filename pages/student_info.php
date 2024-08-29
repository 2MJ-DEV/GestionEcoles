<?php
// Connexion à la base de données
try {
    // Connexion à la base de données MySQL avec PDO
    $con = new PDO("mysql:host=localhost;dbname=bac-1-universite", "root", "");
    // Définir le mode d'erreur PDO pour lancer des exceptions
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Afficher un message d'erreur si la connexion échoue
    echo "Connexion échouée: " . $e->getMessage();
    exit();
}

// Récupérer l'ID de l'étudiant depuis l'URL
$student_id = $_GET['Id'];

// Requête pour récupérer les informations de l'étudiant
$sql = "SELECT * FROM students_list WHERE Id = :id";
$stmt = $con->prepare($sql);
$stmt->bindParam(':id', $student_id);
$stmt->execute();
$student = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si les informations de l'étudiant ont été trouvées
if ($student) {
?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Informations Étudiant</title>
        <style>
            /* Style de base pour le corps de la page */
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #e9ecef;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            /* Style pour la carte de profil */
            .profile-card {
                background-color: #fff;
                border-radius: 12px;
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
                padding: 25px;
                max-width: 450px;
                width: 100%;
                text-align: center;
                transition: transform 0.3s, box-shadow 0.3s;
            }

            /* Animation au survol de la carte */
            .profile-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
            }

            /* Style pour l'image de l'étudiant */
            .profile-card header img {
                border-radius: 50%;
                margin-bottom: 20px;
                width: 120px;
                height: 120px;
                object-fit: cover;
                transition: transform 0.3s;
            }

            /* Agrandir l'image au survol */
            .profile-card header img:hover {
                transform: scale(1.1);
            }

            /* Style pour le nom de l'étudiant */
            .profile-card h1 {
                margin: 0;
                font-size: 26px;
                color: #343a40;
            }

            /* Style pour la promotion de l'étudiant */
            .profile-card h2 {
                margin: 8px 0 25px;
                font-size: 20px;
                color: #6c757d;
            }

            /* Style pour la section biographique */
            .profile-bio {
                margin: 20px 0;
            }

            /* Style pour les paragraphes de la biographie */
            .profile-bio p {
                font-size: 16px;
                color: #495057;
                margin: 8px 0;
            }

            /* Style pour les liens sociaux (cachés pour l'instant) */
            .profile-social-links {
                list-style: none;
                padding: 0;
                display: flex;
                justify-content: center;
                margin: 20px 0 0;
            }

            /* Espacement entre les liens sociaux */
            .profile-social-links li {
                margin: 0 15px;
            }

            /* Style des icônes des liens sociaux */
            .profile-social-links li a img {
                width: 28px;
                height: 28px;
                transition: opacity 0.3s;
            }

            /* Réduire l'opacité au survol des icônes sociales */
            .profile-social-links li a img:hover {
                opacity: 0.7;
            }

            /* Style pour le bouton de retour */
            .back-button {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #007bff;
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
                font-size: 16px;
                transition: background-color 0.3s;
                cursor: pointer;
            }

            /* Changement de couleur au survol du bouton de retour */
            .back-button:hover {
                background-color: #0056b3;
            }

            /* Style pour l'icône de flèche dans le bouton de retour */
            .back-button img {
                vertical-align: middle;
                margin-right: 8px;
                width: 20px;
                height: 20px;
            }

            /* Style pour l'icône d'étudiant en haut de la page */
            .student-icon {
                width: 60px;
                height: 60px;
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <aside class="profile-card">
            <header>
                <!-- Icône d'étudiant au-dessus du nom -->
                <img src="https://img.icons8.com/ios-filled/50/000000/student-male.png" alt="Étudiant" class="student-icon">
                
                <!-- Affichage dynamique du nom de l'étudiant -->
                <h1><?php echo htmlspecialchars($student['Name']); ?></h1>
                
                <!-- Affichage dynamique de la promotion de l'étudiant -->
                <h2><?php echo htmlspecialchars($student['Promotion']); ?></h2>
            </header>
            <div class="profile-bio">
                <!-- Affichage dynamique de l'email de l'étudiant -->
                <p>Paiement : <?php echo htmlspecialchars($student['Paiement']); ?></p>
                
                <!-- Affichage dynamique du numéro matricule de l'étudiant -->
                <p>Numéro Téléphone : <?php echo htmlspecialchars($student['NumeroTelephone']); ?></p>
                
                <!-- Affichage dynamique de la date d'ajout de l'étudiant -->
                <p>Mise à jours : <?php echo htmlspecialchars($student['DateUpDate']); ?></p>
            </div>
            <ul class="profile-social-links">
                <!-- Icônes des réseaux sociaux (commentées pour l'instant) -->
                <!-- <li><a href="#"><img src="assets/icons/email.png" alt="Email"></a></li> -->
                <!-- <li><a href="#"><img src="assets/icons/phone.png" alt="Phone"></a></li> -->
            </ul>
            
            <!-- Bouton de retour avec une icône de flèche -->
            <a href="javascript:history.back()" class="back-button">
                <img src="https://img.icons8.com/ios-filled/50/ffffff/left.png" alt="Retour"> Retour
            </a>
        </aside>
    </body>
    </html>
<?php
} else {
    // Message d'erreur si l'étudiant n'est pas trouvé
    echo "Étudiant non trouvé.";
}
?>
