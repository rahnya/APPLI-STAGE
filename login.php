<?php
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <form method="POST" action="auth.php">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>
        <button type="submit" name="login">Connexion</button>
        <?php if (isset($error)) { echo '<p>' . $error . '</p>'; } ?>
    </form>
</body>
</html>
