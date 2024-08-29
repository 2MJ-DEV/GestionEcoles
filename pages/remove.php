<?php
include 'connexiondb.php';

if (isset($_GET['Id'])) {
    $student_id = $_GET['Id'];

    // Supprimer les enregistrements associés dans attendance_history
    $con->prepare("DELETE FROM attendance_history WHERE student_id = ?")->execute([$student_id]);

    // Supprimer l'étudiant dans students_list
    $requete = $con->prepare("DELETE FROM students_list WHERE Id = ?");
    $requete->execute([$student_id]);

    header('Location: students_list.php');
    exit();
}
?>
