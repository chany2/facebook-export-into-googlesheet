<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 02/03/16
 * Time: 6:33 AM
 */

namespace Lib;


class Common
{
    public function __construct()
    {
        
    }

    public static function getAccessToken($sessionToken)
    {
        $accessToken = $sessionToken;
        $service_token = json_decode($accessToken);

        return $service_token->access_token;
    }

    public static function dd($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}