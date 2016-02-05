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
            '/' . $user_id . '/groups'
        );
        $response = $fb->getClient()->sendRequest($request);
        $groups = $response->getDecodedBody();

        \Lib\Common::dd($groups);
    }

    /*
     * Get list user feeds
     * Note: Header name of Google sheet must to be lowercase and no-space
     */

    public static function getListFeeds($fb_id, $limit)
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
            '/'.$fb_id.'/feed',
            array(
                'fields' => 'admin_creator,created_time,description,from,name,likes{name},comments,message,link',
                'limit' => $limit
            )
        );

        $response = $fb->getClient()->sendRequest($request);
        $graphObject = $response->getDecodedBody()['data'];
        $fbData = [];
        $i = 1;
        foreach ($graphObject as $key => $object) {
            $createdDate = new \DateTime($object['created_time']);
            $fbData[] = [
                'id' => $object['id'],
                'from' => $object['from']['name'],
                'link' => isset($object['link']) ? $object['link'] : '',
                'name' => isset($object['name']) ? $object['name'] : '',
                'description' => isset($object['description']) ? $object['description'] : '',
                'message' => isset($object['message']) ? $object['message'] : '',
                'date' => $createdDate->format('d/m/Y h:i:s'),
                'comments' => isset($object['comments']['data']) ? count($object['comments']['data']) : 0,
                'likes' => isset($object['likes']['data']) ? count($object['likes']['data']) : 0
            ];

            $i++;
        }

        return $fbData;
    }
}