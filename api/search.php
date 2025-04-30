<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once 'convention.php';

// instantiate database and stage_convention object
$database = new Database();
$db = $database->getConnection();

// initialize object
$stageConvention = new Convention($db);

// get keywords
$keywords = isset($_GET["s"]) ? $_GET["s"] : "";

// query conventions
$stmt = $stageConvention->search($keywords);
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {
    $conventions_arr = array();
    $conventions_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $convention_item = array(
            "id" => $stage_convention_id_convention,
            "nom_entreprise" => $stage_convention_nom_entreprise,
            "sujet_stage" => $stage_convention_sujet_stage,
            "nom_etudiant" => $stage_convention_nom_etudiant,
            "prenom_etudiant" => $stage_convention_prenom_etudiant,
            "email_etudiant" => $stage_convention_email_etudiant,
            "date_debut" => $stage_convention_date_debut,
            "date_fin" => $stage_convention_date_fin,
            "etat" => $stage_convention_etat,
            "stage_convention_siret" => $convention->stage_convention_siret,
            "stage_convention_ape" => $convention->stage_convention_ape,
            "stage_convention_tel_entreprise" => $convention->stage_convention_tel_entreprise,
            "stage_convention_email_entreprise" => $convention->stage_convention_email_entreprise,
            "stage_convention_nom_signataire_entreprise" => $convention->stage_convention_nom_signataire_entreprise,
            "stage_convention_prenom_signataire_entreprise" => $convention->stage_convention_prenom_signataire_entreprise,
            "stage_convention_poste_signataire_entreprise" => $convention->stage_convention_poste_signataire_entreprise,
            "stage_convention_service_entreprise" => $convention->stage_convention_service_entreprise,
            "stage_convention_lieu_entreprise" => $convention->stage_convention_lieu_entreprise,
            "stage_convention_numero_etudiant" => $convention->stage_convention_numero_etudiant,
            "stage_convention_date_naissance_etudiant" => $convention->stage_convention_date_naissance_etudiant,
            "stage_convention_tel_etudiant" => $convention->stage_convention_tel_etudiant,
            "stage_convention_email_perso_etudiant" => $convention->stage_convention_email_perso_etudiant,
            "stage_convention_cpam_etudiant" => $convention->stage_convention_cpam_etudiant,
            "stage_convention_semaines_stage" => $convention->stage_convention_semaines_stage,
            "stage_convention_heures_par_jour_stage" => $convention->stage_convention_heures_par_jour_stage,
            "stage_convention_repartition" => $convention->stage_convention_repartition,
            "stage_convention_heures_par_semaine_stage" => $convention->stage_convention_heures_par_semaine_stage,
            "stage_convention_commentaire_stage" => $convention->stage_convention_commentaire_stage,
            "stage_convention_activites_stage" => $convention->stage_convention_activites_stage,
            "stage_convention_competences_stage" => $convention->stage_convention_competences_stage,
            "stage_convention_nom_maitre_stage" => $convention->stage_convention_nom_maitre_stage,
            "stage_convention_prenom_maitre_stage" => $convention->stage_convention_prenom_maitre_stage,
            "stage_convention_poste_maitre_stage" => $convention->stage_convention_poste_maitre_stage,
            "stage_convention_tel_maitre_stage" => $convention->stage_convention_tel_maitre_stage,
            "stage_convention_email_maitre_stage" => $convention->stage_convention_email_maitre_stage,
            "stage_convention_encadrement_stage" => $convention->stage_convention_encadrement_stage,
            "stage_convention_nb_conges" => $convention->stage_convention_nb_conges,
            "stage_convention_sexe" => $convention->stage_convention_sexe,
            "stage_convention_gratification" => $convention->stage_convention_gratification,
            "stage_convention_avantages_5bis" => $convention->stage_convention_avantages_5bis,
            "stage_convention_avantages_5ter" => $convention->stage_convention_avantages_5ter,
            "stage_convention_signature_etudiant" => $convention->stage_convention_signature_etudiant,
            "stage_convention_signature_entreprise" => $convention->stage_convention_signature_entreprise,
            "stage_convention_etudiant_id" => $convention->stage_convention_etudiant_id,
            "stage_convention_tuteur_id" => $convention->stage_convention_tuteur_id,
            "stage_convention_nb_jours_stage" => $convention->stage_convention_nb_jours_stage
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
