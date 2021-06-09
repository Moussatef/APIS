<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Config/Database.php';
include_once '../../Model/Etudinat.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->conx();

// Instantiate Etudiant object

$Etudiant  = new Etudiant($db);

$result = $Etudiant->get_Etudiants();

$num = $result->rowCount();

if ($num > 0) {
    $Etudiant_array = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $Etudiant_item = array(
            'ID_ETUDIANT' => $ID_ETUDIANT,
            'NOM' => $NOM,
            'PRENOM' => $PRENOM,
            'AGE' => $AGE,
            'EMAIL' => $EMAIL,
            'PASSWORD' => $PASSWORD

        );

        array_push($Etudiant_array, $Etudiant_item);
    }
    echo json_encode($Etudiant_array);
} else {
    echo json_encode(
        array('message' => 'No Student Found')
    );
}
