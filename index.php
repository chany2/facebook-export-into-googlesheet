<?php
session_start();

require_once 'vendor/autoload.php';
require_once 'Config.php';
require_once 'GoogleSheet.php';

use \Lib\Common;

$clientId = CLIENT_ID;
$clientSecret = CLIENT_SECRET;
$redirectUrl = REDIRECT_URL;

$client = new Google_Client();
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUrl);
$client->setScopes(array('https://spreadsheets.google.com/feeds'));


if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
	/*$client->setAccessToken($_SESSION['access_token']);*/
//	Common::dd($_SESSION['access_token']);
//	$google_token= json_decode($_SESSION['access_token']);
//	if ($google_token->refresh_token) {
//		$client->refreshToken($google_token->refresh_token);
//		$_SESSION['access_token'] = $client->getAccessToken();
//	}
} else {
	$auth_url = $client->createAuthUrl();
	header('Location: '. REDIRECT_URL);
	//header('Location: ' . filter_var($redirectUrl, FILTER_SANITIZE_URL));
	exit;
}


use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;

$serviceRequest = new DefaultServiceRequest(Common::getAccessToken($_SESSION['access_token']));
ServiceRequestFactory::setInstance($serviceRequest);

$spreadsheetFeed = GoogleSheet::getAllSpreadSheetFeed();

//$listBaseRows = GoogleSheet::getListBaseFeed('test', 'Sheet 1');
//Common::dd($values);
//GoogleSheet::getOnlyUserNameFromListBaseFeed('test', 'Sheet 1', 'username');
//Add list row
//GoogleSheet::addListRow('test', 'Sheet 1');

//Add header
//GoogleSheet::addHeaderToWorkSheet();


/*
 * Facebook Area
 */
$fbApp = new Facebook\FacebookApp(FACEBOOK_API_KEY, FACEBOOK_API_SECRET);
$fb = new Facebook\Facebook([
		'app_id' => FACEBOOK_API_KEY,
		'app_secret' => FACEBOOK_API_SECRET,
		'default_graph_version' => 'v2.5',
]);

if (isset($_SESSION['facebook_access_token']) && $_SESSION['facebook_access_token']) {
	$fb_user_id = \Lib\FacebookApi::getMe()['id'];

	\Lib\FacebookApi::getUserGroup($fb_user_id);

} else {
	$fb_user_id = '';

	$helper = $fb->getRedirectLoginHelper();
	$permissions = ['email', 'user_posts']; // optional
	$callback = FACEBOOK_CALLBACK;
	$loginUrl = $helper->getLoginUrl($callback, $permissions);
}




/*$request = new \Facebook\FacebookRequest(
		$fbApp,
		$_SESSION['facebook_access_token'],
		'GET',
		'/985711858146481/feed',
		array(
			'fields' => 'admin_creator,created_time,description,from,name,likes{name},comments,message,link'
		)
);

$response = $fb->getClient()->sendRequest($request);
$graphObject = $response->getDecodedBody()['data'];
$count = count($graphObject);

foreach ($graphObject as $key => $object)
{
	$fbData[] = [
			'id'	=> $object['id'],
			'from'	=> $object['from']['name'],
			'link'	=> isset($object['link']) ? $object['link'] : '',
			'name'	=> isset($object['name']) ? $object['name'] : '',
			'description'	=> isset($object['description']) ? $object['description'] : '',
			'message' => isset($object['message']) ? $object['message'] : '',
			'created_time'	=> $object['created_time'],
			'comments'	=> isset($object['comments']['data']) ? count($object['comments']['data']): 0,
			'likes'	=> isset($object['likes']['data']) ? count($object['likes']['data']) : 0
	];
}*/

//GoogleSheet::addListRow('test2', 'Sheet 1', $fbData);
//Common::dd($fbData);



?>

<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Title Page</title>

	<!-- Bootstrap CSS -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<h1 class="text-center">Facebook Feed Into GoogleSheet</h1>
<?php if (!isset($_SESSION['facebook_access_token'])) : ?>
<p class="text-center">
	<a href="<?=$loginUrl?>">Log in with Facebook!</a>
</p>
<?php endif ?>
<div class="container">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<form action="" method="post">
				<div class="form-group">
					<label for="">Facebook User ID</label>
					<input type="text" name="facebook_user_id" id="facebook_user_id" class="form-control" value="<?=$fb_user_id?>">
				</div>

				<div class="form-group">
					<label for="">SpreadSheet</label>
					<select name="spreadsheet" id="spreadsheet" class="form-control">
						<option value="">Select SpreadSheet</option>
						<?php foreach ($spreadsheetFeed as $key => $value) : ?>
							<option value="<?=$spreadsheetFeed[$key]->getTitle()?>"><?=$spreadsheetFeed[$key]->getTitle()?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="">WorkSheet</label>
					<select name="worksheet" id="worksheet" class="form-control">
						<option value="">Select WorkSheet</option>

					</select>
				</div>

				<input type="submit" value="Export" name="submit" class="btn btn-primary"/>
			</form>
		</div>
	</div>
</div>


<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- Bootstrap JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script type="text/javascript" src="js/main.js"></script>

</body>
</html>
