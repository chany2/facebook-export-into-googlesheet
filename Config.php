<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 02/03/16
 * Time: 6:20 AM
 */

// Google API
// Get those values from https://console.developers.google.com
/*const CLIENT_ID = '81678134426-l5mn5976kle6e69j7ffgsd0pd68rvrlf.apps.googleusercontent.com'; //Change to your clientID
const CLIENT_SECRET = '8_NYYvtjpxfS6EEF5QavYHCR'; // Change to your Client secret
const REDIRECT_URL = 'http://localhost/facebook-export-into-googlesheet/auth2.php'; // Change to your domain http://example.com/auth2.php
const DOMAIN = 'http://localhost/facebook-export-into-googlesheet/'; // Change to your domain http://example.com/
const GOOGLE_ACCESS_TOKEN = '1/2hgg3ORhR1CcPGToGfUN3poywVDN79M4RdBzQoq9G1VIgOrJDtdun6zK6XiATCKT';*/

// Get those values from https://console.developers.google.com
const SERVICE_CLIENT_ID = '112883231552734272086';
const SERVICE_EMAIL = 'my-webservice-2@api-project-81678134426.iam.gserviceaccount.com';
//$path_to_p12_file = $rootPath .'service_api.p12';

// Facebook API
const FACEBOOK_API_KEY = '872365952794421'; // Change to your api key
const FACEBOOK_API_SECRET = 'ffc6b9458fc8139a7b30b53e8d567547'; // Change to your api secret
const FACEBOOK_CALLBACK = 'http://localhost/facebook-export-into-googlesheet/fb-callback.php'; // Change to your domain


// Number item for each query when fetch data from Facebook Feed
const LIMIT_ITEM_PERPAGE = 50;