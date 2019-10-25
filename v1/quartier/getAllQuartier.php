<?php
ini_set("display_errors", "on");
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json;charset=UTF-8");
header("Access-Control-Allow-Methods:GET");

$filepath = realpath(dirname(__FILE__));
require_once($filepath.'/../lib/Database.php');
require_once($filepath.'/../classes/Class.quartiers.php');

$_database = new Database();
$_db = $_database->connectDB();
$quartier = new Quartier($_db);
$response = array();

if($quartier->getAllQuartier()){
    http_response_code(200);
    $response['list_quartier'] = $quartier->_valeurChamp['list_quartier'];
    $response['error'] =true;
    $response['texterror'] = "succes";
    echo json_encode($response);
}
else{
    http_response_code(200);
    $response['list_quartier'] = $quartier->_valeurChamp['error'];
    $response['list_Lo'] = $quartier->_valeurChamp['list_quartier'];
    $response['error'] = false;
    $response['texterror'] = "error";
    echo json_encode($response);
}
