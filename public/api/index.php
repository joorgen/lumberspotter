<?php
include 'config.php';
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/','welcome');
$app->get('/places/:name-:obshtina','getPlace');
$app->get('/permits/:permit_number','getPermit');
$app->get('/autocomplete_places','autocomplete_places');

$app->run();

function welcome()
{
	echo file_get_contents('welcome.html');
}

function autocomplete_places()
{
	$app = \Slim\Slim::getInstance();
	$term = $app->request()->get('term');

	try
	{
		$db = getDB();
		$bind = array(
			":term" => "$term%"
		);
		$results = $db->select("places", "ime LIKE :term", $bind);

		$json = array();
		foreach( $results as $row )
		{
			array_push($json,array( 'label'=>$row['ime'] . ', ' . $row['obshtina'] ));
		}
		$app->response->setStatus(200);
		$app->response()->headers->set('Content-Type', 'application/json; charset=utf-8');
		echo json_encode($json, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
	} catch(PDOException $e) {
		//error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function getPlace($name,$obshtina)
{
 	try
	{
		$db = getDB();
		$bind = array(
			":name" => "$name",
			":obshtina" => "$obshtina"
		);

		$results = $db->select("permits", "Землище = :name AND Община = :obshtina", $bind);
		$app = \Slim\Slim::getInstance();
		$app->response->setStatus(200);
		$app->response()->headers->set('Content-Type', 'application/json; charset=utf-8');
		echo json_encode($results, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
	} catch(PDOException $e) {
		//error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function getPermit($number) {
	try
	{
		$db = getDB();
		$bind = array(
			":number" => "$number"
		);

		$results = $db->select("permits", "Номер = :number", $bind);
		$app = \Slim\Slim::getInstance();
		$app->response->setStatus(200);
		$app->response()->headers->set('Content-Type', 'application/json; charset=utf-8');
		echo json_encode($results, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
	} catch(PDOException $e) {
		//error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

?>