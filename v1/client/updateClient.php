<?php
ini_set("display_errors", "on");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$filepath = realpath(dirname(__FILE__));
require_once($filepath.'/../lib/Database.php');
require_once($filepath.'/../classes/Class.clients.php');

$_database = new Database();
$_db = $_database->connectDB();
$client = new Client($_db);
$response = array();

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->idClient) &&
    !empty($data->nomClient) &&
    !empty($data->prenomClient) &&
    !empty($data->emailClient) &&
    !empty($data->telephoneClient) &&
    !empty($data->mot_de_passClient)){

    $client->_client_id = $data->idClient;
    $client->_client_nom = $data->nomClient;
    $client->_client_prenom = $data->prenomClient;
    $client->_client_email =  $data->emailClient;
    $client->_client_telephone = $data->telephoneClient;
    $client->_client_mot_de_pass = md5($data->mot_de_passClient);

        if($client->updateClient()){
            $response['success'] = http_response_code(201); // la creation s'est bien effectuée
            $response['message'] = "Les modifications ont été enregistré";
            $response['valeur_champ'] = $client->_valeurChamp;
        }
        else{
            $response['failed'] = http_response_code(503); // service indisponible
            $response['message'] = "Echec lors de la modification du client";
            $response['valeur_champ'] = $client->_valeurChamp;
        }
        
}
else{
    $response['echec'] = http_response_code(400); // mauvaise requete
    $response['message'] = "Donnees incompletes pour le client";
}
echo(json_encode($response));

