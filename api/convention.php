<?php
class Convention {
  private $conn;
  private $table_name = "stage_convention";
  
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
                    stage_convention_siret;
                    stage_convention_ape;
                    stage_convention_nom_entreprise;
                    stage_convention_tel_entreprise;
                    stage_convention_email_entreprise;
                    stage_convention_nom_signataire_entreprise;
                    stage_convention_prenom_signataire_entreprise;
                    stage_convention_poste_signataire_entreprise;
                    stage_convention_service_entreprise;
                    stage_convention_lieu_entreprise;
                    stage_convention_numero_etudiant;
                    stage_convention_date_naissance_etudiant;
                    stage_convention_tel_etudiant;
                    stage_convention_email_perso_etudiant;
                    stage_convention_email_etudiant;
                    stage_convention_cpam_etudiant;
                    stage_convention_date_debut;
                    stage_convention_date_fin;
                    stage_convention_semaines_stage;
                    stage_convention_heures_par_jour_stage;
                    stage_convention_repartition;
                    stage_convention_heures_par_semaine_stage;
                    stage_convention_commentaire_stage;
                    stage_convention_activites_stage;
                    stage_convention_competences_stage;
                    stage_convention_nom_maitre_stage;
                    stage_convention_prenom_maitre_stage;
                    stage_convention_poste_maitre_stage;
                    stage_convention_tel_maitre_stage;
                    stage_convention_email_maitre_stage;
                    stage_convention_encadrement_stage;
                    stage_convention_nb_conges;
                    stage_convention_sexe;
                    stage_convention_gratification;
                    stage_convention_avantages_5bis;
                    stage_convention_avantages_5ter;
                    stage_convention_signature_etudiant;
                    stage_convention_signature_entreprise;
                    stage_convention_nom_etudiant;
                    stage_convention_prenom_etudiant;
                    stage_convention_etudiant_id;
                    stage_convention_tuteur_id;
                    stage_convention_nb_jours_stage;
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
  
public function search($keywords){
    $query = "SELECT * FROM " . $this->table_name . "
              WHERE stage_convention_nom_entreprise LIKE ?
              OR stage_convention_nom_etudiant LIKE ?
              OR stage_convention_prenom_etudiant LIKE ?
              OR stage_convention_siret LIKE ?
              OR stage_convention_ape LIKE ?
              OR stage_convention_tel_entreprise LIKE ?
              OR stage_convention_email_entreprise LIKE ?
              OR stage_convention_nom_signataire_entreprise LIKE ?
              OR stage_convention_prenom_signataire_entreprise LIKE ?
              OR stage_convention_poste_signataire_entreprise LIKE ?
              OR stage_convention_service_entreprise LIKE ?
              OR stage_convention_lieu_entreprise LIKE ?
              OR stage_convention_numero_etudiant LIKE ?
              OR stage_convention_date_naissance_etudiant LIKE ?
              OR stage_convention_tel_etudiant LIKE ?
              OR stage_convention_email_perso_etudiant LIKE ?
              OR stage_convention_email_etudiant LIKE ?
              OR stage_convention_cpam_etudiant LIKE ?
              OR stage_convention_sujet_stage LIKE ?
              OR stage_convention_date_debut LIKE ?
              OR stage_convention_date_fin LIKE ?
              OR stage_convention_semaines_stage LIKE ?
              OR stage_convention_heures_par_jour_stage LIKE ?
              OR stage_convention_repartition LIKE ?
              OR stage_convention_heures_par_semaine_stage LIKE ?
              OR stage_convention_commentaire_stage LIKE ?
              OR stage_convention_activites_stage LIKE ?
              OR stage_convention_competences_stage LIKE ?
              OR stage_convention_nom_maitre_stage LIKE ?
              OR stage_convention_prenom_maitre_stage LIKE ?
              OR stage_convention_poste_maitre_stage LIKE ?
              OR stage_convention_tel_maitre_stage LIKE ?
              OR stage_convention_email_maitre_stage LIKE ?
              OR stage_convention_encadrement_stage LIKE ?
              OR stage_convention_nb_conges LIKE ?
              OR stage_convention_etat LIKE ?
              OR stage_convention_sexe LIKE ?
              OR stage_convention_gratification LIKE ?
              OR stage_convention_avantages_5bis LIKE ?
              OR stage_convention_avantages_5ter LIKE ?
              OR stage_convention_signature_etudiant LIKE ?
              OR stage_convention_signature_entreprise LIKE ?
              OR stage_convention_nom_etudiant LIKE ?
              OR stage_convention_prenom_etudiant LIKE ?
              OR stage_convention_etudiant_id LIKE ?
              OR stage_convention_tuteur_id LIKE ?
              ORDER BY stage_convention_nb_jours_stage DESC";

    $stmt = $this->conn->prepare($query);

    // sanitize and format keywords
    $keywords = htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";

    // bind parameters
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);
    $stmt->bindParam(4, $keywords);
    $stmt->bindParam(5, $keywords);
    $stmt->bindParam(6, $keywords);
    $stmt->bindParam(7, $keywords);
    $stmt->bindParam(8, $keywords);
    $stmt->bindParam(8, $keywords);
    $stmt->bindParam(9, $keywords);
    $stmt->bindParam(10, $keywords);
    $stmt->bindParam(11, $keywords);
    $stmt->bindParam(12, $keywords);
    $stmt->bindParam(13 $keywords);
    $stmt->bindParam(14, $keywords);
    $stmt->bindParam(15, $keywords);
    $stmt->bindParam(16, $keywords);
    $stmt->bindParam(17, $keywords);
    $stmt->bindParam(18, $keywords);
    $stmt->bindParam(19, $keywords);
    $stmt->bindParam(20, $keywords);
    $stmt->bindParam(21, $keywords);
    $stmt->bindParam(22, $keywords);
    $stmt->bindParam(23, $keywords);
    $stmt->bindParam(24, $keywords);
    $stmt->bindParam(25, $keywords);
    $stmt->bindParam(26, $keywords);
    $stmt->bindParam(27, $keywords);
    $stmt->bindParam(28, $keywords);
    $stmt->bindParam(29, $keywords);
    $stmt->bindParam(30, $keywords);
    $stmt->bindParam(31, $keywords);
    $stmt->bindParam(32, $keywords);
    $stmt->bindParam(33, $keywords);
    $stmt->bindParam(34, $keywords);
    $stmt->bindParam(35, $keywords);
    $stmt->bindParam(36, $keywords);
    $stmt->bindParam(37, $keywords);
    $stmt->bindParam(38, $keywords);
    $stmt->bindParam(39, $keywords);
    $stmt->bindParam(40, $keywords);
    $stmt->bindParam(41, $keywords);
    $stmt->bindParam(42, $keywords);
    $stmt->bindParam(43, $keywords);
    $stmt->bindParam(44, $keywords);
    $stmt->bindParam(45, $keywords);
    $stmt->bindParam(46, $keywords);


    $stmt->execute();

    return $stmt;
}
  // Modifier la convention
    function update(){
      // update query
      $query = "UPDATE
      " . $this->table_name . "
      SET
      stage_convention_sujet_stage = :stage_convention_sujet_stage,
      stage_convention_etat = :stage_convention_etat,
      stage_convention_siret = :stage_convention_siret,
      stage_convention_ape = :stage_convention_ape,
      stage_convention_nom_entreprise = :stage_convention_nom_entreprise,
      stage_convention_tel_entreprise = :stage_convention_tel_entreprise,
      stage_convention_email_entreprise = :stage_convention_email_entreprise,
      stage_convention_nom_signataire_entreprise = :stage_convention_nom_signataire_entreprise,
      stage_convention_prenom_signataire_entreprise = :stage_convention_prenom_signataire_entreprise,
      stage_convention_poste_signataire_entreprise = :stage_convention_poste_signataire_entreprise,
      stage_convention_service_entreprise = :stage_convention_service_entreprise,
      stage_convention_lieu_entreprise = :stage_convention_lieu_entreprise
      stage_convention_numero_etudiant = :stage_convention_numero_etudiant,
      stage_convention_date_naissance_etudiant = :stage_convention_date_naissance_etudiant,
      stage_convention_tel_etudiant = :stage_convention_tel_etudiant,
      stage_convention_email_perso_etudiant = :stage_convention_email_perso_etudiant,
      stage_convention_email_etudiant = :stage_convention_email_etudiant,
      stage_convention_cpam_etudiant = :stage_convention_cpam_etudiant,
      stage_convention_date_debut = :stage_convention_date_debut,
      stage_convention_date_fin = :stage_convention_date_fin,
      stage_convention_semaines_stage = :stage_convention_semaines_stage,
      stage_convention_heures_par_jour_stage = :stage_convention_heures_par_jour_stage,
      stage_convention_repartition = :stage_convention_repartition,
      stage_convention_heures_par_semaine_stage = :stage_convention_heures_par_semaine_stage,
      stage_convention_commentaire_stage = :stage_convention_commentaire_stage,
      stage_convention_activites_stage = :stage_convention_activites_stage,
      stage_convention_competences_stage = :stage_convention_competences_stage,
      stage_convention_nom_maitre_stage = :stage_convention_nom_maitre_stage,
      stage_convention_prenom_maitre_stage = :stage_convention_prenom_maitre_stage,
      stage_convention_poste_maitre_stage = :stage_convention_poste_maitre_stage,
      stage_convention_tel_maitre_stage = :stage_convention_tel_maitre_stage,
      stage_convention_email_maitre_stage = :stage_convention_email_maitre_stage,
      stage_convention_encadrement_stage = :stage_convention_encadrement_stage,
      stage_convention_nb_conges = :stage_convention_nb_conges,
      stage_convention_sexe = :stage_convention_sexe,
      stage_convention_gratification = :stage_convention_gratification,
      stage_convention_avantages_5bis = :stage_convention_avantages_5bis,
      stage_convention_avantages_5ter = :stage_convention_avantages_5ter,
      stage_convention_signature_etudiant = :stage_convention_signature_etudiant,
      stage_convention_signature_entreprise = :stage_convention_signature_entreprise,
      stage_convention_nom_etudiant = :stage_convention_nom_etudiant,
      stage_convention_prenom_etudiant = :stage_convention_prenom_etudiant,
      stage_convention_etudiant_id = :stage_convention_etudiant_id,
      stage_convention_tuteur_id = :stage_convention_tuteur_id,
      stage_convention_nb_jours_stage = :stage_convention_nb_jours_stage,
      WHERE stage_convention_id_convention = :stage_convention_id_convention";

      // prepare query statement
      $stmt = $this->conn->prepare($query);

      // sanitize
      $this->stage_convention_sujet_stage=htmlspecialchars(strip_tags($this->stage_convention_sujet_stage));
      $this->stage_convention_etat=htmlspecialchars(strip_tags($this->stage_convention_etat));
      $this->stage_convention_siret=htmlspecialchars(strip_tags($this->stage_convention_siret));
      $this->stage_convention_ape=htmlspecialchars(strip_tags($this->stage_convention_ape));
      $this->stage_convention_nom_entreprise=htmlspecialchars(strip_tags($this->stage_convention_nom_entreprise));
      $this->stage_convention_tel_entreprise=htmlspecialchars(strip_tags($this->stage_convention_tel_entreprise));
      $this->stage_convention_email_entreprise=htmlspecialchars(strip_tags($this->stage_convention_email_entreprise));
      $this->stage_convention_nom_signataire_entreprise=htmlspecialchars(strip_tags($this->stage_convention_nom_signataire_entreprise));
      $this->stage_convention_prenom_signataire_entreprise=htmlspecialchars(strip_tags($this->stage_convention_prenom_signataire_entreprise));
      $this->stage_convention_poste_signataire_entreprise=htmlspecialchars(strip_tags($this->stage_convention_poste_signataire_entreprise));
      $this->stage_convention_service_entreprise=htmlspecialchars(strip_tags($this->stage_convention_service_entreprise));
      $this->stage_convention_lieu_entreprise=htmlspecialchars(strip_tags($this->stage_convention_lieu_entreprise));
      $this->stage_convention_numero_etudiant=htmlspecialchars(strip_tags($this->stage_convention_numero_etudiant));
      $this->stage_convention_date_naissance_etudiant=htmlspecialchars(strip_tags($this->stage_convention_date_naissance_etudiant));
      $this->stage_convention_tel_etudiant=htmlspecialchars(strip_tags($this->stage_convention_tel_etudiant));
      $this->stage_convention_email_perso_etudiant=htmlspecialchars(strip_tags($this->stage_convention_email_perso_etudiant));
      $this->stage_convention_email_etudiant=htmlspecialchars(strip_tags($this->stage_convention_email_etudiant));
      $this->stage_convention_cpam_etudiant=htmlspecialchars(strip_tags($this->stage_convention_cpam_etudiant));
      $this->stage_convention_date_debut=htmlspecialchars(strip_tags($this->stage_convention_date_debut));
      $this->stage_convention_date_fin=htmlspecialchars(strip_tags($this->stage_convention_date_fin));
      $this->stage_convention_semaines_stage=htmlspecialchars(strip_tags($this->stage_convention_semaines_stage));
      $this->stage_convention_heures_par_jour_stage=htmlspecialchars(strip_tags($this->stage_convention_heures_par_jour_stage));
      $this->stage_convention_repartition=htmlspecialchars(strip_tags($this->stage_convention_repartition));
      $this->stage_convention_heures_par_semaine_stage=htmlspecialchars(strip_tags($this->stage_convention_heures_par_semaine_stage));
      $this->stage_convention_commentaire_stage=htmlspecialchars(strip_tags($this->stage_convention_commentaire_stage));
      $this->stage_convention_activites_stage=htmlspecialchars(strip_tags($this->stage_convention_activites_stage));
      $this->stage_convention_competences_stage=htmlspecialchars(strip_tags($this->stage_convention_competences_stage));
      $this->stage_convention_nom_maitre_stage=htmlspecialchars(strip_tags($this->stage_convention_nom_maitre_stage));
      $this->stage_convention_prenom_maitre_stage=htmlspecialchars(strip_tags($this->stage_convention_prenom_maitre_stage));
      $this->stage_convention_poste_maitre_stage=htmlspecialchars(strip_tags($this->stage_convention_poste_maitre_stage));
      $this->stage_convention_tel_maitre_stage=htmlspecialchars(strip_tags($this->stage_convention_tel_maitre_stage));
      $this->stage_convention_email_maitre_stage=htmlspecialchars(strip_tags($this->stage_convention_email_maitre_stage));
      $this->stage_convention_encadrement_stage=htmlspecialchars(strip_tags($this->stage_convention_encadrement_stage));
      $this->stage_convention_nb_conges=htmlspecialchars(strip_tags($this->stage_convention_nb_conges));
      $this->stage_convention_sexe=htmlspecialchars(strip_tags($this->stage_convention_sexe));
      $this->stage_convention_gratification=htmlspecialchars(strip_tags($this->stage_convention_gratification));
      $this->stage_convention_avantages_5bis=htmlspecialchars(strip_tags($this->stage_convention_avantages_5bis));
      $this->stage_convention_avantages_5ter=htmlspecialchars(strip_tags($this->stage_convention_avantages_5ter));
      $this->stage_convention_signature_etudiant=htmlspecialchars(strip_tags($this->stage_convention_signature_etudiant));
      $this->stage_convention_signature_entreprise=htmlspecialchars(strip_tags($this->stage_convention_signature_entreprise));
      $this->stage_convention_nom_etudiant=htmlspecialchars(strip_tags($this->stage_convention_nom_etudiant));
      $this->stage_convention_prenom_etudiant=htmlspecialchars(strip_tags($this->stage_convention_prenom_etudiant));
      $this->stage_convention_etudiant_id=htmlspecialchars(strip_tags($this->stage_convention_etudiant_id));
      $this->stage_convention_tuteur_id=htmlspecialchars(strip_tags($this->stage_convention_tuteur_id));
      $this->stage_convention_nb_jours_stage=htmlspecialchars(strip_tags($this->stage_convention_nb_jours_stage));
      $this->stage_convention_id_convention=htmlspecialchars(strip_tags($this->stage_convention_id_convention));



      // bind new values
      $stmt->bindParam(':stage_convention_id_convention', $this->stage_convention_id_convention);
      $stmt->bindParam(':stage_convention_sujet_stage', $this->stage_convention_sujet_stage);
      $stmt->bindParam(':stage_convention_etat', $this->stage_convention_etat);
      $stmt->bindParam(':stage_convention_siret', $this->stage_convention_siret);
      $stmt->bindParam(':stage_convention_ape', $this->stage_convention_ape);
      $stmt->bindParam(':stage_convention_nom_entreprise',$this->stage_convention_nom_entreprise);
      $stmt->bindParam(':stage_convention_tel_entreprise',$this->stage_convention_tel_entreprise);
      $stmt->bindParam(':stage_convention_email_entreprise',$this->stage_convention_email_entreprise);
      $stmt->bindParam(':stage_convention_nom_signataire_entreprise',$this->stage_convention_nom_signataire_entreprise);
      $stmt->bindParam(':stage_convention_prenom_signataire_entreprise',$this->stage_convention_prenom_signataire_entreprise);
      $stmt->bindParam(':stage_convention_poste_signataire_entreprise',$this->stage_convention_poste_signataire_entreprise);
      $stmt->bindParam(':stage_convention_service_entreprise',$this->stage_convention_service_entreprise);
      $stmt->bindParam(':stage_convention_lieu_entreprise',$this->stage_convention_lieu_entreprise);
      $stmt->bindParam(':stage_convention_numero_etudiant',$this->stage_convention_numero_etudiant);
      $stmt->bindParam(':stage_convention_date_naissance_etudiant',$this->stage_convention_date_naissance_etudiant);
      $stmt->bindParam(':stage_convention_tel_etudiant',$this->stage_convention_tel_etudiant);
      $stmt->bindParam(':stage_convention_email_perso_etudiant',$this->stage_convention_email_perso_etudiant);
      $stmt->bindParam(':stage_convention_email_etudiant',$this->stage_convention_email_etudiant);
      $stmt->bindParam(':stage_convention_cpam_etudiant',$this->stage_convention_cpam_etudiant);
      $stmt->bindParam(':stage_convention_date_debut',$this->stage_convention_date_debut);
      $stmt->bindParam(':stage_convention_date_fin',$this->stage_convention_date_fin);
      $stmt->bindParam(':stage_convention_semaines_stage',$this->stage_convention_semaines_stage);
      $stmt->bindParam(':stage_convention_heures_par_jour_stage',$this->stage_convention_heures_par_jour_stage);
      $stmt->bindParam(':stage_convention_repartition',$this->stage_convention_repartition);
      $stmt->bindParam(':stage_convention_heures_par_semaine_stage',$this->stage_convention_heures_par_semaine_stage);
      $stmt->bindParam(':stage_convention_commentaire_stage',$this->stage_convention_commentaire_stage);
      $stmt->bindParam(':stage_convention_activites_stage',$this->stage_convention_activites_stage);
      $stmt->bindParam(':stage_convention_competences_stage',$this->stage_convention_competences_stage);
      $stmt->bindParam(':stage_convention_nom_maitre_stage',$this->stage_convention_nom_maitre_stage);
      $stmt->bindParam(':stage_convention_prenom_maitre_stage',$this->stage_convention_prenom_maitre_stage);
      $stmt->bindParam(':stage_convention_poste_maitre_stage',$this->stage_convention_poste_maitre_stage);
      $stmt->bindParam(':stage_convention_tel_maitre_stage',$this->stage_convention_tel_maitre_stage);
      $stmt->bindParam(':stage_convention_email_maitre_stage',$this->stage_convention_email_maitre_stage);
      $stmt->bindParam(':stage_convention_encadrement_stage',$this->stage_convention_encadrement_stage);
      $stmt->bindParam(':stage_convention_nb_conges',$this->stage_convention_nb_conges);
      $stmt->bindParam(':stage_convention_sexe',$this->stage_convention_sexe);
      $stmt->bindParam(':stage_convention_gratification',$this->stage_convention_gratification);
      $stmt->bindParam(':stage_convention_avantages_5bis',$this->stage_convention_avantages_5bis);
      $stmt->bindParam(':stage_convention_avantages_5ter',$this->stage_convention_avantages_5ter);
      $stmt->bindParam(':stage_convention_signature_etudiant',$this->stage_convention_signature_etudiant);
      $stmt->bindParam(':stage_convention_signature_entreprise',$this->stage_convention_signature_entreprise);
      $stmt->bindParam(':stage_convention_nom_etudiant',$this->stage_convention_nom_etudiant);
      $stmt->bindParam(':stage_convention_prenom_etudiant',$this->stage_convention_prenom_etudiant);
      $stmt->bindParam(':stage_convention_etudiant_id',$this->stage_convention_etudiant_id);
      $stmt->bindParam(':stage_convention_tuteur_id',$this->stage_convention_tuteur_id);
      $stmt->bindParam(':stage_convention_nb_jours_stage',$this->stage_convention_nb_jours_stage);


      // execute the query
      if($stmt->execute()){
      return true;
      }
      return false;
  }

public function delete()
{
    $query = "DELETE FROM " . $this->table_name . " WHERE stage_convention_id_convention = ?";

    $stmt = $this->conn->prepare($query);

    // nettoyage
    $this->stage_convention_id_convention = htmlspecialchars(strip_tags($this->stage_convention_id_convention));

    // bind
    $stmt->bindParam(1, $this->stage_convention_id_convention, PDO::PARAM_INT);

    // exécution
    if ($stmt->execute()) {
        return true;
    }

    return false;
}
}
