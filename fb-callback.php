<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 02/04/16
 * Time: 3:35 AM
 */
session_start();
require_once 'vendor/autoload.php';
require_once __DIR__ .'/Config.php';

$fb = new Facebook\Facebook([
    'app_id' => FACEBOOK_API_KEY,
    'app_secret' => FACEBOOK_API_SECRET,
    'default_graph_version' => 'v2.5',
]);
$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // There was an error communicating with Graph
    echo $e->getMessage();
    exit;
}

if (isset($accessToken)) {
    // User authenticated your app!
    // Save the access token to a session and redirect
    $_SESSION['facebook_access_token'] = (string) $accessToken;
    // Log them into your web framework here . . .
    header("Location:". DOMAIN .'index.php');
    exit;
} elseif ($helper->getError()) {
    // The user denied the request
    // You could log this data . . .
    var_dump($helper->getError());
    var_dump($helper->getErrorCode());
    var_dump($helper->getErrorReason());
    var_dump($helper->getErrorDescription());
    // You could display a message to the user
    // being all like, "What? You don't like me?"
    exit;
}

// If they've gotten this far, they shouldn't be here
http_response_code(400);
exit;