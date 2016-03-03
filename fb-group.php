<?php
session_start();

ini_set('max_execution_time', 1200); //300 seconds = 5 minutes
ini_set('memory_limit ', '521M');
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'vendor/autoload.php';
require_once __DIR__ . '/Config.php';
require_once __DIR__ . '/GoogleSheet.php';

use Lib\Common;
/*use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;

$serviceRequest = new DefaultServiceRequest(Common::getGoogleTokenFromKeyFile());
ServiceRequestFactory::setInstance($serviceRequest);

$spreadsheetFeed = GoogleSheet::getAllSpreadSheetFeed();*/

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

    //\Lib\FacebookApi::getUserGroup($fb_user_id);

} else {
    $fb_user_id = '';

    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email', 'user_posts']; // optional
    $callback = FACEBOOK_CALLBACK;
    $loginUrl = $helper->getLoginUrl($callback, $permissions);
}

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
        <div class="col-sm-6 col-sm-offset-3">
            <form action="" method="post" id="frm">
                <div class="form-group">
                    <label for="">Facebook User ID</label>
                    <input type="text" name="facebook_user_id" id="facebook_user_id" class="form-control" value="<?=$fb_user_id?>">
                </div>

                <!--<input type="submit" value="Export" name="submit" class="btn btn-primary"/>-->
                <button type="button" id="exportingFbGroup" data-loading-text="Exporting..." class="btn btn-primary" autocomplete="off">
                    Click to Export
                </button>
            </form>
        </div>
    </div>


</div>

<div class="container-fluid">
    <div class="row" style="padding-top: 100px">
        <div class="col-md-12">
            <table class="table table-hover table-bordered" id="list_fbGroup">
                <thead>
                <tr>
                    <th>Link</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Message</th>
                    <th>Buffer</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- Bootstrap JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript">

</script>
</body>
</html>
