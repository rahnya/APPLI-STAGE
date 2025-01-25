<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Mes Stages</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
<header>
        <div class="logo">
            <a href="index.php"><img src="IMAGES/logo université de toulon.png" alt="logo de l'université de Toulon" width="200px"></a>
        </div>
        <nav>
            <a href="etustage.php">Stages</a>
            <a href="discussion.php">Discussions</a>
            <a href="include/lib_deconnexion.php"><img src="IMAGES/deconnexion.png"></a>
        </nav>
    </header>
    
    <main>
        <h1>Mes stages</h1>
        <div class="stages-list">
            <?php
            require_once 'config.php';

                // Récupérer les données des stages
                $query = "SELECT 
                              stage_convention_nom_entreprise, 
                              stage_convention_date_debut, 
                              stage_convention_date_fin 
                          FROM stage_convention";
                $stmt = $pdo->query($query);

                // Boucle pour afficher les données
                while ($stage = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $entreprise = htmlspecialchars($stage['stage_convention_nom_entreprise']);
                    $dateDebut = htmlspecialchars($stage['stage_convention_date_debut']);
                    $dateFin = htmlspecialchars($stage['stage_convention_date_fin']);
                    echo "<div class='blocstage'>
                            <div class='stage-info'>
                                <div class='iconestatut'></div>
                                <span>Stage chez $entreprise - De $dateDebut à $dateFin</span>
                            </div>
                            <div class='stage-btn'>
                                <button class='btn'>D</button>
                                <button class='btn'>M</button>
                            </div>
                          </div>";
                }
            ?>
        </div>
    </main>
</body>
</html>
