<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/convention.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare product object
    $convention = new Convention($db);

    // Récupération de l'ID de la convention depuis les paramètres GET
    if (!isset($_GET['id'])) {
        http_response_code(400);
        echo json_encode(["message" => "L'ID de la convention est manquant dans les paramètres GET."]);
        exit;
    }

    $convention->stage_convention_id_convention = htmlspecialchars(strip_tags($_GET['id']));

    // Décodage des données JSON envoyées dans le corps de la requête
    $rawInput = file_get_contents("php://input");
    $data = json_decode($rawInput);

    if (!$data) {
        http_response_code(400);
        echo json_encode(["message" => "Données JSON manquantes ou mal formatées."]);
        exit;
    }

    // Mise à jour des propriétés de l'objet $convention
    foreach ($data as $key => $value) {
        if (property_exists($convention, $key)) {
            $convention->$key = htmlspecialchars(strip_tags($value));
        }
    }

    // Appel de la méthode update pour mettre à jour la convention
    if ($convention->update()) {
        http_response_code(200);
        echo json_encode(["message" => "Convention mise à jour avec succès."]);
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Impossible de mettre à jour la convention."]);
    }
?>