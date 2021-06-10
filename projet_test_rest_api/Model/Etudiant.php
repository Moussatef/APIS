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
    public function get_student()
    {
        $req = "SELECT * FROM personne p INNER JOIN personne_etud e on p.ID_PERSON = e.ID_PERSON WHERE p.ID_PERSON = ? LIMIT 0,1";

        // Prepare statement
        $stmt = $this->conn->prepare($req);

        // Bind ID
        $stmt->bindParam(1, $this->ID_PERSON);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->ID_ETUDIANT = $row['ID_ETUDIANT'];
        $this->ID_PERSON = $row['ID_PERSON'];
        $this->NOM = $row['NOM'];
        $this->PRENOM = $row['PRENOM'];
        $this->AGE = $row['AGE'];
        $this->EMAIL = $row['EMAIL'];
        $this->PASSWORD = $row['PASSWORD'];
    }
    public function Insert_Etudiant()
    {
        $cmp = 0;
        $req_check_email = "SELECT EMAIL FROM personne WHERE email=?";
        $req1 = "INSERT INTO personne 
                SET NOM = ? , PRENOM = ? , AGE = ? , EMAIL = ? , PASSWORD = ?";

        $req2 = "SELECT ID_PERSON FROM personne ORDER BY ID_PERSON DESC LIMIT 1 ";
        $req3 = "INSERT INTO personne_etud SET ID_PERSON = ? , ID_ClasseETD = 4";


        //chack if Email is already exeste in table on database
        $stmt = $this->conn->prepare($req_check_email);



        // Clean data
        $this->NOM = htmlspecialchars(strip_tags($this->NOM));
        $this->PRENOM = htmlspecialchars(strip_tags($this->PRENOM));
        $this->AGE = htmlspecialchars(strip_tags($this->AGE));
        $this->EMAIL = htmlspecialchars(strip_tags($this->EMAIL));
        $this->PASSWORD = htmlspecialchars(strip_tags($this->PASSWORD));

        $stmt->execute([$this->EMAIL]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $numRow = $stmt->rowCount();
        if ($numRow > 0) {
            printf("Email : %s already existe ...!!\n", $row['EMAIL']);
            return false;
        }


        $stmt1 = $this->conn->prepare($req1);
        if ($stmt1->execute([$this->NOM, $this->PRENOM, $this->AGE, $this->EMAIL, $this->PASSWORD]))
            $cmp++;

        if ($stmt2 = $this->conn->query($req2))
            $cmp++;

        $row = $stmt2->fetch(PDO::FETCH_ASSOC);

        $this->ID_PERSON = $row['ID_PERSON'];

        $stmt3 = $this->conn->prepare($req3);
        if ($stmt3->execute([$this->ID_PERSON]))
            $cmp++;

        if ($cmp === 3)
            return true;


        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt1->error, $stmt2->error, $stmt3->error);

        return false;
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
