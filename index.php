<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php"); // Redirige vers le tableau de bord ou une autre page
    exit();
}

// Traiter la soumission du formulaire de connexion
if (isset($_POST['submit'])) {
    include 'connexiondb.php';

    $email = $_POST['email'];
    $password = $_POST['pass'];

    if (empty($email) || empty($password)) {
        header("Location: login.php?error=please enter your email or password");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Authentification réussie
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            header("Location: dashboard.php");
            exit();
        } else {
            header("Location: login.php?error=email or password not found");
            exit();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-In</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  <main class="bg-sign-in d-flex justify-content-center align-items-center">
      <div class="form-sign-in bg-white mt-2 h-auto mb-2 text-center pt-2 pe-4 ps-4 d-flex flex-column">
        <h1 class="UNIVERSITE text-start ms-12 ps-1"></h1>
        <div>
          <h2 class="sign-in text-uppercase">Se Connecter</h2>
          <p>Entrez vos identifiants pour accéder à votre compte</p>
        </div>
        <?php
          if(isset($_GET['error'])){
            if($_GET['error'] == "please enter your email or password"){
              echo '<div class="alert alert-danger" role="alert">
            Veuillez entrer votre email ou votre mot de passe
          </div>';
            }
            elseif($_GET['error'] == "email or password not found"){
              echo '<div class="alert alert-danger" role="alert">
              email ou mot de passe introuvable
          </div>';
            }
          }
        ?>
        <form method="POST" action="login.php">
          <div class="mb-3 mt-3 text-start">
            <label for="email">Adresse Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Entrez votre Email" name="email" value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email']; }?>">
          </div>
          <div class="mb-3 text-start">
            <label for="pwd">Mot de passe:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Entrez votre mot de passe" name="pass" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password']; }?>" autocomplete="on">
          </div>
          <button type="submit" name="submit" class="btn text-white w-100 text-uppercase">Se connecter</button>
          <p class="mt-4">Mot de passe oublié? Veuillez contacter <a href="tel:+243837449954">Jules MUKADI</a> pour l'attribution du nouveau mot de passe</p>
        </form>
    </div>
  </main>
  <script src="/js/bootstrap.bundle.js"></script>
  <script src="./js/validation.js"></script>
</body>
</html>
