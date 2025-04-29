<?php
// Inclure les fichiers nécessaires
include_once '../config/database.php';
include_once '../objects/convention.php';

// Vérifier que la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'message' => 'Méthode non autorisée. Utilisez POST.'
    ]);
    exit();
}

// Récupérer les données envoyées (POST ou JSON)
$data = $_POST;
if (empty($data) && file_get_contents('php://input')) {
    $data = json_decode(file_get_contents('php://input'), true);
}

// Vérifier que l'ID de la convention est présent
if (!isset($data['stage_convention_id_convention'])) {
    echo json_encode([
        'message' => 'ID de la convention manquant.'
    ]);
    exit();
}

// Connexion à la base de données
$database = new Database();
$db = $database->getConnection();

// Initialiser l'objet StageConvention
$stage = new Convention($db);
$stage->stage_convention_id_convention = $data['stage_convention_id_convention'];

// Tenter la suppression
if ($stage->delete()) {
    echo json_encode([
        'message' => 'Convention supprimée avec succès.'
    ]);
} else {
    echo json_encode([
        'message' => 'La suppression a échoué.'
    ]);
}
?>