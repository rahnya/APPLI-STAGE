<?php
// required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // get database connection
    include_once '../config/database.php';
    
    // instantiate convention object
    include_once '../objects/convention.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $convention = new Convention($db);
    
    // get posted data
    $data = json_decode(file_get_contents("php://input"));
    
    // make sure data is not empty
    if(
        !empty($data->stage_convention_siret) &&
        !empty($data->stage_convention_ape) &&
        !empty($data->stage_convention_nom_entreprise) &&
        !empty($data->stage_convention_tel_entreprise) &&
        !empty($data->stage_convention_email_entreprise) &&
        !empty($data->stage_convention_nom_signataire_entreprise) &&
        !empty($data->stage_convention_poste_signataire_entreprise) &&
        !empty($data->stage_convention_service_entreprise) &&
        !empty($data->stage_convention_lieu_entreprise) &&
        !empty($data->stage_convention_numero_etudiant) &&
        !empty($data->stage_convention_date_naissance_etudiant) &&
        !empty($data->stage_convention_tel_etudiant) &&
        !empty($data->stage_convention_email_perso_etudiant) &&
        !empty($data->stage_convention_email_etudiant) &&
        !empty($data->stage_convention_cpam_etudiant) &&
        !empty($data->stage_convention_prenom_signataire_entreprise) &&
        !empty($data->stage_convention_sujet_stage) &&
        !empty($data->stage_convention_date_debut) &&
        !empty($data->stage_convention_date_fin) &&
        !empty($data->stage_convention_semaines_stage) &&
        !empty($data->stage_convention_heures_par_jour_stage) &&
        !empty($data->stage_convention_repartition) &&
        !empty($data->stage_convention_heures_par_semaine_stage) &&
        !empty($data->stage_convention_commentaire_stage) &&
        !empty($data->stage_convention_activites_stage) &&
        !empty($data->stage_convention_competences_stage) &&
        !empty($data->stage_convention_nom_maitre_stage) &&
        !empty($data->stage_convention_prenom_maitre_stage) &&
        !empty($data->stage_convention_poste_maitre_stage) &&
        !empty($data->stage_convention_tel_maitre_stage) &&
        !empty($data->stage_convention_encadrement_stage) &&
        !empty($data->stage_convention_nb_conges) &&
        !empty($data->stage_convention_etat) &&
        !empty($data->stage_convention_sexe) &&
        !empty($data->stage_convention_gratification) &&
        !empty($data->stage_convention_avantages_5bis) &&
        !empty($data->stage_convention_avantages_5ter) &&
        !empty($data->stage_convention_signature_etudiant) &&
        !empty($data->stage_convention_signature_entreprise) &&
        !empty($data->stage_convention_nom_etudiant) &&
        !empty($data->stage_convention_prenom_etudiant) &&
        !empty($data->stage_convention_etudiant_id) &&
        !empty($data->stage_convention_tuteur_id) &&
        !empty($data->stage_convention_nb_jours_stage)
    ) {
        // set convention property values
        $convention->stage_convention_siret = $data->stage_convention_siret;
        $convention->stage_convention_ape = $data->stage_convention_ape;
        $convention->stage_convention_nom_entreprise = $data->stage_convention_nom_entreprise;
        $convention->stage_convention_tel_entreprise = $data->stage_convention_tel_entreprise;
        $convention->stage_convention_email_entreprise = $data->stage_convention_email_entreprise;
        $convention->stage_convention_nom_signataire_entreprise = $data->stage_convention_nom_signataire_entreprise;
        $convention->stage_convention_poste_signataire_entreprise = $data->stage_convention_poste_signataire_entreprise;
        $convention->stage_convention_service_entreprise = $data->stage_convention_service_entreprise;
        $convention->stage_convention_lieu_entreprise = $data->stage_convention_lieu_entreprise;
        $convention->stage_convention_numero_etudiant = $data->stage_convention_numero_etudiant;
        $convention->stage_convention_date_naissance_etudiant = $data->stage_convention_date_naissance_etudiant;
        $convention->stage_convention_tel_etudiant = $data->stage_convention_tel_etudiant;
        $convention->stage_convention_email_perso_etudiant = $data->stage_convention_email_perso_etudiant;
        $convention->stage_convention_email_etudiant = $data->stage_convention_email_etudiant;
        $convention->stage_convention_cpam_etudiant = $data->stage_convention_cpam_etudiant;
        $convention->stage_convention_prenom_signataire_entreprise = $data->stage_convention_prenom_signataire_entreprise;
        $convention->stage_convention_sujet_stage = $data->stage_convention_sujet_stage;
        $convention->stage_convention_date_debut = $data->stage_convention_date_debut;
        $convention->stage_convention_date_fin = $data->stage_convention_date_fin;
        $convention->stage_convention_semaines_stage = $data->stage_convention_semaines_stage;
        $convention->stage_convention_heures_par_jour_stage = $data->stage_convention_heures_par_jour_stage;
        $convention->stage_convention_repartition = $data->stage_convention_repartition;
        $convention->stage_convention_heures_par_semaine_stage = $data->stage_convention_heures_par_semaine_stage;
        $convention->stage_convention_commentaire_stage = $data->stage_convention_commentaire_stage;
        $convention->stage_convention_activites_stage = $data->stage_convention_activites_stage;
        $convention->stage_convention_competences_stage = $data->stage_convention_competences_stage;
        $convention->stage_convention_nom_maitre_stage = $data->stage_convention_nom_maitre_stage;
        $convention->stage_convention_prenom_maitre_stage = $data->stage_convention_prenom_maitre_stage;
        $convention->stage_convention_poste_maitre_stage = $data->stage_convention_poste_maitre_stage;
        $convention->stage_convention_tel_maitre_stage = $data->stage_convention_tel_maitre_stage;
        $convention->stage_convention_encadrement_stage = $data->stage_convention_encadrement_stage;
        $convention->stage_convention_nb_conges = $data->stage_convention_nb_conges;
        $convention->stage_convention_etat = $data->stage_convention_etat;
        $convention->stage_convention_sexe = $data->stage_convention_sexe;
        $convention->stage_convention_gratification = $data->stage_convention_gratification;
        $convention->stage_convention_avantages_5bis = $data->stage_convention_avantages_5bis;
        $convention->stage_convention_avantages_5ter = $data->stage_convention_avantages_5ter;
        $convention->stage_convention_signature_etudiant = $data->stage_convention_signature_etudiant;
        $convention->stage_convention_signature_entreprise = $data->stage_convention_signature_entreprise;
        $convention->stage_convention_nom_etudiant = $data->stage_convention_nom_etudiant;
        $convention->stage_convention_prenom_etudiant = $data->stage_convention_prenom_etudiant;
        $convention->stage_convention_etudiant_id = $data->stage_convention_etudiant_id;
        $convention->stage_convention_tuteur_id = $data->stage_convention_tuteur_id;
        $convention->stage_convention_nb_jours_stage = $data->stage_convention_nb_jours_stage;
        
        // create the convention
        if($convention->create()){
        
            // set response code - 201 created
            http_response_code(201);
        
            // tell the user
            echo json_encode(array("message" => "Convention was created."));
        }
    
        // if unable to create the convention, tell the user
    else{
            // set response code - 503 service unavailable
            http_response_code(503);
    
            // tell the user
            echo json_encode(array("message" => "Unable to create convention."));
        }
    }
    
    // tell the user data is incomplete
    else{
    
        // set response code - 400 bad request
        http_response_code(400);
    
        // tell the user
        echo json_encode(array("message" => "Unable to create convention. Data is incomplete."));
    }
?>