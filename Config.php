<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 02/03/16
 * Time: 6:20 AM
 */


// Get those values from https://console.developers.google.com
const SERVICE_CLIENT_ID = '';
const SERVICE_EMAIL = '';
//$path_to_p12_file = $rootPath .'service_api.p12';

// Facebook API
const FACEBOOK_API_KEY = ''; // Change to your api key
const FACEBOOK_API_SECRET = ''; // Change to your api secret
const FACEBOOK_CALLBACK = 'http://localhost/facebook-export-into-googlesheet/fb-callback.php'; // Change to your domain
const DOMAIN = "http://localhost/facebook-export-into-googlesheet/";


// Number item for each query when fetch data from Facebook Feed
const LIMIT_ITEM_PERPAGE = 50;