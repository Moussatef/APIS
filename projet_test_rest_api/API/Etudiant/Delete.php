<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../Config/Database.php';
include_once '../../Model/Etudinat.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->conx();

// Instantiate Etudiant object

$Etudiant  = new Etudiant($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$Etudiant->ID_PERSON = $data->ID_PERSON;

if ($Etudiant->Delete_Etudiant()) {
    echo json_encode(
        array('message' => 'Etudiant Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Etudiant Not Deleted')
    );
}
