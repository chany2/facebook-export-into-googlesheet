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
                    <th>Suggest</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!--Model Buffer -->
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Suggest</h4>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <textarea name="messageBuffer" id="messageBuffer" class="form-control" placeholder="Enter your message here"></textarea>
                    </div>
                    <div class="form-group">
                        <input name="linkBuffer" id="linkBuffer" type="text" class="form-control" placeholder="Enter your link">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="postToBuffer" class="btn btn-primary" onclick="callPostToBuffer()">Post to Buffer</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- Bootstrap JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript">

</script>
</body>
</html>
