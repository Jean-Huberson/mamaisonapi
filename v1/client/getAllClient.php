<?php
ini_set("display_errors", "on");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$filepath = realpath(dirname(__FILE__));
require_once($filepath.'/../lib/Database.php');
require_once($filepath.'/../classes/Class.clients.php');

$_database = new Database();
$_db = $_database->connectDB();
$client = new Client($_db);
$response = array();

        if($client->getAllClient()){
            $response['success'] = http_response_code(201); // la creation s'est bien effectuée
            $response['message'] = "Selection effectuée";
            $response['valeur_champ'] = $client->_valeurChamp;
        }
        else{
            $response['failed'] = http_response_code(503); // service indisponible
            $response['message'] = "Echec lors de la selection du client";
            $response['valeur_champ'] = $client->_valeurChamp;
        }
        
echo(json_encode($response));

