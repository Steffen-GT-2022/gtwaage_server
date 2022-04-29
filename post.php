<?php
/**PHP
*------------------------------------------------------------------------------
* Steffen Berkenkamp
* copyright (c) 2016 unicumweb - Steffen Berkenkamp, all rights reserved
*
* this file may not be redistributed in whole or significant part
* and is subject to the unicumweb - Steffen Berkenkamp license.
*
* license: http://unicumweb.de/lizenz.php
**/
//POST
error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('log_errors', 'On');
ini_set('error_log', 'php-errors.log');

if(isset($_SERVER["HTTP_ORIGIN"])){
header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
}
else{
header("Access-Control-Allow-Origin: *");
}
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 600");
if($_SERVER["REQUEST_METHOD"] == "OPTIONS"){
    if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_METHOD"]))
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
    if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_HEADERS"]))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}

if($_SERVER['REQUEST_METHOD'] === 'GET'){
	$type = $_GET['type'];
}
else{
	$type = $_POST['type'];
}
if ($type == 'kost'){
require_once('classes/getClass.php');
	$daten = json_decode(json_encode($_POST['daten']));
	//$daten = json_encode($_POST['daten']);
	$data = new DATA();
	$data =  DATA::wkost($daten);
  //print_r($data);
	echo json_encode($data);
exit();
}
if ($type == 'art'){
require_once('classes/getClass.php');
	$kunde = json_decode(json_encode($_POST['kunde']));
  $kosten = json_decode(json_encode($_POST['kosten']));
	//$daten = json_encode($_POST['daten']);
	$data = new DATA();
	$data =  DATA::wartikel($kunde,$kosten);
  //print_r($data);
	echo json_encode($data);
exit();
}
?>
