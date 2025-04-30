<?php
    class Utilisateur{
        // database connection and table name
        private $conn;
        private $table_name = "noyau_utilisateur";
    
        // object properties
        public $noyau_utilisateur__nom;
        public $noyau_utilisateur__prenom;
        public $noyau_utilisateur__sigle;
        public $noyau_utilisateur__mdp;
        public $noyau_utilisateur__email;
        public $noyau_utilisateur__verrou;

        /*public $noyau_utilisateur_id;*/
    
        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        function read(){
        
            // select all query
            $query = "SELECT
                        noyau_utilisateur__nom,
                        noyau_utilisateur__prenom,
                        noyau_utilisateur__sigle,
                        noyau_utilisateur__mdp,
                        noyau_utilisateur__email,
                        noyau_utilisateur__verrou
                    FROM
                        " . $this->table_name . "
                    ORDER BY
                        noyau_utilisateur__nom DESC";
        
            // prepare query statement
            $stmt = $this->conn->prepare($query);
        
            // execute query
            $stmt->execute();
        
            return $stmt;
        }

        function create(){
            // query to insert record
          $query = "INSERT INTO
                       " . $this->table_name . "
                   SET
                        noyau_utilisateur__nom=:noyau_utilisateur__nom,
                        noyau_utilisateur__prenom=:noyau_utilisateur__prenom,
                        noyau_utilisateur__sigle=:noyau_utilisateur__sigle,
                        noyau_utilisateur__mdp=:noyau_utilisateur__mdp,
                        noyau_utilisateur__email=:noyau_utilisateur__email,
                        noyau_utilisateur__verrou=:noyau_utilisateur__verrou
                   ";
        
           // prepare query
           $stmt = $this->conn->prepare($query);
        
           // sanitize
            $this->noyau_utilisateur__nom = htmlspecialchars(strip_tags($this->noyau_utilisateur__nom));
            $this->noyau_utilisateur__prenom = htmlspecialchars(strip_tags($this->noyau_utilisateur__prenom));
            $this->noyau_utilisateur__sigle = htmlspecialchars(strip_tags($this->noyau_utilisateur__sigle));
            $this->noyau_utilisateur__mdp = htmlspecialchars(strip_tags($this->noyau_utilisateur__mdp));
            $this->noyau_utilisateur__email = htmlspecialchars(strip_tags($this->noyau_utilisateur__email));
            $this->noyau_utilisateur__verrou = htmlspecialchars(strip_tags($this->noyau_utilisateur__verrou));
        
           // bind values
           $stmt->bindParam(":noyau_utilisateur__nom", $this->noyau_utilisateur__nom);
           $stmt->bindParam(":noyau_utilisateur__prenom", $this->noyau_utilisateur__prenom);
           $stmt->bindParam(":noyau_utilisateur__sigle", $this->noyau_utilisateur__sigle);
           $stmt->bindParam(":noyau_utilisateur__mdp", $this->noyau_utilisateur__mdp);
           $stmt->bindParam(":noyau_utilisateur__email", $this->noyau_utilisateur__email);
           $stmt->bindParam(":noyau_utilisateur__verrou", $this->noyau_utilisateur__verrou);

           // execute query
           if($stmt->execute()){
               return true;
           }
        
           return false;
       }
    }
?>