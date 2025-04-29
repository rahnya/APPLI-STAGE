<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Inclure la base de données et l'objet
include_once '../config/database.php';
include_once '../objects/convention.php';

// Vérification de la méthode HTTP
if ($_SERVER['REQUEST_METHOD'] !== 'GET' && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['message' => 'Méthode non autorisée.']);
    exit();
}

// Récupération du mot-clé
$keywords = '';
if (isset($_GET['s'])) {
    $keywords = $_GET['s'];
} elseif (isset($_POST['s'])) {
    $keywords = $_POST['s'];
} elseif ($json = file_get_contents('php://input')) {
    $input = json_decode($json, true);
    if (isset($input['s'])) {
        $keywords = $input['s'];
    }
}

if (empty($keywords)) {
    echo json_encode(['message' => 'Mot-clé manquant (paramètre "s").']);
    exit();
}

// Connexion DB
$database = new Database();
$db = $database->getConnection();

// Initialisation objet
$convention = new Convention($db);
$stmt = $convention->search($keywords);
$num = $stmt->rowCount();

if ($num > 0) {
    $conventions_arr = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $conventions_arr[] = [
            "id" => $stage_convention_id_convention,
            "nom_etudiant" => $stage_convention_nom_etudiant,
            "prenom_etudiant" => $stage_convention_prenom_etudiant,
            "nom_entreprise" => $stage_convention_nom_entreprise,
            "email_etudiant" => $stage_convention_email_etudiant,
            "sujet_stage" => $stage_convention_sujet_stage,
            "etat" => $stage_convention_etat
        ];
    }

    echo json_encode($conventions_arr);
} else {
    echo json_encode(['message' => 'Aucune convention trouvée.']);
}
?>
