<?php
session_start();
ini_set('max_execution_time', 1200); //300 seconds = 5 minutes
ini_set('memory_limit ', '521M');

require_once __DIR__ . '/../vendor/autoload.php';
//require_once __DIR__ . '/../GoogleSheet.php';
require_once __DIR__ . '/../Config.php';


use Lib\Common;
use Lib\FacebookApi;

$_post_fbID = $_POST['facebook_user_id'];

$facebookListFeeds = FacebookApi::getListFeedFacebookGroup($_post_fbID, LIMIT_ITEM_PERPAGE); // 50 is limit row for each query. We can change to the value we need

echo json_encode(['status' => true, 'items' => $facebookListFeeds]);