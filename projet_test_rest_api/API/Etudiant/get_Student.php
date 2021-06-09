<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');


include_once '../../Config/Database.php';
include_once '../../Model/Etudiant.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->conx();

$Etudian = new Etudiant($db);

$Etudian->ID_PERSON = isset($_GET['ID']) ? $_GET['ID'] : die();

$Etudian->get_student();



$Etudiant_item = array(
    'ID_ETUDIANT' => $Etudian->ID_ETUDIANT,
    'NOM' => $Etudian->NOM,
    'PRENOM' => $Etudian->PRENOM,
    'AGE' => $Etudian->AGE,
    'EMAIL' => $Etudian->EMAIL,
    'PASSWORD' => $Etudian->PASSWORD
);
echo json_encode($Etudiant_item);
