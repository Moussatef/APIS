<?php

class Etudiant
{
    // DB stuff
    private $conn;
    public $ID_PERSON;
    public $ID_ETUDIANT;
    public $NOM;
    public $PRENOM;
    public $AGE;
    public $EMAIL;
    public $PASSWORD;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function get_Etudiants()
    {
        // Create query
        $req = "SELECT * FROM personne p INNER JOIN personne_etud e on p.ID_PERSON = e.ID_PERSON ";
        // Prepare statement
        $stmt = $this->conn->prepare($req);
        // Execute query
        $stmt->execute();

        return $stmt;
    }
    public function Insert_Etudiant()
    {
        $req = "";
    }

    public function Update_Etudiant()
    {
        $req = "UPDATE personne 
                SET NOM = ?,
                    PRENOM = ?,
                    AGE = ?,
                    EMAIL = ?,
                    PASSWORD = ?
                WHERE ID_PERSON = ?    ";
        $stmt = $this->conn->prepare($req);

        $this->NOM = htmlspecialchars(strip_tags($this->NOM));
        $this->PRENOM = htmlspecialchars(strip_tags($this->PRENOM));
        $this->AGE = htmlspecialchars(strip_tags($this->AGE));
        $this->EMAIL = htmlspecialchars(strip_tags($this->EMAIL));
        $this->PASSWORD = htmlspecialchars(strip_tags($this->PASSWORD));
        $this->ID_PERSON = htmlspecialchars(strip_tags($this->ID_PERSON));


        $stmt->bindParam('1', $this->NOM);
        $stmt->bindParam('2', $this->PRENOM);
        $stmt->bindParam('3', $this->AGE);
        $stmt->bindParam('4', $this->EMAIL);
        $stmt->bindParam('5', $this->PASSWORD);
        $stmt->bindParam('6', $this->ID_PERSON);
        if ($stmt->execute())
            return true;

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function Delete_Etudiant()
    {
        $req = "DELETE FROM personne WHERE ID_PERSON = ?";

        $stmt = $this->conn->prepare($req);

        $this->ID_PERSON = htmlspecialchars(strip_tags($this->ID_PERSON));

        if ($stmt->execute([$this->ID_PERSON]))
            return true;

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
