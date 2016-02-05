<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 02/03/16
 * Time: 4:06 PM
 */
session_start();
ini_set('max_execution_time', 1200); //300 seconds = 5 minutes
ini_set('memory_limit ', '521M');

require_once '../vendor/autoload.php';
require_once '../GoogleSheet.php';
require_once '../Config.php';

use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;
use Lib\Common;
use Lib\FacebookApi;

$serviceRequest = new DefaultServiceRequest(Common::getGoogleTokenFromKeyFile());
ServiceRequestFactory::setInstance($serviceRequest);

$post_spreadSheetFeed = $_POST['spreadSheet'];
$post_workSheet = $_POST['worksheet'];
$_post_fbID = $_POST['facebook_user_id'];

$facebookListFeeds = FacebookApi::getListFeeds($_post_fbID, LIMIT_ITEM_PERPAGE); // 50 is limit row for each query. We can change to the value we need

//Insert data into Google Sheet
GoogleSheet::addListRow($post_spreadSheetFeed, $post_workSheet, $facebookListFeeds);

echo json_encode(['status' => true]);