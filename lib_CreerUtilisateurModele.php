<?php
class CreerUtilisateurModele {
    private $bdd;

    public function __construct($bdd) {
        $this->bdd = $bdd;
    }

    public function creerUtilisateurModele($nom, $prenom, $email, $motDePasse, $role) {
        // J'insere l'utilisateur dans la table 
        $sql = "INSERT INTO noyau_utilisateur (noyau_utilisateur__nom, noyau_utilisateur__prenom, noyau_utilisateur__sigle, noyau_utilisateur__mdp, noyau_utilisateur__email) 
                VALUES (:nom, :prenom, :role, :mdp, :email)";
        $requete = $this->bdd->prepare($sql);
        $requete->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'role' => $role,
            'mdp' => password_hash($motDePasse, PASSWORD_DEFAULT),
            'email' => $email
        ]);

        // Je recup l'ID de l'utilisateur nouvellement créé
        $idUtilisateur = $this->bdd->lastInsertId();

        // Je trouve l'ID du groupe correspondant au rôle
        $idGroupe = $this->obtenirIdGroupeParRole($role);

        // J'assigne l'utilisateur au groupe
        $this->assignerUtilisateurAuGroupe($idUtilisateur, $idGroupe);


        // J'assigne les droits liés au groupe à l'utilisateur
        $this->assignerDroitsUtilisateur($idUtilisateur, $idGroupe);

    

        return $idUtilisateur;
    }

    private function obtenirIdGroupeParRole($role) {
        $sql = "SELECT noyau_groupe__id FROM noyau_groupe WHERE noyau_groupe__sigle = :role";
        $requete = $this->bdd->prepare($sql);
        $requete->execute(['role' => $role]);
        return $requete->fetchColumn();
    }

    private function assignerUtilisateurAuGroupe($idUtilisateur, $idGroupe) {
        $sql = "INSERT INTO noyau_jointuregroupeutilisateur (noyau_groupe__id, noyau_utilisateur__id) VALUES (:idGroupe, :idUtilisateur)";
        $requete = $this->bdd->prepare($sql);
        $requete->execute([
            'idGroupe' => $idGroupe,
            'idUtilisateur' => $idUtilisateur
        ]);
    }

    private function assignerDroitsUtilisateur($idUtilisateur, $idGroupe) {
        // Je recup les droits liés au groupe
        $sql = "SELECT noyau_droit__id FROM noyau_jointuregroupedroit WHERE noyau_groupe__id = :idGroupe";
        $requete = $this->bdd->prepare($sql);
        $requete->execute(['idGroupe' => $idGroupe]);
        $droits = $requete->fetchAll(PDO::FETCH_COLUMN);

        // J'assigner chaque droit à l'utilisateur
        foreach ($droits as $idDroit) {
            $sql = "INSERT INTO noyau_jointureutilisateurdroit (noyau_utilisateur__id, noyau_droit__id) VALUES (:idUtilisateur, :idDroit)";
            $requete = $this->bdd->prepare($sql);
            $requete->execute([
                'idUtilisateur' => $idUtilisateur,
                'idDroit' => $idDroit
            ]);
        }
    }
}
