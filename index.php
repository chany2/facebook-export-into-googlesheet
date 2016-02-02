<?php
require_once 'vendor/autoload.php';
session_start();

function dd($data)
{
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

$clientId = '81678134426-l5mn5976kle6e69j7ffgsd0pd68rvrlf.apps.googleusercontent.com';
$clientSecret = '8_NYYvtjpxfS6EEF5QavYHCR';
$redirectUrl = 'http://localhost/facebook-googlesheet/auth2.php';
// -----------------------------------------------------------------------------
// DO NOT EDIT BELOW THIS LINE
// -----------------------------------------------------------------------------
//require_once 'src/Google_Client.php';

$client = new Google_Client();
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUrl);
$client->setScopes(array('https://spreadsheets.google.com/feeds'));
//if (isset($_GET['code'])) {
    //$client->authenticate($_GET['code']);
    //print_r($_SESSION['access_token']);
    //exit;
//}
//print '<a href="' . $client->createAuthUrl() . '">Authenticate</a>';
$accessToken = $_SESSION['access_token'];
$service_token = json_decode($accessToken);

use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;

$serviceRequest = new DefaultServiceRequest($service_token->access_token);
ServiceRequestFactory::setInstance($serviceRequest);

$spreadsheetService = new Google\Spreadsheet\SpreadsheetService();
$spreadsheetFeed = $spreadsheetService->getSpreadsheets();
//$spreadsheet = $spreadsheetFeed->getByTitle('test');


//dd($worksheetFeed);
//$listFeed = new Google\Spreadsheet\ListFeed($spreadsheetFeed)->getEntries();
foreach ($spreadsheetFeed as $key => $value) {
	dd($spreadsheetFeed[$key]->getTitle());
}
// echo "<pre>";
// print_r($spreadsheetFeed);
// echo "</pre>";
