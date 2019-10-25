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
    !empty($data["emailClient"]) &&
    !empty($data["mot_de_passClient"])){

    $client->_client_email = $data["emailClient"];
    $client->_client_mot_de_pass = md5($data["mot_de_passClient"]);

    if($client->logClient()){
        http_response_code(200); // requete traitéé 
        $response['result'] = true; 
        $response['idClients'] = $client->_valeurChamp['idClients'];
        $response['nomClients'] = $client->_valeurChamp['nomlients'];
        $response['prenomClients'] = $client->_valeurChamp['prenomClients'];
        $response['emailClients'] = $client->_valeurChamp['emailClients'];
        $response['telephoneClients'] = $client->_valeurChamp['telephoneClients'];
        $response['mot_de_passClients']= $client->_valeurChamp['mot_de_passClients'];
        echo json_encode($response);
        
    }
    else {
        http_response_code(200); // requete traitée
        $response['result'] = false; 
        $response['iserror'] = "Email ou Mot de pass erroné";
        echo json_encode($response);
    }
        
}
elseif(empty($data["emailClient"])) {
    http_response_code(200); // Mauvaise requete 
    $response['result'] = false; 
    $response['iserror'] = "email vide";
    echo json_encode($response);
}
    elseif(empty($data["mot_de_passClient"])){
        http_response_code(200); // Mauvaise requete 
        $response['result'] = false; 
        $response['iserror'] = "mot de passe vide";
        echo json_encode($response);
    }
    else{
        http_response_code(400); // Mauvaise requete 
        $response['result'] = false; 
        $response['iserror'] = "Impossible de verifier l'utilisateur. Les données sont incompletes.";
        echo json_encode($response);
    }


