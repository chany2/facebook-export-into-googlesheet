<?php
require_once 'vendor/autoload.php';
session_start();

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

// Handle authorization flow from the server.
if (! isset($_GET['code'])) {
	$auth_url = $client->createAuthUrl();
	header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
	$client->authenticate($_GET['code']);
	$_SESSION['access_token'] = $client->getAccessToken();
	$redirect_uri = 'http://localhost/facebook-googlesheet/index.php';
	header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}