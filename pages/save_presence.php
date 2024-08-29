<?php 
// save_presence.php

include 'connexiondb.php';

if (isset($_POST['submit_presence'])) {
    $date = date('Y-m-d');

    foreach ($_POST['presence'] as $student_id => $presence) {
        $presence_value = $presence ? 1 : 0;

        $requete = $con->prepare("INSERT INTO attendance_history (student_id, date, presence) 
                                  VALUES (:student_id, :date, :presence)
                                  ON DUPLICATE KEY UPDATE presence = :presence");
        $requete->bindParam(':student_id', $student_id);
        $requete->bindParam(':date', $date);
        $requete->bindParam(':presence', $presence_value);

        $requete->execute();
    }

    header('Location: students_list.php');
    exit();
}
?>
