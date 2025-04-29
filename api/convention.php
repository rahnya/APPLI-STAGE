<?php

class Convention {
  private $conn;
  public $stage_convention_id_convention;
  public $stage_convention_siret;
  public $stage_convention_ape;
  public $stage_convention_nom_entreprise;
  public $stage_convention_tel_entreprise;
  public $stage_convention_email_entreprise;
  public $stage_convention_nom_signataire_entreprise;
  public $stage_convention_prenom_signataire_entreprise;
  public $stage_convention_poste_signataire_entreprise;
  public $stage_convention_service_entreprise;
  public $stage_convention_lieu_entreprise;
  public $stage_convention_numero_etudiant;
  public $stage_convention_date_naissance_etudiant;
  public $stage_convention_tel_etudiant;
  public $stage_convention_email_perso_etudiant;
  public $stage_convention_email_etudiant;
  public $stage_convention_cpam_etudiant;
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
  public $stage_convention_email_maitre_stage;
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
    // Constructeur
    public function __construct($db) {
        $this->conn = $db;
    }
  
    // Lire toutes les conventions avec uniquement le sujet et l'état
    public function read() {
        $query = "SELECT 
                    stage_convention_id_convention,
                    stage_convention_sujet_stage,
                    stage_convention_etat 
                  FROM 
                    " . $this->table_name . " 
                  ORDER BY 
                    stage_convention_id_convention DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function readOne() {
      $query = "SELECT * FROM stage_convention WHERE stage_convention_id_convention = :id LIMIT 0,1";
  
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(":id", $this->stage_convention_id_convention);
      $stmt->execute();
  
      if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          foreach ($row as $key => $value) {
              $this->$key = $value;
          }
          return true;
      }
  
      return false;
  }
  
}
