<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../Config/Database.php';
include_once '../../Model/Etudiant.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->conx();

// Instantiate Etudiant object

$Etudiant  = new Etudiant($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$Etudiant->NOM = $data->NOM;
$Etudiant->PRENOM = $data->PRENOM;
$Etudiant->AGE = $data->AGE;
$Etudiant->EMAIL = $data->EMAIL;
$Etudiant->PASSWORD = $data->PASSWORD;

// Create post
if ($Etudiant->Insert_Etudiant()) {
    echo json_encode(
        array('message' => 'Etudiant Created')
    );
} else {
    echo json_encode(
        array('message' => 'Etudiant Not Created')
    );
}
