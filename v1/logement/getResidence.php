<?php
ini_set("display_errors", "on");
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json;charset=UTF-8");
header("Access-Control-Allow-Methods:GET");

$filepath = realpath(dirname(__FILE__));
require_once($filepath.'/../lib/Database.php');
require_once($filepath.'/../classes/Class.logements.php');

$_database = new Database();
$_db = $_database->connectDB();
$logement = new Logement($_db);
$response = array();

if($logement->getAllResidences()){
    http_response_code(200);
    $response['list_Residence'] = $logement->_valeurChamp['list_Residence'];
    $response['error'] =true;
    $response['texterror'] = "succes";
    echo json_encode($response);
}
else{
    http_response_code(200);
    $response['list_Log'] = $logement->_valeurChamp['error'];
    $response['list_Lo'] = $logement->_valeurChamp['list_Log'];
    $response['error'] = false;
    $response['texterror'] = "error";
    echo json_encode($response);
}
