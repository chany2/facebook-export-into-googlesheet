<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 02/03/16
 * Time: 6:34 AM
 */

namespace Lib;

require_once '/Config.php';

class FacebookApi
{
    public $fbApp;

    public function __construct()
    {

    }

    public static function fbApp()
    {
        return new \Facebook\FacebookApp(FACEBOOK_API_KEY, FACEBOOK_API_SECRET);
    }

    public static function getMe()
    {
        $fb = new \Facebook\Facebook([
            'app_id' => FACEBOOK_API_KEY,
            'app_secret' => FACEBOOK_API_SECRET,
            'default_graph_version' => 'v2.5',
        ]);

        $request = new \Facebook\FacebookRequest(
            self::fbApp(),
            $_SESSION['facebook_access_token'],
            'GET',
            '/me',
            array(
                'fields' => 'id,name'
            )
        );

        $response = $fb->getClient()->sendRequest($request);
        $me = $response->getDecodedBody();

        //\Lib\Common::dd($me);
        return $me;

    }

    public static function getUserGroup($user_id)
    {
        $fb = new \Facebook\Facebook([
            'app_id' => FACEBOOK_API_KEY,
            'app_secret' => FACEBOOK_API_SECRET,
            'default_graph_version' => 'v2.5',
        ]);

        $request = new \Facebook\FacebookRequest(
            self::fbApp(),
            $_SESSION['facebook_access_token'],
            'GET',
            '/'.$user_id.'/groups'
        );
        $response = $fb->getClient()->sendRequest($request);
        $groups = $response->getDecodedBody();

        \Lib\Common::dd($groups);
    }
}