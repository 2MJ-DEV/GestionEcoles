<?php
        session_start();
        if(isset($_POST['submit'])){
          include './pages/connexiondb.php';
          $email = $_POST['email'];
          $password = $_POST['pass'];

          $requete = "SELECT * FROM users WHERE Email = '$email' and Password = '$password'";
          $statment = $con -> prepare($requete);
          $statment -> execute();
          $result = $statment -> fetch();
          if($result['Email'] === $email && $result['Password'] === $password){
            $_SESSION['name'] = $result['username'];
            $_SESSION['email'] = $result['Email'];
            $_SESSION['password'] = $result['Password'];
            if(isset($_POST['check'])){
                setcookie('email',$_SESSION['email'],time() + 3600);
                setcookie('password',$_SESSION['password'],time() + 3600);
            }
            header("location:./pages/dashboard.php");
            }
            else if(empty($email) || empty($password)){
                header("location:index.php?error=Veuillez entrer votre email ou votre mot de passe");
            }
            else
            {
                header("location:index.php?error=Email ou mot de passe introuvable");
            }
      }?>