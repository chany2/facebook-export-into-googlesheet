<?php

namespace Lib;

use Ipalaus\Buffer\Client;
use Ipalaus\Buffer\TokenAuthorization;
use Ipalaus\Buffer\Update;

require_once __DIR__ . '/../Config.php';

class BufferAPI
{
    public static function getUserInfo($field = null)
    {
        $auth = new TokenAuthorization(BUFFER_ACCESS_TOKEN);
        $client = new Client($auth);

        $user = $client->getUser();

        if ($field !== null)
        {
            return $user[$field];
        } else {
            return $user;
        }
    }

    public static function getProfile($field = null)
    {
        $auth = new TokenAuthorization(BUFFER_ACCESS_TOKEN);
        $client = new Client($auth);

        $profiles = $client->getProfiles();

        if ($field !== null)
        {
            return $profiles[0][$field];
        } else {
            return $profiles;
        }
    }

}