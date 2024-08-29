<?php
session_start();
$id = $_SESSION['id'];
include 'connexiondb.php';
if (isset($_POST['submit'])){
    $Name = $_POST['Name'];
    $Paiement = $_POST['Paiement'];
    $Promotion = $_POST['Promotion'];
    $NumeroTelephone = $_POST['NumeroTelephone'];
    $DateUpDate = $_POST['DateUpDate'];
    $requete = $con -> prepare("UPDATE students_list 
    SET 
    Name = '$Name',
    Paiement = '$Paiement',
    Promotion = '$Promotion',
    NumeroTelephone = '$NumeroTelephone',
    DateUpDate = '$DateUpDate'
    WHERE Id = $id");
    $res = $requete -> execute();
    header("location:students_list.php");
}
?>