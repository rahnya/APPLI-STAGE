<?php
    class Message{
        // database connection and table name
        private $conn;
        private $table_name = "stage_message";
    
        // object properties
        public $stage_message_id_message;
        public $stage_message_id_auteur_message;
        public $stage_message_contenu_message;
        public $stage_message_privee;
        public $stage_message_stage_id;

        /*public $noyau_utilisateur_id;*/
    
        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        function read(){
        
            // select all query
            $query = "SELECT
                        stage_message_id_message,
                        stage_message_id_auteur_message,
                        stage_message_contenu_message,
                        stage_message_privee,
                        stage_message_stage_id
                    FROM
                        " . $this->table_name . "
                        LEFT JOIN
                            noyau_utilisateur
                                ON stage_message.stage_message_id_auteur_message = noyau_utilisateur.noyau_utilisateur__id
                    ORDER BY
                        stage_message_id_message DESC";
        
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
                        stage_message_id_auteur_message=:stage_message_id_auteur_message,
                        stage_message_contenu_message=:stage_message_contenu_message,
                        stage_message_privee=:stage_message_privee,
                        stage_message_stage_id=:stage_message_stage_id
                   ";
        
           // prepare query
           $stmt = $this->conn->prepare($query);
        
           // sanitize
           $this->stage_message_id_auteur_message = htmlspecialchars(strip_tags($this->stage_message_id_auteur_message));
           $this->stage_message_contenu_message = htmlspecialchars(strip_tags($this->stage_message_contenu_message));
           $this->stage_message_privee = htmlspecialchars(strip_tags($this->stage_message_privee));
           $this->stage_message_stage_id = htmlspecialchars(strip_tags($this->stage_message_stage_id));
        
           // bind values
           $stmt->bindParam(":stage_message_id_auteur_message", $this->stage_message_id_auteur_message);
           $stmt->bindParam(":stage_message_contenu_message", $this->stage_message_contenu_message);
           $stmt->bindParam(":stage_message_privee", $this->stage_message_privee);
           $stmt->bindParam(":stage_message_stage_id", $this->stage_message_stage_id);

           // execute query
           if($stmt->execute()){
               return true;
           }

           $query = "SELECT *
                           FROM stage_message
                                   LEFT JOIN noyau_utilisateur
                                   ON stage_message.stage_message_id_auteur_message = noyau_utilisateur.noyau_utilisateur__id
                   ";

           $stmt = $this->conn->prepare($query);

           if($stmt->execute()){
               return true;
           }
        
           return false;
       }
    }

?>