<?php
// export_csv.php

include 'connexiondb.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=historique_presences.csv');

$output = fopen('php://output', 'w');
fputcsv($output, array('ID étudiant', 'Nom', 'Date', 'Présence'));

$query = $con->query("SELECT s.Id, s.Name, a.date, a.presence 
                      FROM students_list s 
                      JOIN attendance_history a ON s.Id = a.student_id 
                      ORDER BY a.date ASC");

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $presence_status = $row['presence'] ? 'Présent' : 'Absent';
    fputcsv($output, array($row['Id'], $row['Name'], $row['date'], $presence_status));
}

fclose($output);
exit();
?>
