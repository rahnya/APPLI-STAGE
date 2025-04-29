<?php
    class Convention{
    
        // database connection and table name
        private $conn;
        private $table_name = "stage_convention";
    
        // object properties
        public $stage_convention_siret;
        public $stage_convention_ape;
        public $stage_convention_nom_entreprise;
        public $stage_convention_tel_entreprise;
        public $stage_convention_email_entreprise;
        public $stage_convention_nom_signataire_entreprise;
        public $stage_convention_poste_signataire_entreprise;
        public $stage_convention_service_entreprise;
        public $stage_convention_lieu_entreprise;
        public $stage_convention_numero_etudiant;
        public $stage_convention_date_naissance_etudiant;
        public $stage_convention_tel_etudiant;
        public $stage_convention_email_perso_etudiant;
        public $stage_convention_email_etudiant;
        public $stage_convention_cpam_etudiant;
        public $stage_convention_prenom_signataire_entreprise;
        public $stage_convention_sujet_stage;
        public $stage_convention_date_debut;
        public $stage_convention_date_fin;
        public $stage_convention_semaines_stage;
        public $stage_convention_heures_par_jour_stage;
        public $stage_convention_repartition;
        public $stage_convention_heures_par_semaine_stage;
        public $stage_convention_commentaire_stage;
        public $stage_convention_activites_stage;
        public $stage_convention_competences_stage;
        public $stage_convention_nom_maitre_stage;
        public $stage_convention_prenom_maitre_stage;
        public $stage_convention_poste_maitre_stage;
        public $stage_convention_tel_maitre_stage;
        public $stage_convention_encadrement_stage;
        public $stage_convention_nb_conges;
        public $stage_convention_etat;
        public $stage_convention_sexe;
        public $stage_convention_gratification;
        public $stage_convention_avantages_5bis;
        public $stage_convention_avantages_5ter;
        public $stage_convention_signature_etudiant;
        public $stage_convention_signature_entreprise;
        public $stage_convention_nom_etudiant;
        public $stage_convention_prenom_etudiant;
        public $stage_convention_etudiant_id;
        public $stage_convention_tuteur_id;
        public $stage_convention_nb_jours_stage;

        public $noyau_utilisateur__id;
    
        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        function create(){
             // query to insert record
           $query = "INSERT INTO
                        " . $this->table_name . "
                    SET
                        stage_convention_siret=:stage_convention_siret,
                        stage_convention_ape=:stage_convention_ape,
                        stage_convention_nom_entreprise=:stage_convention_nom_entreprise,
                        stage_convention_tel_entreprise=:stage_convention_tel_entreprise,
                        stage_convention_email_entreprise=:stage_convention_email_entreprise,
                        stage_convention_nom_signataire_entreprise=:stage_convention_nom_signataire_entreprise,
                        stage_convention_poste_signataire_entreprise=:stage_convention_poste_signataire_entreprise,
                        stage_convention_service_entreprise=:stage_convention_service_entreprise,
                        stage_convention_lieu_entreprise=:stage_convention_lieu_entreprise,
                        stage_convention_numero_etudiant=:stage_convention_numero_etudiant,
                        stage_convention_date_naissance_etudiant=:stage_convention_date_naissance_etudiant,
                        stage_convention_tel_etudiant=:stage_convention_tel_etudiant,
                        stage_convention_email_perso_etudiant=:stage_convention_email_perso_etudiant,
                        stage_convention_email_etudiant=:stage_convention_email_etudiant,
                        stage_convention_cpam_etudiant=:stage_convention_cpam_etudiant,
                        stage_convention_prenom_signataire_entreprise=:stage_convention_prenom_signataire_entreprise,
                        stage_convention_sujet_stage=:stage_convention_sujet_stage,
                        stage_convention_date_debut=:stage_convention_date_debut,
                        stage_convention_date_fin=:stage_convention_date_fin,
                        stage_convention_semaines_stage=:stage_convention_semaines_stage,
                        stage_convention_heures_par_jour_stage=:stage_convention_heures_par_jour_stage,
                        stage_convention_repartition=:stage_convention_repartition,
                        stage_convention_heures_par_semaine_stage=:stage_convention_heures_par_semaine_stage,
                        stage_convention_commentaire_stage=:stage_convention_commentaire_stage,
                        stage_convention_activites_stage=:stage_convention_activites_stage,
                        stage_convention_competences_stage=:stage_convention_competences_stage,
                        stage_convention_nom_maitre_stage=:stage_convention_nom_maitre_stage,
                        stage_convention_prenom_maitre_stage=:stage_convention_prenom_maitre_stage,
                        stage_convention_poste_maitre_stage=:stage_convention_poste_maitre_stage,
                        stage_convention_tel_maitre_stage=:stage_convention_tel_maitre_stage,
                        stage_convention_encadrement_stage=:stage_convention_encadrement_stage,
                        stage_convention_nb_conges=:stage_convention_nb_conges,
                        stage_convention_etat=:stage_convention_etat,
                        stage_convention_sexe=:stage_convention_sexe,
                        stage_convention_gratification=:stage_convention_gratification,
                        stage_convention_avantages_5bis=:stage_convention_avantages_5bis,
                        stage_convention_avantages_5ter=:stage_convention_avantages_5ter,
                        stage_convention_signature_etudiant=:stage_convention_signature_etudiant,
                        stage_convention_signature_entreprise=:stage_convention_signature_entreprise,
                        stage_convention_nom_etudiant=:stage_convention_nom_etudiant,
                        stage_convention_prenom_etudiant=:stage_convention_prenom_etudiant,
                        stage_convention_etudiant_id=:stage_convention_etudiant_id,
                        stage_convention_tuteur_id=:stage_convention_tuteur_id,
                        stage_convention_nb_jours_stage=:stage_convention_nb_jours_stage
                    ";
         
            // prepare query
            $stmt = $this->conn->prepare($query);
         
            // sanitize
            $this->stage_convention_siret = htmlspecialchars(strip_tags($this->stage_convention_siret));
            $this->stage_convention_ape = htmlspecialchars(strip_tags($this->stage_convention_ape));
            $this->stage_convention_nom_entreprise = htmlspecialchars(strip_tags($this->stage_convention_nom_entreprise));
            $this->stage_convention_tel_entreprise = htmlspecialchars(strip_tags($this->stage_convention_tel_entreprise));
            $this->stage_convention_email_entreprise = htmlspecialchars(strip_tags($this->stage_convention_email_entreprise));
            $this->stage_convention_nom_signataire_entreprise = htmlspecialchars(strip_tags($this->stage_convention_nom_signataire_entreprise));
            $this->stage_convention_poste_signataire_entreprise = htmlspecialchars(strip_tags($this->stage_convention_poste_signataire_entreprise));
            $this->stage_convention_service_entreprise = htmlspecialchars(strip_tags($this->stage_convention_service_entreprise));
            $this->stage_convention_lieu_entreprise = htmlspecialchars(strip_tags($this->stage_convention_lieu_entreprise));
            $this->stage_convention_numero_etudiant = htmlspecialchars(strip_tags($this->stage_convention_numero_etudiant));
            $this->stage_convention_date_naissance_etudiant = htmlspecialchars(strip_tags($this->stage_convention_date_naissance_etudiant));
            $this->stage_convention_tel_etudiant = htmlspecialchars(strip_tags($this->stage_convention_tel_etudiant));
            $this->stage_convention_email_perso_etudiant = htmlspecialchars(strip_tags($this->stage_convention_email_perso_etudiant));
            $this->stage_convention_email_etudiant = htmlspecialchars(strip_tags($this->stage_convention_email_etudiant));
            $this->stage_convention_cpam_etudiant = htmlspecialchars(strip_tags($this->stage_convention_cpam_etudiant));
            $this->stage_convention_prenom_signataire_entreprise = htmlspecialchars(strip_tags($this->stage_convention_prenom_signataire_entreprise));
            $this->stage_convention_sujet_stage = htmlspecialchars(strip_tags($this->stage_convention_sujet_stage));
            $this->stage_convention_date_debut = htmlspecialchars(strip_tags($this->stage_convention_date_debut));
            $this->stage_convention_date_fin = htmlspecialchars(strip_tags($this->stage_convention_date_fin));
            $this->stage_convention_semaines_stage = htmlspecialchars(strip_tags($this->stage_convention_semaines_stage));
            $this->stage_convention_heures_par_jour_stage = htmlspecialchars(strip_tags($this->stage_convention_heures_par_jour_stage));
            $this->stage_convention_repartition = htmlspecialchars(strip_tags($this->stage_convention_repartition));
            $this->stage_convention_heures_par_semaine_stage = htmlspecialchars(strip_tags($this->stage_convention_heures_par_semaine_stage));
            $this->stage_convention_commentaire_stage = htmlspecialchars(strip_tags($this->stage_convention_commentaire_stage));
            $this->stage_convention_activites_stage = htmlspecialchars(strip_tags($this->stage_convention_activites_stage));
            $this->stage_convention_competences_stage = htmlspecialchars(strip_tags($this->stage_convention_competences_stage));
            $this->stage_convention_nom_maitre_stage = htmlspecialchars(strip_tags($this->stage_convention_nom_maitre_stage));
            $this->stage_convention_prenom_maitre_stage = htmlspecialchars(strip_tags($this->stage_convention_prenom_maitre_stage));
            $this->stage_convention_poste_maitre_stage = htmlspecialchars(strip_tags($this->stage_convention_poste_maitre_stage));
            $this->stage_convention_tel_maitre_stage = htmlspecialchars(strip_tags($this->stage_convention_tel_maitre_stage));
            $this->stage_convention_encadrement_stage = htmlspecialchars(strip_tags($this->stage_convention_encadrement_stage));
            $this->stage_convention_nb_conges = htmlspecialchars(strip_tags($this->stage_convention_nb_conges));
            $this->stage_convention_etat = htmlspecialchars(strip_tags($this->stage_convention_etat));
            $this->stage_convention_sexe = htmlspecialchars(strip_tags($this->stage_convention_sexe));
            $this->stage_convention_gratification = htmlspecialchars(strip_tags($this->stage_convention_gratification));
            $this->stage_convention_avantages_5bis = htmlspecialchars(strip_tags($this->stage_convention_avantages_5bis));
            $this->stage_convention_avantages_5ter = htmlspecialchars(strip_tags($this->stage_convention_avantages_5ter));
            $this->stage_convention_signature_etudiant = htmlspecialchars(strip_tags($this->stage_convention_signature_etudiant));
            $this->stage_convention_signature_entreprise = htmlspecialchars(strip_tags($this->stage_convention_signature_entreprise));
            $this->stage_convention_nom_etudiant = htmlspecialchars(strip_tags($this->stage_convention_nom_etudiant));
            $this->stage_convention_prenom_etudiant = htmlspecialchars(strip_tags($this->stage_convention_prenom_etudiant));
            $this->stage_convention_etudiant_id = htmlspecialchars(strip_tags($this->stage_convention_etudiant_id));
            $this->stage_convention_tuteur_id = htmlspecialchars(strip_tags($this->stage_convention_tuteur_id));
            $this->stage_convention_nb_jours_stage = htmlspecialchars(strip_tags($this->stage_convention_nb_jours_stage));
         
            // bind values
            $stmt->bindParam(":stage_convention_siret", $this->stage_convention_siret);
            $stmt->bindParam(":stage_convention_ape", $this->stage_convention_ape);
            $stmt->bindParam(":stage_convention_nom_entreprise", $this->stage_convention_nom_entreprise);
            $stmt->bindParam(":stage_convention_tel_entreprise", $this->stage_convention_tel_entreprise);
            $stmt->bindParam(":stage_convention_email_entreprise", $this->stage_convention_email_entreprise);
            $stmt->bindParam(":stage_convention_nom_signataire_entreprise", $this->stage_convention_nom_signataire_entreprise);
            $stmt->bindParam(":stage_convention_poste_signataire_entreprise", $this->stage_convention_poste_signataire_entreprise);
            $stmt->bindParam(":stage_convention_service_entreprise", $this->stage_convention_service_entreprise);
            $stmt->bindParam(":stage_convention_lieu_entreprise", $this->stage_convention_lieu_entreprise);
            $stmt->bindParam(":stage_convention_numero_etudiant", $this->stage_convention_numero_etudiant);
            $stmt->bindParam(":stage_convention_date_naissance_etudiant", $this->stage_convention_date_naissance_etudiant);
            $stmt->bindParam(":stage_convention_tel_etudiant", $this->stage_convention_tel_etudiant);
            $stmt->bindParam(":stage_convention_email_perso_etudiant", $this->stage_convention_email_perso_etudiant);
            $stmt->bindParam(":stage_convention_email_etudiant", $this->stage_convention_email_etudiant);
            $stmt->bindParam(":stage_convention_cpam_etudiant", $this->stage_convention_cpam_etudiant);
            $stmt->bindParam(":stage_convention_prenom_signataire_entreprise", $this->stage_convention_prenom_signataire_entreprise);
            $stmt->bindParam(":stage_convention_sujet_stage", $this->stage_convention_sujet_stage);
            $stmt->bindParam(":stage_convention_date_debut", $this->stage_convention_date_debut);
            $stmt->bindParam(":stage_convention_date_fin", $this->stage_convention_date_fin);
            $stmt->bindParam(":stage_convention_semaines_stage", $this->stage_convention_semaines_stage);
            $stmt->bindParam(":stage_convention_heures_par_jour_stage", $this->stage_convention_heures_par_jour_stage);
            $stmt->bindParam(":stage_convention_repartition", $this->stage_convention_repartition);
            $stmt->bindParam(":stage_convention_heures_par_semaine_stage", $this->stage_convention_heures_par_semaine_stage);
            $stmt->bindParam(":stage_convention_commentaire_stage", $this->stage_convention_commentaire_stage);
            $stmt->bindParam(":stage_convention_activites_stage", $this->stage_convention_activites_stage);
            $stmt->bindParam(":stage_convention_competences_stage", $this->stage_convention_competences_stage);
            $stmt->bindParam(":stage_convention_nom_maitre_stage", $this->stage_convention_nom_maitre_stage);
            $stmt->bindParam(":stage_convention_prenom_maitre_stage", $this->stage_convention_prenom_maitre_stage);
            $stmt->bindParam(":stage_convention_poste_maitre_stage", $this->stage_convention_poste_maitre_stage);
            $stmt->bindParam(":stage_convention_tel_maitre_stage", $this->stage_convention_tel_maitre_stage);
            $stmt->bindParam(":stage_convention_encadrement_stage", $this->stage_convention_encadrement_stage);
            $stmt->bindParam(":stage_convention_nb_conges", $this->stage_convention_nb_conges);
            $stmt->bindParam(":stage_convention_etat", $this->stage_convention_etat);
            $stmt->bindParam(":stage_convention_sexe", $this->stage_convention_sexe);
            $stmt->bindParam(":stage_convention_gratification", $this->stage_convention_gratification);
            $stmt->bindParam(":stage_convention_avantages_5bis", $this->stage_convention_avantages_5bis);
            $stmt->bindParam(":stage_convention_avantages_5ter", $this->stage_convention_avantages_5ter);
            $stmt->bindParam(":stage_convention_signature_etudiant", $this->stage_convention_signature_etudiant);
            $stmt->bindParam(":stage_convention_signature_entreprise", $this->stage_convention_signature_entreprise);
            $stmt->bindParam(":stage_convention_nom_etudiant", $this->stage_convention_nom_etudiant);
            $stmt->bindParam(":stage_convention_prenom_etudiant", $this->stage_convention_prenom_etudiant);
            $stmt->bindParam(":stage_convention_etudiant_id", $this->stage_convention_etudiant_id);
            $stmt->bindParam(":stage_convention_tuteur_id", $this->stage_convention_tuteur_id);
            $stmt->bindParam(":stage_convention_nb_jours_stage", $this->stage_convention_nb_jours_stage);

            // execute query
            if($stmt->execute()){
                return true;
            }

            $query = "SELECT *
                            FROM stage_convention
                                    LEFT JOIN noyau_utilisateur
                                    ON stage_convention.stage_convention_etudiant_id = noyau_utilisateur.noyau_utilisateur__id
                    ";

            $stmt = $this->conn->prepare($query);

            if($stmt->execute()){
                return true;
            }
         
            return false;
        }
    }
?>