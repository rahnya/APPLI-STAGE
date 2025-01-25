<!DOCTYPE html>
  <html lang="fr">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Espace Stage de l'Université de Toulon</title>
    <link rel="stylesheet" href="CSS/index.css">
  </head>

  <body>
    <section>
      <img src="images/logo université de toulon.png" alt="" width="440px">
      <img src="images/illustration.png" alt="" width="480px">
    </section>
    <form method="POST" action="include/lib_connexionControleur.php">
        
        
    </form>
    <form id="connexion" method="post" action="include/lib_authController.php" >
      <div id="titre">
        <h1>STAGE</h1>
        <h2>Accédez à votre espace stage !</h2>
      </div>
      <div id="connexionform">
        <label for="email">Email :</label>
        <input type="email" placeholder="Adresse email" name="email" id="email" required>
        <label for="password">Mot de passe :</label>
        <input type="password" placeholder="Mot De Passe" name="password" id="password" required>
        <?php if (isset($error)) { echo '<p>' . $error . '</p>'; } ?>
      </div>
      <!-- Champ caché pour indiquer l'action -->
      <input type="hidden" name="action" value="connexion">
      <div id="connexion">
        <button type="submit" name="login">Se connecter</button>
      </div>
      <div id="autre">
        <a href="inscription.html">Première connexion</a>
        <a href="#">Besoin d'aide ?</a>
      </div>
    </form>
    
  </body>
</html>
