<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 02/03/16
 * Time: 6:20 AM
 */


// Get those values from https://console.developers.google.com
const SERVICE_CLIENT_ID = '112883231552734272086';
const SERVICE_EMAIL = 'my-webservice-2@api-project-81678134426.iam.gserviceaccount.com';
//$path_to_p12_file = $rootPath .'service_api.p12';

// Facebook API
const FACEBOOK_API_KEY = '872365952794421'; // Change to your api key
const FACEBOOK_API_SECRET = 'ffc6b9458fc8139a7b30b53e8d567547'; // Change to your api secret
const FACEBOOK_CALLBACK = 'http://localhost/facebook-export-into-googlesheet/fb-callback.php'; // Change to your domain
const DOMAIN = "http://localhost/facebook-export-into-googlesheet/";

// Buffer API
const BUFFER_ACCESS_TOKEN = '1/12db2181e3a54cefca8d84eddee84658';
const BUFFER_CLIENT_ID = '56d34eb1b1954e1c3ebb8fcc';
const BUFFER_SECRET = 'a47aafbb0788e0e1f3201fa3514ee4ad';

// Number item for each query when fetch data from Facebook Feed
const LIMIT_ITEM_PERPAGE = 10;