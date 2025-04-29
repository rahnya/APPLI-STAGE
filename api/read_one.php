<?php
// Inclure les fichiers nécessaires
include_once '../config/database.php';
include_once '../objects/convention.php';

// Vérifier si l'ID est passé dans l'URL
if (!isset($_GET['id'])) {
    echo json_encode([
        'message' => 'ID de la convention manquant.'
    ]);
    exit();
}

$id = intval($_GET['id']);

// Connexion à la base de données
$database = new Database();
$db = $database->getConnection();

// Initialiser l'objet Convention
$convention = new Convention($db);
$convention->stage_convention_id_convention = $id;

// Charger les infos de la convention
if ($convention->readOne()) {
    // Créer un tableau avec tous les attributs de la convention
    $convention_arr = [
        'stage_convention_id_convention' => $convention->stage_convention_id_convention,
        'stage_convention_siret' => $convention->stage_convention_siret,
        'stage_convention_ape' => $convention->stage_convention_ape,
        'stage_convention_nom_entreprise' => $convention->stage_convention_nom_entreprise,
        'stage_convention_tel_entreprise' => $convention->stage_convention_tel_entreprise,
        'stage_convention_email_entreprise' => $convention->stage_convention_email_entreprise,
        'stage_convention_nom_signataire_entreprise' => $convention->stage_convention_nom_signataire_entreprise,
        'stage_convention_prenom_signataire_entreprise' => $convention->stage_convention_prenom_signataire_entreprise,
        'stage_convention_poste_signataire_entreprise' => $convention->stage_convention_poste_signataire_entreprise,
        'stage_convention_service_entreprise' => $convention->stage_convention_service_entreprise,
        'stage_convention_lieu_entreprise' => $convention->stage_convention_lieu_entreprise,
        'stage_convention_numero_etudiant' => $convention->stage_convention_numero_etudiant,
        'stage_convention_date_naissance_etudiant' => $convention->stage_convention_date_naissance_etudiant,
        'stage_convention_tel_etudiant' => $convention->stage_convention_tel_etudiant,
        'stage_convention_email_perso_etudiant' => $convention->stage_convention_email_perso_etudiant,
        'stage_convention_email_etudiant' => $convention->stage_convention_email_etudiant,
        'stage_convention_cpam_etudiant' => $convention->stage_convention_cpam_etudiant,
        'stage_convention_sujet_stage' => $convention->stage_convention_sujet_stage,
        'stage_convention_date_debut' => $convention->stage_convention_date_debut,
        'stage_convention_date_fin' => $convention->stage_convention_date_fin,
        'stage_convention_semaines_stage' => $convention->stage_convention_semaines_stage,
        'stage_convention_heures_par_jour_stage' => $convention->stage_convention_heures_par_jour_stage,
        'stage_convention_repartition' => $convention->stage_convention_repartition,
        'stage_convention_heures_par_semaine_stage' => $convention->stage_convention_heures_par_semaine_stage,
        'stage_convention_commentaire_stage' => $convention->stage_convention_commentaire_stage,
        'stage_convention_activites_stage' => $convention->stage_convention_activites_stage,
        'stage_convention_competences_stage' => $convention->stage_convention_competences_stage,
        'stage_convention_nom_maitre_stage' => $convention->stage_convention_nom_maitre_stage,
        'stage_convention_prenom_maitre_stage' => $convention->stage_convention_prenom_maitre_stage,
        'stage_convention_poste_maitre_stage' => $convention->stage_convention_poste_maitre_stage,
        'stage_convention_tel_maitre_stage' => $convention->stage_convention_tel_maitre_stage,
        'stage_convention_email_maitre_stage' => $convention->stage_convention_email_maitre_stage,
        'stage_convention_encadrement_stage' => $convention->stage_convention_encadrement_stage,
        'stage_convention_nb_conges' => $convention->stage_convention_nb_conges,
        'stage_convention_etat' => $convention->stage_convention_etat,
        'stage_convention_sexe' => $convention->stage_convention_sexe,
        'stage_convention_gratification' => $convention->stage_convention_gratification,
        'stage_convention_avantages_5bis' => $convention->stage_convention_avantages_5bis,
        'stage_convention_avantages_5ter' => $convention->stage_convention_avantages_5ter,
        'stage_convention_signature_etudiant' => $convention->stage_convention_signature_etudiant,
        'stage_convention_signature_entreprise' => $convention->stage_convention_signature_entreprise,
        'stage_convention_nom_etudiant' => $convention->stage_convention_nom_etudiant,
        'stage_convention_prenom_etudiant' => $convention->stage_convention_prenom_etudiant,
        'stage_convention_etudiant_id' => $convention->stage_convention_etudiant_id,
        'stage_convention_tuteur_id' => $convention->stage_convention_tuteur_id,
        'stage_convention_nb_jours_stage' => $convention->stage_convention_nb_jours_stage
    ];

    echo json_encode($convention_arr);
} else {
    echo json_encode([
        'message' => 'Convention non trouvée.'
    ]);
}
?>
