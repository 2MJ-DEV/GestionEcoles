<?php 
    include 'connexiondb.php';
    if(isset($_POST['submit'])){
        
        $image = $_FILES['img']['name'];
        $tempname = $_FILES['img']['tmp_name'];  
        $folder = "../assets/img/".$image;
        
        if(move_uploaded_file($tempname,$folder)){
            echo 'images est uplade';
        }

        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        $Promotion = $_POST['Promotion'];
        $NumeroMatricule = $_POST['NumeroMatricule'];
        $DateUpDate = $_POST['DateUpDate'];

        $requete = $con->prepare("INSERT INTO students_list(img,Name,Email,Promotion,NumeroMatricule,DateUpDate) VALUES('$image','$Name','$Email','$Promotion','$NumeroMatricule','$DateUpDate')");
        //$requete->execute(array($image,$Name,$Email,$Promotion,$NumeroMatricule,$DateUpDate));
        $requete->execute();
    }
    header('location:students_list.php')
    ?>