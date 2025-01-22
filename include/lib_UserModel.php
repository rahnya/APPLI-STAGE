<?php
class UserModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli('127.0.0.1', 'root', '', 'stage');
        if ($this->db->connect_error) {
            die("Erreur de connexion : " . $this->db->connect_error);
        }
    }

    public function authenticate($email, $password) {
        $query = "SELECT u.noyau_utilisateur__id, u.noyau_utilisateur__email, g.noyau_groupe__sigle 
                  FROM noyau_utilisateur u
                  JOIN noyau_jointuregroupeutilisateur j ON u.noyau_utilisateur__id = j.noyau_utilisateur__id
                  JOIN noyau_groupe g ON j.noyau_groupe__id = g.noyau_groupe__id
                  WHERE u.noyau_utilisateur__email = ? AND u.noyau_utilisateur__mdp = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function creerUtilisateur($nom, $prenom, $email, $motDePasse, $role) {
        // Vérifie si l'email existe déjà
        $query = "SELECT COUNT(*) as count FROM noyau_utilisateur WHERE noyau_utilisateur__email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->fetch_assoc()['count'];

        if ($count > 0) {
            return ['success' => false, 'message' => 'Cet email est déjà utilisé.'];
        }

        // Insère l'utilisateur dans la base de données
        $query = "INSERT INTO noyau_utilisateur (noyau_utilisateur__nom, noyau_utilisateur__prenom, noyau_utilisateur__email, noyau_utilisateur__mdp) 
                  VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssss', $nom, $prenom, $email, $motDePasse);
        $stmt->execute();

        $userId = $stmt->insert_id;

        // Récupèe l'ID du groupe correspondant au rôle
        $query = "SELECT noyau_groupe__id FROM noyau_groupe WHERE noyau_groupe__sigle = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $role);
        $stmt->execute();
        $result = $stmt->get_result();
        $groupeId = $result->fetch_assoc()['noyau_groupe__id'];

        // Associe l'utilisateur au groupe
        $query = "INSERT INTO noyau_jointuregroupeutilisateur (noyau_groupe__id, noyau_utilisateur__id) 
                  VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $groupeId, $userId);
        $stmt->execute();

        return ['success' => true, 'message' => 'Inscription réussie.'];
    }
}
