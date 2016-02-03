<?php
session_start();
require_once 'vendor/autoload.php';
require_once 'Config.php';

$clientId = CLIENT_ID;
$clientSecret = CLIENT_SECRET;
$redirectUrl = REDIRECT_URL;
// -----------------------------------------------------------------------------
// DO NOT EDIT BELOW THIS LINE
// -----------------------------------------------------------------------------
$client = new Google_Client();
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUrl);
$client->setScopes(array('https://spreadsheets.google.com/feeds'));

// Handle authorization flow from the server.
if (! isset($_GET['code'])) {
	$auth_url = $client->createAuthUrl();
	header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
	$client->authenticate($_GET['code']);
	$_SESSION['access_token'] = $client->getAccessToken();
	$redirect_uri = DOMAIN . 'index.php';
	header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}