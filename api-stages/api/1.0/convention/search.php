<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/convention.php';

// instantiate database and stage_convention object
$database = new Database();
$db = $database->getConnection();

// initialize object
$convention = new Convention($db);

// get keywords
$keywords = isset($_GET["s"]) ? $_GET["s"] : "";

// query conventions
$stmt = $convention->search($keywords);

$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {
    $conventions_arr = array();
    $conventions_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $convention_item = array(
            "id" => $row['stage_convention_id_convention'],
            "nom_entreprise" => $row['stage_convention_nom_entreprise'],
            "sujet_stage" => $row['stage_convention_sujet_stage'],
            "nom_etudiant" => $row['stage_convention_nom_etudiant'],
            "prenom_etudiant" => $row['stage_convention_prenom_etudiant'],
            "email_etudiant" => $row['stage_convention_email_etudiant'],
            "date_debut" => $row['stage_convention_date_debut'],
            "date_fin" => $row['stage_convention_date_fin'],
            "etat" => $row['stage_convention_etat'],
            "stage_convention_siret" => $row['stage_convention_siret'],
            "stage_convention_ape" => $row['stage_convention_ape'],
            "stage_convention_tel_entreprise" => $row['stage_convention_tel_entreprise'],
            "stage_convention_email_entreprise" => $row['stage_convention_email_entreprise'],
            "stage_convention_nom_signataire_entreprise" => $row['stage_convention_nom_signataire_entreprise'],
            "stage_convention_prenom_signataire_entreprise" => $row['stage_convention_prenom_signataire_entreprise'],
            "stage_convention_poste_signataire_entreprise" => $row['stage_convention_poste_signataire_entreprise'],
            "stage_convention_service_entreprise" => $row['stage_convention_service_entreprise'],
            "stage_convention_lieu_entreprise" => $row['stage_convention_lieu_entreprise'],
            "stage_convention_numero_etudiant" => $row['stage_convention_numero_etudiant'],
            "stage_convention_date_naissance_etudiant" => $row['stage_convention_date_naissance_etudiant'],
            "stage_convention_tel_etudiant" => $row['stage_convention_tel_etudiant'],
            "stage_convention_email_perso_etudiant" => $row['stage_convention_email_perso_etudiant'],
            "stage_convention_cpam_etudiant" => $row['stage_convention_cpam_etudiant'],
            "stage_convention_semaines_stage" => $row['stage_convention_semaines_stage'],
            "stage_convention_heures_par_jour_stage" => $row['stage_convention_heures_par_jour_stage'],
            "stage_convention_repartition" => $row['stage_convention_repartition'],
            "stage_convention_heures_par_semaine_stage" => $row['stage_convention_heures_par_semaine_stage'],
            "stage_convention_commentaire_stage" => $row['stage_convention_commentaire_stage'],
            "stage_convention_activites_stage" => $row['stage_convention_activites_stage'],
            "stage_convention_competences_stage" => $row['stage_convention_competences_stage'],
            "stage_convention_nom_maitre_stage" => $row['stage_convention_nom_maitre_stage'],
            "stage_convention_prenom_maitre_stage" => $row['stage_convention_prenom_maitre_stage'],
            "stage_convention_poste_maitre_stage" => $row['stage_convention_poste_maitre_stage'],
            "stage_convention_tel_maitre_stage" => $row['stage_convention_tel_maitre_stage'],
            "stage_convention_email_maitre_stage" => $row['stage_convention_email_maitre_stage'],
            "stage_convention_encadrement_stage" => $row['stage_convention_encadrement_stage'],
            "stage_convention_nb_conges" => $row['stage_convention_nb_conges'],
            "stage_convention_sexe" => $row['stage_convention_sexe'],
            "stage_convention_gratification" => $row['stage_convention_gratification'],
            "stage_convention_avantages_5bis" => $row['stage_convention_avantages_5bis'],
            "stage_convention_avantages_5ter" => $row['stage_convention_avantages_5ter'],
            "stage_convention_signature_etudiant" => $row['stage_convention_signature_etudiant'],
            "stage_convention_signature_entreprise" => $row['stage_convention_signature_entreprise'],
            "stage_convention_etudiant_id" => $row['stage_convention_etudiant_id'],
            "stage_convention_tuteur_id" => $row['stage_convention_tuteur_id'],
            "stage_convention_nb_jours_stage" => $row['stage_convention_nb_jours_stage']
        );

        array_push($conventions_arr["records"], $convention_item);
    }

    http_response_code(200);
    echo json_encode($conventions_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Aucune convention trouvée."));
}
?>