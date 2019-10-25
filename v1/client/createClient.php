<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json;charset=UTF-8");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$filepath = realpath(dirname(__FILE__));
require_once($filepath.'/../lib/Database.php');
require_once($filepath.'/../classes/Class.clients.php');

$_database = new Database();
$_db = $_database->connectDB();
$client = new Client($_db);
$response = array();

$data = json_decode(file_get_contents("php://input"), true);
if(
    !empty($data['nomClient']) &&
    !empty($data['prenomClient']) &&
    !empty($data['emailClient']) &&
    !empty($data['telephoneClient']) &&
    !empty($data['mot_de_passClient'])){

        $client->_client_nom = $data['nomClient'];
        $client->_client_prenom = $data['prenomClient'];
        $client->_client_email =  $data['emailClient'];
        $client->_client_telephone = $data['telephoneClient'];
        $client->_client_mot_de_pass = md5($data['mot_de_passClient']);

        

        if($client->createClient()){
            http_response_code(201); // la creation s'est bien effectuée
            $response['result'] = true; 
            $response['idClients'] = $client->_valeurChamp['idClients'];
            $response['nomClients'] = $client->_valeurChamp['nomlients'];
            $response['prenomClients'] = $client->_valeurChamp['prenomClients'];
            $response['emailClients'] = $client->_valeurChamp['emailClients'];
            $response['telephoneClients'] = $client->_valeurChamp['telephoneClients'];
            $response['mot_de_passClients']= $client->_valeurChamp['mot_de_passClients'];
            echo(json_encode($response));
        }
        else{
            http_response_code(200); // 
            $response['result'] = false; 
            $response['iserror'] = "Cet e-mail existe déjà";
            $response['desole']= $client->_valeurChamp['desole'];
            $response['nom'] = $client->_valeurChamp['nom'];
            $response['prenom'] = $client->_valeurChamp['prenom'];
            echo(json_encode($response));
        }
        
}
else{
    $response['echec'] = http_response_code(400); // mauvaise requete
    $response['result'] = false; 
    $response['iserror'] = "Donnees incompletes pour le client";
    $response['nom'] = $data['nomClient'];
    $response['prenom'] = $data['prenomClient'];
    $response['mail'] = $data['emailClient'];
    $response['tel'] = $data['telephoneClient'];
    $response['pass'] = $data['mot_de_passClient'];
    echo(json_encode($response));
}


