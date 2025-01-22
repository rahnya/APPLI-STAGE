<?php
class ConnexionUtilisateurModele {
    private $bdd;

    public function __construct($bdd) {
        $this->bdd = $bdd;
    }

    public function getUtilisateurParEmail($email) {
        $query = $this->bdd->prepare("SELECT * FROM noyau_utilisateur WHERE noyau_utilisateur__email = :email");
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>
