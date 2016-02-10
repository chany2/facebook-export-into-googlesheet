<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 02/03/16
 * Time: 6:33 AM
 */

namespace Lib;

require_once __DIR__ . '/../Config.php';


class Common
{
    public function __construct()
    {
    }

    /*public static function getAccessToken($sessionToken)
    {
        $accessToken = $sessionToken;
        $service_token = json_decode($accessToken);

        return $service_token->access_token;
    }*/

    public static function dd($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    public static function getGoogleTokenFromKeyFile() {
        $client = new \Google_Client();
        $client->setClientId(SERVICE_CLIENT_ID);

        $cred = new \Google_Auth_AssertionCredentials(
            SERVICE_EMAIL,
            array('https://spreadsheets.google.com/feeds'),
            file_get_contents(__DIR__ .'/../service_api.p12')
        );

        $client->setAssertionCredentials($cred);

        if ($client->getAuth()->isAccessTokenExpired()) {
            $client->getAuth()->refreshTokenWithAssertion($cred);
        }

        $service_token = json_decode($client->getAccessToken());
        return $service_token->access_token;
    }

}