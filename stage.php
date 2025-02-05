<?php
session_start();
require_once 'config.php';

// Vérification de l'authentification
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$user = $_SESSION['user'];
$userId = $user['noyau_utilisateur__id'];
$userRole = $user['noyau_utilisateur__sigle'];

if ($userRole == 'etudiant') {
    // Récupérer les stages liés à l'étudiant connecté
    $query = "SELECT 
                  stage_convention_id_convention,
                  stage_convention_nom_entreprise, 
                  stage_convention_date_debut, 
                  stage_convention_date_fin 
              FROM stage_convention
              WHERE stage_convention_etudiant_id = :userId";
} elseif ($userRole == 'tuteur_de_stage') {
    // Récupérer les stages des étudiants encadrés par le tuteur
    $query = "SELECT 
                  stage_convention_id_convention,
                  stage_convention_nom_entreprise, 
                  stage_convention_date_debut, 
                  stage_convention_date_fin 
              FROM stage_convention
              WHERE stage_convention_tuteur_id = :userId";
} else {
    $query = ""; // Si l'utilisateur n'a pas un rôle approprié
}

$stmt = $pdo->prepare($query);
$stmt->execute(['userId' => $userId]);
$stages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Stages</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
<header>
    <div class="logo">
        <a href="index.php"><img src="IMAGES/logo université de toulon.png" alt="logo" width="200px"></a>
    </div>
    <nav>
        <a href="stage.php">Stages</a>
        <a href="discussion.php">Discussions</a>
        <a href="include/lib_deconnexion.php"><img src="IMAGES/deconnexion.png" alt="lien de déconnexion" width="40px"></a>
    </nav>
</header>
    
<main>
    <h1>Mes stages</h1>
    <div class="stages-list">
        <?php foreach ($stages as $stage): ?>
            <div class='blocstage'>
                <div class='stage-info'>
                    <span>Stage chez <?= htmlspecialchars($stage['stage_convention_nom_entreprise']) ?> - 
                        De <?= htmlspecialchars($stage['stage_convention_date_debut']) ?> à <?= htmlspecialchars($stage['stage_convention_date_fin']) ?>
                    </span>
                </div>
                <div class='stage-btn'>
                    <form method="POST" action="convention.html">
                        <input type="hidden" name="convention_id" value="<?= $stage['stage_convention_id_convention'] ?>">
                        <button type="submit" class="btn">Convention</button>
                    </form>
                    <form method="POST" action="discussion.php">
                        <input type="hidden" name="convention_id" value="<?= $stage['stage_convention_id_convention'] ?>">
                        <button type="submit" class="btn">Discussion</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <?php if ($userRole == 'etudiant'): ?>
        <div class="create-convention">
            <a href="convention.php" class="btn">Créer une convention</a>
        </div>
    <?php endif; ?>
</main>
</body>
</html>
