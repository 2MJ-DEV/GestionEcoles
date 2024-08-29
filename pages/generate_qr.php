<?php
include('phpqrcode/qrlib.php'); // Inclure la bibliothèque QR Code

// Connexion à la base de données
try {
    $con = new PDO("mysql:host=localhost;dbname=bac-1-universite", "root", ""); // Remplace "root" et "password" par tes propres informations
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
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

if ($student) {
    // Contenu du QR code avec les informations de l'étudiant
    $qr_content = "Nom: " . $student['Name'] . "\n" .
                  "Email: " . $student['Email'] . "\n" .
                  "Promotion: " . $student['Promotion'] . "\n" .
                  "Numéro Matricule: " . $student['NumeroMatricule'];

    // Génération du QR Code et enregistrement en tant qu'image
    $qr_image = 'qrcodes/student_' . $student_id . '.png';
    QRcode::png($qr_content, $qr_image, QR_ECLEVEL_L, 10);

    // Téléchargement du QR code
    header('Content-Type: image/png');
    header('Content-Disposition: attachment; filename="qr_code_student_' . $student_id . '.png"');
    readfile($qr_image);
    exit();

} else {
    echo "Étudiant non trouvé.";
    exit();
}
?>
