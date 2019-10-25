<?php
ini_set("display_errors", "on");
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json;charset=UTF-8");
header("Access-Control-Allow-Methods:GET");

$filepath = realpath(dirname(__FILE__));
require_once($filepath.'/../lib/Database.php');
require_once($filepath.'/../classes/Class.communes.php');

$_database = new Database();
$_db = $_database->connectDB();
$commune = new Commune($_db);
$response = array();

if($commune->getAllCommune()){
    http_response_code(200);
    $response['list_commune'] = $commune->_valeurChamp['list_commune'];
    $response['error'] =true;
    $response['texterror'] = "succes";
    echo json_encode($response);
}
else{
    http_response_code(200);
    $response['list_commune'] = $commune->_valeurChamp['error'];
    $response['list_Lo'] = $commune->_valeurChamp['list_commune'];
    $response['error'] = false;
    $response['texterror'] = "error";
    echo json_encode($response);
}
